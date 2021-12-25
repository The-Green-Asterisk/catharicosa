<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class NoteFactory extends Factory
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
            'title' => $this->faker->sentence,
            'body' => $this->faker->sentences(3, true),
            'user_id' => $user->id
        ];
    }
}
