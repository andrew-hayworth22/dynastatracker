<?php

namespace Database\Factories;

use App\Models\Dynasty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'height_ft' => $this->faker->numberBetween(5, 7),
            'height_in' => $this->faker->numberBetween(0, 11),
            'weight_lbs' => $this->faker->numberBetween(180, 300),
            'is_active' => true,
        ];
    }

    public function left(): static
    {
        return $this->state([
            'is_active' => false,
            'reason_left' => $this->faker->sentence,
        ]);
    }
}
