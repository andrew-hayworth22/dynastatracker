<?php

use App\Http\Resources\DynastyResource;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\TeamResource;
use App\Models\Dynasty;
use App\Models\Season;
use App\Models\Team;
use App\Models\User;

it('requires authentication', function () {
    $dynasty = Dynasty::factory()->create();

    $this->get(route('dynasties.show', $dynasty->id))
        ->assertRedirect('login');
});

it('shows the dynasty', function () {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.show', $dynasty->id))
        ->assertComponent('Dynasties/Show');
});

it('does not show a dynasty for a different user', function () {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('dynasties.show', $dynasty->id))
        ->assertForbidden();
});

it('returns the correct dynasty', function () {
    $user = User::factory()->create();
    $dynasty = Dynasty::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->get(route('dynasties.show', $dynasty->id))
        ->assertHasResource('dynasty', DynastyResource::make($dynasty));
});

it('returns the correct seasons', function() {
    $dynasty = Dynasty::factory()->create();
    Season::factory(4)->create(['dynasty_id' => $dynasty->id]);

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.show', $dynasty->id))
        ->assertHasResource('seasons', SeasonResource::collection($dynasty->seasons()->with('games', 'team')->orderBy('year', 'desc')->limit(3)->get()));
});

it('returns the correct teams', function () {
    $dynasty = Dynasty::factory()->create();
    Team::factory(5)->recycle($dynasty)->create();

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.show', $dynasty->id))
        ->assertHasResource('teams', TeamResource::collection($dynasty->teams()->orderBy('college_name')->get()));

});
