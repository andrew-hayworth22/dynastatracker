<?php

use App\Http\Resources\DynastyResource;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\TeamResource;
use App\Models\Conference;
use App\Models\Division;
use App\Models\Dynasty;
use App\Models\Season;
use App\Models\Team;
use App\Models\User;

it('requires authentication', function () {
    $dynasty = Dynasty::factory()->create();
    $this->get(route('dynasties.seasons.index', $dynasty))
        ->assertRedirect(route('login'));
});

it('cannot view seasons for a dynasty that does not belong to the user', function () {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('dynasties.seasons.index', $dynasty))
        ->assertForbidden();
});

it('returns the correct component', function () {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.seasons.index', $dynasty))
        ->assertComponent('Seasons/Index');
});

it('returns the correct dynasty', function () {
    $user = User::factory()->create();
    $dynasty = Dynasty::factory()->create([
        'user_id' => $user->id
    ]);

    $this->actingAs($user)
        ->get(route('dynasties.seasons.index', $dynasty))
        ->assertHasResource('dynasty', DynastyResource::make($dynasty));
});

it('returns the correct seasons', function () {
    $dynasty = Dynasty::factory()->has(Season::factory(3))->create();
    $seasons = SeasonResource::collection($dynasty->seasons->sort(fn ($a, $b) => $b->year <=> $a->year)->load('team'));

    $this->actingAs($dynasty->user)
        ->get(route('dynasties.seasons.index', $dynasty))
        ->assertHasResource('seasons', $seasons);
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
        ->get(route('dynasties.seasons.index', $dynasty->id))
        ->assertHasResource('teams', $teams);
});
