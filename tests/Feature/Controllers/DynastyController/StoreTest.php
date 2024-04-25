<?php

use App\Models\Dynasty;
use App\Models\User;

beforeEach(function () {
    $this->validData = fn () => [
        'name' => 'Test Dynasty',
        'coach_name' => 'Coach Doe'
    ];
});

it('requires authentication', function () {
    $this->post(route('dynasties.store'))
        ->assertRedirect(route('login'));
});

it('stores a dynasty', function () {
    $user = User::factory()->create();
    $data = value($this->validData);

    $this->actingAs($user)
        ->post(route('dynasties.store'), $data);

    $this->assertDatabaseHas('dynasties', [
        ...$data,
        'user_id' => $user->id
    ]);
});

it('redirects to the show view', function () {
    $user = User::factory()->create();
    $data = value($this->validData);

    $response = $this->actingAs($user)
        ->post(route('dynasties.store'), $data);

    $dynasty = Dynasty::first();

    $response->assertRedirect(route('dynasties.show', $dynasty->id));
});

it('requires valid data', function (array $badData, array|string $errors) {
    $this->actingAs(User::factory()->create())
        ->post(route('dynasties.store'), [
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
    [['coach_name' => null], 'coach_name'],
    [['coach_name' => true], 'coach_name'],
    [['coach_name' => 1], 'coach_name'],
    [['coach_name' => 1.5], 'coach_name'],
    [['coach_name' => str_repeat('a', 256)], 'coach_name']
]);
