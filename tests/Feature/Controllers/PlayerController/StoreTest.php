<?php

use App\Models\Dynasty;
use App\Models\User;

beforeEach(function () {
    $this->validData = fn () => [
        'dynasty_id' => Dynasty::factory()->create()->id,
        'first_name' => 'John',
        'last_name' => 'Doe',
        'weight_lbs' => 200,
        'height_ft' => 6,
        'height_in' => 0,
    ];
});

it('requires authentication', function () {
    $data = value($this->validData);

    $this->post(route('dynasties.players.store', $data['dynasty_id']), $data)
        ->assertRedirect(route('login'));
});

it('does not allow you to create a player for a dynasty you do not own', function () {
    $data = value($this->validData);

    $this->actingAs(User::factory()->create())
        ->post(route('dynasties.players.store', $data['dynasty_id']), $data)
        ->assertForbidden();
});

it('stores a player', function () {
    $dynasty = Dynasty::factory()->create();
    $data = value($this->validData);

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.players.store', $dynasty->id), $data);

    $this->assertDatabaseHas('players', [
        ...$data,
        'dynasty_id' => $dynasty->id,
    ]);
});

it('requires valid data', function (array $badData, array|string $errors) {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.players.store', $dynasty->id), [
            ...value($this->validData),
            ...$badData,
        ])
        ->assertSessionHasErrors($errors);
})->with([
    [['first_name' => null], 'first_name'],
    [['first_name' => true], 'first_name'],
    [['first_name' => 1], 'first_name'],
    [['first_name' => 1.5], 'first_name'],
    [['first_name' => str_repeat('a', 256)], 'first_name'],
    [['last_name' => null], 'last_name'],
    [['last_name' => true], 'last_name'],
    [['last_name' => 1], 'last_name'],
    [['last_name' => 1.5], 'last_name'],
    [['last_name' => str_repeat('a', 256)], 'last_name'],
    [['weight_lbs' => null], 'weight_lbs'],
    [['weight_lbs' => 0], 'weight_lbs'],
    [['weight_lbs' => 501], 'weight_lbs'],
    [['height_ft' => null], 'height_ft'],
    [['height_ft' => 2], 'height_ft'],
    [['height_ft' => 9], 'height_ft'],
    [['height_in' => null], 'height_in'],
    [['height_in' => -1], 'height_in'],
    [['height_in' => 12], 'height_in'],
]);
