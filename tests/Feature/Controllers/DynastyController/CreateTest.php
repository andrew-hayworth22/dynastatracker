<?php

use App\Models\User;

it('requires authorization', function () {
    $this->get(route('dynasties.create'))
        ->assertRedirect(route('login'));
});

it('returns correct component', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('dynasties.create'))
        ->assertComponent('Dynasties/Create');
});
