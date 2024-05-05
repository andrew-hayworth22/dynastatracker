<?php

use App\Http\Resources\GameViewResource;
use App\Models\Game;
use App\Models\User;

it('requires authentication', function () {
    $game = Game::factory()->create();

    $this->get(route('games.show', $game->id))
        ->assertRedirect(route('login'));
});

it('shows the game', function () {
    $game = Game::factory()->create();

    $this->actingAs($game->season->dynasty->user)
        ->get(route('games.show', $game->id))
        ->assertComponent('Games/Show');
});

it('returns the correct game', function () {
    $user = User::factory()->create();
    $game = Game::factory()->recycle($user)->create();

    $this->actingAs($user)
        ->get(route('games.show', $game->id))
        ->assertHasResource('game', GameViewResource::make(Game::find($game->id)->load(['season', 'opp_team'])));
});
