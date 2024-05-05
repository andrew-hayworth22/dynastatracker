<?php

use App\Http\Resources\DynastyResource;
use App\Http\Resources\GameLogResource;
use App\Http\Resources\SeasonResource;
use App\Models\Game;
use App\Models\Season;
use App\Models\User;

it('requires authentication', function () {
    $season = Season::factory()->create();

    $this->get(route('seasons.show', $season->id))
        ->assertRedirect(route('login'));
});

it('does not allow you to view a season in a dynasty you do not own', function () {
    $season = Season::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('seasons.show', $season->id))
        ->assertForbidden();
});

it('returns the correct component', function () {
    $season = Season::factory()->create();

    $this->actingAs($season->dynasty->user)
        ->get(route('seasons.show', $season->id))
        ->assertComponent('Seasons/Show');
});

it('returns the correct season', function () {
    $user = User::factory()->create();
    $season = Season::factory()->recycle($user)->create();

    $this->actingAs($user)
        ->get(route('seasons.show', $season->id))
        ->assertHasResource('season', SeasonResource::make($season->load(['team', 'dynasty'])));
});

it('returns the correct games', function () {
    $user = User::factory()->create();
    $season = Season::factory()->recycle($user)->create();
    Game::factory(5)->recycle($season)->create();

    $this->actingAs($user)
        ->get(route('seasons.show', $season->id))
        ->assertHasResource('games', GameLogResource::collection($season->games()->with('opp_team')->orderBy('date')->get()));
});
