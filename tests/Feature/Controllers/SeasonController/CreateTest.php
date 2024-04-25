<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Resources\DynastyResource;
use App\Http\Resources\TeamResource;
use App\Models\Conference;
use App\Models\Division;
use App\Models\Dynasty;
use App\Models\Team;
use App\Models\User;

it('requires authorization', function () {
    $this->get(route('dynasties.seasons.create', Dynasty::factory()->create()->id))
        ->assertRedirect(route('login'));
});

it('does not allow you to create a season for a dynasty you don\'t own', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('dynasties.seasons.create', Dynasty::factory()->create()->id))
        ->assertForbidden();
});

it('returns the correct component', function () {
    $dynasty = Dynasty::factory()->create();
    $this->actingAs($dynasty->user)
        ->get(route('dynasties.seasons.create', $dynasty->id))
        ->assertComponent('Seasons/Create');
});

it('includes the correct dynasty', function () {
    $user = User::factory()->create();
    $dynasty = Dynasty::factory()->create([
        'user_id' => $user->id
    ]);

    $this->actingAs($user)
        ->get(route('dynasties.seasons.create', $dynasty->id))
        ->assertHasResource('dynasty', DynastyResource::make($dynasty));
});

it('includes the correct teams', function () {
    $user = User::factory()->create();
    $dynasty = Dynasty::factory()->create([
        'user_id' => $user->id
    ]);

    Conference::factory()
        ->has(Division::factory(2)
            ->has(Team::factory(3)))
        ->create(['dynasty_id' => $dynasty->id]);

    $teams = TeamResource::collection($dynasty->teams);

    $this->actingAs($user)
        ->get(route('dynasties.seasons.create', $dynasty->id))
        ->assertHasResource('teams', $teams);
});
