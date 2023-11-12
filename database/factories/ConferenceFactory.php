<?php

namespace Database\Factories;

use App\Models\Dynasty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conference>
 */
class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dynasty_id' => Dynasty::factory()->make()->id,
            'name' => fake()->words(3),
            'abbrev' => 'ACC'
        ];
    }
}
