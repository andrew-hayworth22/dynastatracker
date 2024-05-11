<?php

use App\Models\Dynasty;
use App\Models\User;

beforeEach(function () {
    $this->validData = fn () => [
        'name' => 'Test Dynasty',
        'abbreviation' => 'TD'
    ];
});

it('requires authentication', function () {
    $this->post(route('dynasties.conferences.store', Dynasty::factory()->create()))
        ->assertRedirect(route('login'));
});

it('cannot create a conference for a dynasty you do not own', function () {
    $dynasty = Dynasty::factory()->create();
    $data = value($this->validData);

    $this->actingAs(User::factory()->create())
        ->post(route('dynasties.conferences.store', $dynasty), $data)
        ->assertForbidden();
});

it('can store a conference', function () {
    $dynasty = Dynasty::factory()->create();
    $data = value($this->validData);

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.conferences.store', $dynasty), $data);

    $this->assertDatabaseHas('conferences', [
        'dynasty_id' => $dynasty->id,
        ...$data
    ]);
});

it('requires valid data', function (array $badData, array|string $errors) {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.conferences.store', $dynasty), [
            ...value($this->validData),
            ...$badData
        ])
        ->assertInvalid($errors);
})->with([
    [['name' => null], 'name'],
    [['name' => true], 'name'],
    [['name' => 1], 'name'],
    [['name' => 1.5], 'name'],
    [['name' => str_repeat('a', 256)], 'name'],
    [['abbreviation' => null], 'abbreviation'],
    [['abbreviation' => true], 'abbreviation'],
    [['abbreviation' => 1], 'abbreviation'],
    [['abbreviation' => 1.5], 'abbreviation'],
    [['abbreviation' => str_repeat('a', 256)], 'abbreviation']
]);
