<?php

namespace Database\Factories;

use App\Models\Dynasty;
use Illuminate\Database\Eloquent\Factories\Factory;


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
            'dynasty_id' => Dynasty::factory(),
            'name' => $this->faker->words(2, true) . ' Conference',
            'abbreviation' => strtoupper($this->faker->lexify('???'))
        ];
    }
}
