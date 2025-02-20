<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id'    => User::all()->random()->id,
            // 'subject_id' => Subject::all()->random()->id,
            'score'      => $this->faker->randomFloat(2, 0, 100),
            'evaluation' => $this->faker->sentence,
            'date'       => $this->faker->dateTime,
        ];
    }
}
