<?php

namespace Database\Factories;

use App\Models\Season;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'season_id' => Season::factory(),
            'opp_team_id' => Team::factory(),
            'location' => $this->faker->randomElement(['Home', 'Away', 'Neutral']),
            'type' => $this->faker->randomElement(['Regular Season', 'Conference Championship', 'Bowl Game', 'National Octafinals', 'National Quarterfinals', 'National Semifinals', 'National Championship']),
            'week' => $this->faker->numberBetween(1, 12),
            'coverage' => $this->faker->randomElement(['None', 'Regional', 'National']),
            'date' => $this->faker->dateTimeBetween('-10 years', 'now'),

            'our_score_q1' => $this->faker->numberBetween(0, 21),
            'our_score_q2' => $this->faker->numberBetween(0, 21),
            'our_score_q3' => $this->faker->numberBetween(0, 21),
            'our_score_q4' => $this->faker->numberBetween(0, 21),
            'our_score_ot' => $this->faker->numberBetween(0, 21),
            'our_first_downs' => $this->faker->numberBetween(5, 30),
            'our_third_down_att' => $this->faker->numberBetween(5, 15),
            'our_third_down_conv' => $this->faker->numberBetween(1, 10),
            'our_fourth_down_att' => $this->faker->numberBetween(0, 5),
            'our_fourth_down_conv' => $this->faker->numberBetween(0, 5),
            'our_two_point_att' => $this->faker->numberBetween(0, 3),
            'our_two_point_conv' => $this->faker->numberBetween(0, 3),
            'our_red_zone_att' => $this->faker->numberBetween(1, 5),
            'our_red_zone_fgs' => $this->faker->numberBetween(0, 3),
            'our_red_zone_tds' => $this->faker->numberBetween(0, 3),
            'our_fumbles_lost' => $this->faker->numberBetween(0, 3),
            'our_penalties' => $this->faker->numberBetween(0, 10),
            'our_penalty_yds' => $this->faker->numberBetween(0, 100),
            'our_top_min' => $this->faker->numberBetween(15, 45),
            'our_top_sec' => $this->faker->numberBetween(0, 59),

            'opp_score_q1' => $this->faker->numberBetween(0, 21),
            'opp_score_q2' => $this->faker->numberBetween(0, 21),
            'opp_score_q3' => $this->faker->numberBetween(0, 21),
            'opp_score_q4' => $this->faker->numberBetween(0, 21),
            'opp_score_ot' => $this->faker->numberBetween(0, 21),
            'opp_first_downs' => $this->faker->numberBetween(5, 30),
            'opp_rush_att' => $this->faker->numberBetween(15, 40),
            'opp_rush_yds' => $this->faker->numberBetween(50, 200),
            'opp_rush_tds' => $this->faker->numberBetween(0, 3),
            'opp_pass_comp' => $this->faker->numberBetween(5, 20),
            'opp_pass_att' => $this->faker->numberBetween(15, 40),
            'opp_pass_yds' => $this->faker->numberBetween(50, 300),
            'opp_pass_tds' => $this->faker->numberBetween(0, 3),
            'opp_third_down_att' => $this->faker->numberBetween(5, 15),
            'opp_third_down_conv' => $this->faker->numberBetween(1, 10),
            'opp_fourth_down_att' => $this->faker->numberBetween(0, 5),
            'opp_fourth_down_conv' => $this->faker->numberBetween(0, 5),
            'opp_two_point_att' => $this->faker->numberBetween(0, 3),
            'opp_two_point_conv' => $this->faker->numberBetween(0, 3),
            'opp_red_zone_att' => $this->faker->numberBetween(1, 5),
            'opp_red_zone_fgs' => $this->faker->numberBetween(0, 3),
            'opp_red_zone_tds' => $this->faker->numberBetween(0, 3),
            'opp_fumbles_lost' => $this->faker->numberBetween(0, 3),
            'opp_ints' => $this->faker->numberBetween(0, 3),
            'opp_punt_return_yds' => $this->faker->numberBetween(0, 100),
            'opp_kick_return_yds' => $this->faker->numberBetween(0, 100),
            'opp_punts' => $this->faker->numberBetween(0, 10),
            'opp_punt_avg' => $this->faker->numberBetween(30, 50),
            'opp_penalties' => $this->faker->numberBetween(0, 10),
            'opp_penalty_yds' => $this->faker->numberBetween(0, 100),
            'opp_top_min' => $this->faker->numberBetween(15, 45),
            'opp_top_sec' => $this->faker->numberBetween(0, 59),
        ];
    }
}
