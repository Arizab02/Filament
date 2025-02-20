<?php

namespace Database\Factories;

use App\Models\Activities;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            // 'activity_id'=> Activities::all()->random()->id,
            'status'     => $this->faker->randomElement(['Hadir', 'Tidak Hadir', 'Izin', 'Sakit']),
            'date'       => $this->faker->dateTime,
        ];
    }
}
