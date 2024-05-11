<?php

use App\Http\Resources\GameEditResource;
use App\Models\Game;
use App\Models\User;

it('requires authentication', function () {
    $game = Game::factory()->create();

    $this->get(route('games.edit', $game))
        ->assertRedirect(route('login'));
});

it('does not allow editing a game that does not belong to the user', function () {
    $game = Game::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('games.edit', $game))
        ->assertForbidden();
});

it('shows the edit game form', function () {
    $game = Game::factory()->create();

    $this->actingAs($game->season->dynasty->user)
        ->get(route('games.edit', $game))
        ->assertComponent('Games/Edit');
});

it('returns the correct game', function () {
    $game = Game::factory()->create();

    $this->actingAs($game->season->dynasty->user)
        ->get(route('games.edit', $game))
        ->assertHasResource('game', GameEditResource::make(Game::find($game->id)->load(['season', 'season.dynasty', 'season.team'])));
});
