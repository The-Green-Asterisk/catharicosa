<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class NoteletteFactory extends Factory
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
            'body' => $this->faker->sentence,
            'user_id' => $user->id
        ];
    }
}
