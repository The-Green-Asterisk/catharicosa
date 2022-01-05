<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class InventoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = DB::table('users')->inRandomOrder()->first();
        return [
            'name' => $this->faker->word(3),
            'description' => $this->faker->sentence(3),
            'user_id' => $user->id
        ];
    }
}
