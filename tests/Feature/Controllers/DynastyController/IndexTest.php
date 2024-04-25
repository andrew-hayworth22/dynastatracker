<?php

use App\Http\Resources\DynastyResource;
use App\Models\Dynasty;
use App\Models\User;

it('requires authorization', function () {
    $this->get(route('dynasties.index'))
        ->assertRedirect(route('login'));
});

it('returns correct component', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('dynasties.index'))
        ->assertComponent('Dynasties/Index');
});

it('returns the correct dynasties', function () {
    // Dynasty for a different user
    Dynasty::factory()->create();

    $user = User::factory()->create();
    $dynasties = Dynasty::factory(2)->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->get(route('dynasties.index'))
        ->assertHasPaginatedResource('dynasties', DynastyResource::collection($dynasties->reverse()));
});
