<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rapot_Santri>
 */
class Rapot_SantriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $academic =$this->faker->year;
        return [
            'user_id'       => User::all()->random()->id,
            'academic_year' => $academic . '/' . ($academic + 1),
            'overall_score' => $this->faker->randomFloat(2, 0, 100),
            'strengths'     => $this->faker->sentence,
            'weaknesses'    => $this->faker->sentence,
        ];
    }
}
