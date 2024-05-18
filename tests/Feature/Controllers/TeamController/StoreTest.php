<?php

use App\Models\Division;
use App\Models\User;

beforeEach(function () {
    $this->validData = [
        'college_name' => 'Test University',
        'college_abbreviation' => 'Test',
        'mascot' => 'Testers',
        'location' => 'Test, TE',
    ];
});

it('requires authentication', function () {
    $division = Division::factory()->create();
    $this->post(route('divisions.teams.store', $division))
        ->assertRedirect(route('login'));
});

it('cannot create a team for a division you do not own', function () {
    $division = Division::factory()->create();
    $data = value($this->validData);

    $this->actingAs(User::factory()->create())
        ->post(route('divisions.teams.store', $division), $data)
        ->assertForbidden();
});

it('can store a team', function () {
    $division = Division::factory()->create();
    $data = value($this->validData);

    $this->actingAs($division->conference->dynasty->user)
        ->post(route('divisions.teams.store', $division), $data);

    $this->assertDatabaseHas('teams', [
        'division_id' => $division->id,
        ...$data
    ]);
});

it('requires valid data', function (array $badData, array|string $errors) {
    $division = Division::factory()->create();

    $this->actingAs($division->conference->dynasty->user)
        ->post(route('divisions.teams.store', $division), [
            ...value($this->validData),
            ...$badData
        ])
        ->assertInvalid($errors);
})->with([
    [['college_name' => null], 'college_name'],
    [['college_name' => true], 'college_name'],
    [['college_name' => 1], 'college_name'],
    [['college_name' => 1.5], 'college_name'],
    [['college_name' => str_repeat('a', 256)], 'college_name'],
    [['college_abbreviation' => null], 'college_abbreviation'],
    [['college_abbreviation' => true], 'college_abbreviation'],
    [['college_abbreviation' => 1], 'college_abbreviation'],
    [['college_abbreviation' => 1.5], 'college_abbreviation'],
    [['college_abbreviation' => str_repeat('a', 256)], 'college_abbreviation'],
    [['mascot' => null], 'mascot'],
    [['mascot' => true], 'mascot'],
    [['mascot' => 1], 'mascot'],
    [['mascot' => 1.5], 'mascot'],
    [['mascot' => str_repeat('a', 256)], 'mascot'],
    [['location' => true], 'location'],
    [['location' => 1], 'location'],
    [['location' => 1.5], 'location'],
    [['location' => str_repeat('a', 256)], 'location']
]);
