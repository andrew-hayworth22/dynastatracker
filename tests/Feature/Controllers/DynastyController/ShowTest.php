<?php

use App\Http\Resources\DynastyResource;
use App\Models\Dynasty;
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
