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
        if (auth()->check() === true ){
            $user = auth()->user()->id;
            $data = [
                'notes' => Note::all()->where('user_id', $user)->sortBy('created_at', SORT_REGULAR, 1),
                'quests' => Quest::all()->where('user_id', $user),
                'npcs' => NPC::all()->where('user_id', $user),
                'locations' => Location::all()->where('user_id', $user),
            ];
        }else{
            $data = ['coconut' => 'lime'];
        }

        return view('index', $data);
    }
}
