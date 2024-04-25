<?php

use App\Models\Conference;
use App\Models\User;

beforeEach(function () {
    $this->validData = [
        'name' => 'Test Division'
    ];
});

it('requires authentication', function () {
    $conference = Conference::factory()->create();
    $this->post(route('conferences.divisions.store', $conference))
        ->assertRedirect(route('login'));
});

it('cannot create a division for a conference you do not own', function () {
    $conference = Conference::factory()->create();
    $data = value($this->validData);

    $this->actingAs(User::factory()->create())
        ->post(route('conferences.divisions.store', $conference), $data)
        ->assertForbidden();
});

it('can store a division', function () {
    $conference = Conference::factory()->create();
    $data = value($this->validData);

    $this->actingAs($conference->dynasty->user)
        ->post(route('conferences.divisions.store', $conference), $data);

    $this->assertDatabaseHas('divisions', [
        'conference_id' => $conference->id,
        ...$data
    ]);
});

it('requires valid data', function (array $badData, array|string $errors) {
    $conference = Conference::factory()->create();

    $this->actingAs($conference->dynasty->user)
        ->post(route('conferences.divisions.store', $conference), [
            ...value($this->validData),
            ...$badData
        ])
        ->assertInvalid($errors);
})->with([
    [['name' => null], 'name'],
    [['name' => true], 'name'],
    [['name' => 1], 'name'],
    [['name' => 1.5], 'name'],
    [['name' => str_repeat('a', 256)], 'name']
]);
