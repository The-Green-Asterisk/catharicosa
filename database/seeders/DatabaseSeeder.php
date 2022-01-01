<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Steve Beaudry',
            'email' => 'live.remix@gmail.com',
            'password' => 'admin',
        ]);
        \App\Models\User::factory(3)->create();
        \App\Models\Location::factory(3)->create();
        \App\Models\Note::factory(20)->create();
        \App\Models\NPC::factory(5)->create();
        \App\Models\Quest::factory(7)->create();
        \App\Models\Notelette::factory(100)->create();
    }
}
