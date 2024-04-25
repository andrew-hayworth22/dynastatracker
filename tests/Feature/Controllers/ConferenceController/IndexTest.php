<?php

use App\Http\Resources\ConferenceResource;
use App\Http\Resources\DynastyResource;
use App\Models\Conference;
use App\Models\Division;
use App\Models\Dynasty;
use App\Models\Team;
use App\Models\User;

it('requires authorization', function () {
    $this->get(route('dynasties.conferences.index', Dynasty::factory()->create()))
        ->assertRedirect(route('login'));
});

it('does not show conferences for dynasties that were not created by the user', function () {
    $dynasty = Dynasty::factory()->create([
        'user_id' => User::factory()->create()
    ]);

    $this->actingAs(User::factory()->create())
        ->get(route('dynasties.conferences.index', $dynasty))
        ->assertForbidden();
});

it('returns the correct component', function () {
    $user = User::factory()->create();
    $dynasty = Dynasty::factory()->create([
        'user_id' => $user
    ]);

    $this->actingAs($user)
        ->get(route('dynasties.conferences.index', $dynasty))
        ->assertComponent('Conferences/Index');
});

it('includes the correct dynasty', function () {
    $user = User::factory()->create();
    $dynasty = Dynasty::factory()->create([
        'user_id' => $user
    ]);

    $this->actingAs($user)
        ->get(route('dynasties.conferences.index', $dynasty))
        ->assertHasResource('dynasty', DynastyResource::make($dynasty));
});

it('includes the correct conferences', function () {
    $user = User::factory()->create();
    $dynasty = Dynasty::factory()->create([
        'user_id' => $user
    ]);
    $conferences = Conference::factory(3)
        ->has(Division::factory(2)->has(Team::factory(4)))
        ->create([
            'dynasty_id' => $dynasty->id
        ]);

    $conferences->load('divisions')->load('divisions.teams');

    $this->actingAs($user)
        ->get(route('dynasties.conferences.index', $dynasty))
        ->assertHasResource('conferences', ConferenceResource::collection($conferences));
});
