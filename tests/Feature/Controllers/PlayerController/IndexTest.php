<?php

use App\Http\Resources\DynastyResource;
use App\Http\Resources\PlayerResource;
use App\Models\Dynasty;
use App\Models\Player;
use App\Models\User;

it('requires authentication', function () {
    $this->get(route('dynasties.players.index', Dynasty::factory()->create()))
        ->assertRedirect(route('login'));
});

it('does not allow user to view a dynasty\'s players if they do not own it', function () {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('dynasties.players.index', $dynasty->id))
        ->assertForbidden();
});

it('returns the correct component', function () {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.players.index', $dynasty->id))
        ->assertComponent('Players/Index');
});

it('returns the correct dynasty', function () {
    $user = User::factory()->create();
    $dynasty = Dynasty::factory()->create([
        'user_id' => $user->id
    ]);

    $this->actingAs($user)
        ->get(route('dynasties.players.index', $dynasty->id))
        ->assertHasResource('dynasty', DynastyResource::make($dynasty));
});

it('returns the correct players', function () {
    $dynasty = Dynasty::factory()->create();
    $players = Player::factory()->count(3)->create([
        'dynasty_id' => $dynasty->id
    ]);

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.players.index', $dynasty->id))
        ->assertHasPaginatedResource('players', PlayerResource::collection($players->sortBy('last_name')));
});

it('filters inactive players', function () {
    $dynasty = Dynasty::factory()->create();
    $activePlayers = Player::factory()->count(3)->create([
        'dynasty_id' => $dynasty->id,
        'is_active' => true
    ]);
    Player::factory()->count(2)->create([
        'dynasty_id' => $dynasty->id,
        'is_active' => false
    ]);

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.players.index', $dynasty->id))
        ->assertHasPaginatedResource('players', PlayerResource::collection($activePlayers->sortBy('last_name')));
});

it('filters active players', function () {
    $dynasty = Dynasty::factory()->create();
    Player::factory()->count(3)->create([
        'dynasty_id' => $dynasty->id,
        'is_active' => true
    ]);
    $inactivePlayers = Player::factory()->count(2)->create([
        'dynasty_id' => $dynasty->id,
        'is_active' => false
    ]);

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.players.index', [$dynasty->id, 'filter' => ['is_active' => 'Inactive']]))
        ->assertHasPaginatedResource('players', PlayerResource::collection($inactivePlayers->sortBy('last_name')));
});
