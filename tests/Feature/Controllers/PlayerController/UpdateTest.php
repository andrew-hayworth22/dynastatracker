<?php

use App\Models\Player;
use App\Models\User;

beforeEach(function () {
    $this->validData = fn () => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'weight_lbs' => 200,
        'height_ft' => 6,
        'height_in' => 0,
        'is_active' => false,
        'reason_left' => 'Drafted'
    ];
});

it('requires authentication', function() {
    $player = Player::factory()->create();
    $data = value($this->validData);

    $this->put(route('players.update', $player->id), $data)
        ->assertRedirect(route('login'));

});

it('does not allow you to update a player you do not own', function() {
    $player = Player::factory()->create();
    $data = value($this->validData);

    $this->actingAs(User::factory()->create())
        ->put(route('players.update', $player->id), $data)
        ->assertForbidden();
});

it('updates a player', function() {
    $player = Player::factory()->create();
    $data = value($this->validData);

    $this->actingAs($player->dynasty->user)
        ->put(route('players.update', $player->id), $data);

    $this->assertDatabaseHas('players', [
        'id' => $player->id,
        ...$data
    ]);
});

it('requires valid data', function (array $badData, array|string $errors) {
    $player = Player::factory()->create();

    $this->actingAs($player->dynasty->user)
        ->put(route('players.update', $player->id), [
            ...value($this->validData),
            ...$badData,
        ])
        ->assertSessionHasErrors($errors);
})->with([
    [['first_name' => true], 'first_name'],
    [['first_name' => 1], 'first_name'],
    [['first_name' => 1.5], 'first_name'],
    [['first_name' => str_repeat('a', 256)], 'first_name'],
    [['last_name' => true], 'last_name'],
    [['last_name' => 1], 'last_name'],
    [['last_name' => 1.5], 'last_name'],
    [['last_name' => str_repeat('a', 256)], 'last_name'],
    [['weight_lbs' => 0], 'weight_lbs'],
    [['weight_lbs' => 501], 'weight_lbs'],
    [['height_ft' => 2], 'height_ft'],
    [['height_ft' => 9], 'height_ft'],
    [['height_in' => -1], 'height_in'],
    [['height_in' => 12], 'height_in'],
    [['reason_left' => true], 'reason_left'],
    [['reason_left' => 1], 'reason_left'],
    [['reason_left' => 1.5], 'reason_left'],
    [['reason_left' => str_repeat('a', 256)], 'reason_left'],
]);
