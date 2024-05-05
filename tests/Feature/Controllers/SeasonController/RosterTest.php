<?php

use App\Http\Resources\SeasonResource;
use App\Models\Season;
use App\Models\User;

it('requires authentication', function () {
    $this->get(route('seasons.roster', Season::factory()->create()))
        ->assertRedirect(route('login'));
});

it('does not allow users to view rosters for seasons in dynasties they don\'t own', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('seasons.roster', Season::factory()->create()))
        ->assertForbidden();
});

it('returns the correct component', function () {
    $season = Season::factory()->create();

    $this->actingAs($season->dynasty->user)
        ->get(route('seasons.roster', $season))
        ->assertComponent('Seasons/Roster');
});

it('returns the correct season', function () {
    $user = User::factory()->create();
    $season = Season::factory()->recycle($user)->create();

    $this->actingAs($user)
        ->get(route('seasons.roster', $season->id))
        ->assertHasResource('season', SeasonResource::make($season->load(['team', 'dynasty'])));
});
