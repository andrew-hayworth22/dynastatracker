<?php

use App\Models\Dynasty;
use App\Models\Team;
use App\Models\User;

beforeEach(function () {
    $this->validData = fn () => [
        'dynasty_id' => Dynasty::factory()->create()->id,
        'year' => 2021,
        'coach_type' => 'HC',
        'team_id' => Team::factory()->create()->id,
    ];
});

it('requires authentication', function () {
    $data = value($this->validData);

    $this->post(route('dynasties.seasons.store', $data['dynasty_id']))
        ->assertRedirect(route('login'));
});

it('does not allow you to store a season for a dynasty you don\'t own', function () {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs(User::factory()->create())
        ->post(route('dynasties.seasons.store', $dynasty->id))
        ->assertForbidden();
});

it('stores a season', function () {
    $dynasty = Dynasty::factory()->create();
    $data = value($this->validData);

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.seasons.store', $dynasty->id), $data);

    $this->assertDatabaseHas('seasons', [
        ...$data,
        'dynasty_id' => $dynasty->id
    ]);
});

it('redirects to the seasons show page', function () {
    $dynasty = Dynasty::factory()->create();
    $data = value($this->validData);

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.seasons.store', $dynasty->id), $data)
        ->assertRedirect(route('seasons.show', $dynasty->seasons()->first()));
});

it('requires valid data', function (array $badData, array|string $errors) {
    $dynasty = Dynasty::factory()->create();

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.seasons.store', $dynasty->id), [
            ...value($this->validData),
            ...$badData
        ])
        ->assertInvalid($errors);
})->with([
    [['year' => null], 'year'],
    [['year' => true], 'year'],
    [['year' => 1899], 'year'],
    [['year' => 2101], 'year'],
    [['year' => 2021.5], 'year'],
    [['coach_type' => null], 'coach_type'],
    [['coach_type' => true], 'coach_type'],
    [['coach_type' => 1], 'coach_type'],
    [['coach_type' => 1.5], 'coach_type'],
    [['coach_type' => 'FC'], 'coach_type'],
    [['team_id' => null], 'team_id'],
    [['team_id' => true], 'team_id'],
    [['team_id' => 1], 'team_id'],
    [['team_id' => 1.5], 'team_id'],
    [['team_id' => 'string'], 'team_id'],
    [['team_id' => 99999], 'team_id']
]);

it('does not allow you to store a season that already exists', function () {
    $dynasty = Dynasty::factory()->create();
    $data = value($this->validData);

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.seasons.store', $dynasty->id), $data);

    $this->actingAs($dynasty->user)
        ->post(route('dynasties.seasons.store', $dynasty->id), $data)
        ->assertInvalid('year');
});
