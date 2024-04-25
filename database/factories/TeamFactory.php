<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'division_id' => Division::factory(),
            'college_name' => $this->faker->word . ' University',
            'college_abbreviation' => $this->faker->word,
            'mascot' => $this->faker->word,
            'location' => $this->faker->unique()->city . ', ' . $this->faker->stateAbbr,
        ];
    }
}
