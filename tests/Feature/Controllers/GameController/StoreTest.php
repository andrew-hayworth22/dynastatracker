<?php

use App\Models\Season;
use App\Models\Team;
use App\Models\User;

beforeEach(function () {
    $this->validData = fn () => [
        'season_id' => Season::factory()->create()->id,
        'opp_team_id' => Team::factory()->create()->id,
        'location' => 'Home',
        'type' => 'Regular Season',
        'week' => 1,
        'coverage' => 'None',
        'date' => now(),

        'our_score_q1' => 7,
        'our_score_q2' => 0,
        'our_score_q3' => 3,
        'our_score_q4' => 11,
        'our_score_ot' => 0,

        'our_first_downs' => 7,

        'our_rush_att' => 32,
        'our_rush_yds' => 123,
        'our_rush_tds' => 3,

        'our_pass_comp' => 12,
        'our_pass_att' => 23,
        'our_pass_yds' => 123,
        'our_pass_tds' => 1,

        'our_third_down_att' => 8,
        'our_third_down_conv' => 3,
        'our_fourth_down_att' => 2,
        'our_fourth_down_conv' => 1,
        'our_two_point_att' => 1,
        'our_two_point_conv' => 1,

        'our_red_zone_att' => 4,
        'our_red_zone_fgs' => 2,
        'our_red_zone_tds' => 1,

        'our_fumbles_lost' => 0,
        'our_ints' => 1,

        'our_punt_return_yds' => 23,
        'our_kick_return_yds' => 78,

        'our_punts' => 2,
        'our_punt_avg' => 43.5,

        'our_penalties' => 4,
        'our_penalty_yds' => 40,

        'our_top_min' => 23,
        'our_top_sec' => 35,

        'opp_score_q1' => 14,
        'opp_score_q2' => 0,
        'opp_score_q3' => 3,
        'opp_score_q4' => 3,
        'opp_score_ot' => 0,

        'opp_first_downs' => 7,

        'opp_rush_att' => 32,
        'opp_rush_yds' => 123,
        'opp_rush_tds' => 3,

        'opp_pass_comp' => 12,
        'opp_pass_att' => 23,
        'opp_pass_yds' => 123,
        'opp_pass_tds' => 1,

        'opp_third_down_att' => 8,
        'opp_third_down_conv' => 3,
        'opp_fourth_down_att' => 2,
        'opp_fourth_down_conv' => 1,
        'opp_two_point_att' => 1,
        'opp_two_point_conv' => 1,

        'opp_red_zone_att' => 4,
        'opp_red_zone_fgs' => 2,
        'opp_red_zone_tds' => 1,

        'opp_fumbles_lost' => 0,
        'opp_ints' => 1,

        'opp_punt_return_yds' => 23,
        'opp_kick_return_yds' => 78,

        'opp_punts' => 2,
        'opp_punt_avg' => 43.5,

        'opp_penalties' => 4,
        'opp_penalty_yds' => 40,

        'opp_top_min' => 23,
        'opp_top_sec' => 35,
    ];
});

it('requires authentication', function () {
    $data = value($this->validData);

    $this->post(route('seasons.games.store', $data['season_id']), $data)
        ->assertRedirect(route('login'));
});

it('does not allow you to create a game for a season you do not own', function () {
    $data = value($this->validData);

    $this->actingAs(User::factory()->create())
        ->post(route('seasons.games.store', $data['season_id']), $data)
        ->assertForbidden();
});

it('stores a game', function () {
    $season = Season::factory()->create();
    $data = value($this->validData);

    $this->actingAs($season->dynasty->user)
        ->post(route('seasons.games.store', $season->id), $data);

    $this->assertDatabaseHas('games', [
        ...$data,
        'date' => $data['date']->format('Y-m-d H:i:s'),
        'season_id' => $season->id,
    ]);
});
