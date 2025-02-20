<?php

namespace Database\Factories;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartementFactory extends Factory
{
    protected $model = Departement::class;
    
    public function definition()
    {
        // $user = User::firstorNew([]);
        // $user->save();

        return [
            'name'       => fake()->name(),
            // 'leader_id'  => User::count() ? User::all()->random()->id : User::factory()->create()->id,
            // 'deputy_id'  => User::count() ? User::all()->random()->id : User::factory()->create()->id,
        ];
    }
}
