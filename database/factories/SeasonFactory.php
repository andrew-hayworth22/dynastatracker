<?php

namespace Database\Factories;

use App\Models\Dynasty;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Season>
 */
class SeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dynasty_id' => Dynasty::factory(),
            'team_id' => Team::factory(),
            'coach_type' => $this->faker->randomElement(['OC', 'DC', 'HC']),
            'year' => $this->faker->year
        ];
    }
}
