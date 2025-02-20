<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
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
            'reason'     => $this->faker->sentence,
            'status'     => $this->faker->randomElement(['Pending', 'Disetujui', 'Ditolak']),
            'start_date' => $this->faker->date,
            'end_date'   => $this->faker->date,
        ];
    }
}
