<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class NPCFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = DB::table('users')->inRandomOrder()->first();
        $location = DB::table('locations')->inRandomOrder()->first();
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'user_id' => $user->id,
            'location_id' => $location->id
        ];
    }
}
