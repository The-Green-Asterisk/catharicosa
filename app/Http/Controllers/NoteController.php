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

    public function addNotelette(Request $request, Note $note)
    {
        $note->notelettes()->create([
            'user_id' => auth()->user()->id,
            'body' => $request->input('body'),
            'quest_id' => $request->input('quest_id'),
            'npc_id' => $request->input('npc_id'),
            'location_id' => $request->input('location_id'),
        ]);
    }
}
