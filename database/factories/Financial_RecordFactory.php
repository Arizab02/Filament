<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Financial_Record>
 */
class Financial_RecordFactory extends Factory
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
            'category'         => $this->faker->randomElement(['Pemasukan', 'Pengeluaran']),
            'description'      => $this->faker->sentence,
            'transaction_type' => $this->faker->randomElement(['Deposit', 'Withdrawal']),
            'amount'           => $this->faker->randomFloat(2, 1000, 1000000),
            'transaction_date' => $this->faker->dateTime,
        ];
    }
}
