<?php

namespace Database\Factories;

use App\Models\Rapot_Santri;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Untuk polymorphic, biasanya akan diset lewat relasi di dalam seed atau controller
            'attachmentable_id'   => fake()->randomElement([
                User::all()->random()->id ?? User::factory()->create()->id,
                Rapot_Santri::all()->random()->id ?? Rapot_Santri::factory()->create()->id
            ]), 
            'attachmentable_type' => $this->faker->randomElement([
                User::class,
                Rapot_Santri::class
            ]),
            'attachment_path'     => $this->faker->imageUrl,
            'created_at'          => now(),
            'updated_at'          => now(),
        ];
    }
}
