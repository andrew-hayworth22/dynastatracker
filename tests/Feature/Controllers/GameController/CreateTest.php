<?php

use App\Http\Resources\SeasonResource;
use App\Http\Resources\TeamResource;
use App\Models\Season;
use App\Models\User;

it('requires authentication', function () {
    $this->get(route('seasons.games.create', Season::factory()->create()))
        ->assertRedirect(route('login'));
});

it('does not show create screen for dynasty that does not belong to user', function () {
    $season = Season::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('seasons.games.create', $season))
        ->assertForbidden();
});

it('returns the correct component', function () {
    $season = Season::factory()->create();

    $this->actingAs($season->dynasty->user)
        ->get(route('seasons.games.create', $season))
        ->assertComponent('Games/Create');
});

it('returns the correct season', function () {
    $season = Season::factory()->create();

    $this->actingAs($season->dynasty->user)
        ->get(route('seasons.games.create', $season))
        ->assertHasResource('season', SeasonResource::make($season->load('dynasty')));
});

it('returns the correct teams', function () {
    $season = Season::factory()->create();

    $this->actingAs($season->dynasty->user)
        ->get(route('seasons.games.create', $season))
        ->assertHasResource('teams', TeamResource::collection($season->dynasty->teams()->orderBy('college_abbreviation')->get()));
});
