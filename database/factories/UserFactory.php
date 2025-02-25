<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = fake()->randomElement(['Santri', 'Ustadz', 'Staff', 'Pengurus']);
        $rolePrefix = strtoupper(substr($role, 0, 3));
        $rolePrefix = $rolePrefix ? : 'XXX';
        $customId = $rolePrefix . strtoupper(Str::random(9));
        return [
            'id'                 => $customId,
            'name'               => fake()->name(),
            'email'              => fake()->unique()->safeEmail(),
            'password'           => Hash::make('password'),
            'gender'             => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'date_of_birth'      => fake()->date(),
            'phone'              => fake()->phoneNumber(),
            'address'            => fake()->address(),
            'generation'         => fake()->numberBetween(1, 10),
            'entry_date'         => fake()->date(),
            'graduate_date'      => fake()->optional()->date(),
            'status_graduate'    => fake()->optional()->word(),
            'no_ktp'             => fake()->numerify('##########'),
            'role'               => $role,
            // 'class_id'           => \App\Models\Kelas::all()->random()->id,
            // 'department_id'      => \App\Models\Departement::all()->random()->id,
            // 'program_stage_id' => \App\Models\Program_Stage::all()->random()->id,
        ];
    }
    
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
