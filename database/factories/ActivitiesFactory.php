<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activities>
 */
class ActivitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_name' => $this->faker->word,
            'activity_date' => $this->faker->date,
            'description'   => $this->faker->sentence,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
