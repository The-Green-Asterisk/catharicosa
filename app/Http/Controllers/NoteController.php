<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Note;
use App\Models\NPC;
use App\Models\Quest;

class NoteController extends Controller
{
    public function show()
    {
        $user = auth()->user()->id;

        return view('index', [
            'notes' => Note::all()->where('user_id', $user),
            'quests' => Quest::all()->where('user_id', $user),
            'npcs' => NPC::all()->where('user_id', $user),
            'locations' => Location::all()->where('user_id', $user),
        ]);
    }
}
