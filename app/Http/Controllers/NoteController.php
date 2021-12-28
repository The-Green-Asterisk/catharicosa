<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Note;
use App\Models\NPC;
use App\Models\Quest;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function show()
    {
        return view('index', [
            'notes' => Note::all(),
            'quests' => Quest::all(),
            'npcs' => NPC::all(),
            'locations' => Location::all(),
        ]);
    }
}
