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
        $location = DB::table('locations')->inRandomOrder()->first();
        $note = DB::table('notes')->inRandomOrder()->first();
        $npc = DB::table('n_p_c_s')->inRandomOrder()->first();
        $quest = DB::table('quests')->inRandomOrder()->first();
        $user = DB::table('users')->inRandomOrder()->first();
        return [
            'body' => $this->faker->sentence,
            'location_id' => $location->id,
            'note_id' => $note->id,
            'n_p_c_id' => $npc->id,
            'quest_id' => $quest->id,
            'user_id' => $user->id
        ];
    }
}
