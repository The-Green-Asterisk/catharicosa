<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\Note;
use App\Models\Notelette;
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
                'inventoryItems' => InventoryItem::all()->where('user_id', $user),
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
            'note_id' => $request->input('note_id'),
            'body' => $request->input('body'),
            'quest_id' => $request->input('quest_id'),
            'n_p_c_id' => $request->input('npc_id'),
            'location_id' => $request->input('location_id'),
            'inventory_item_id' => $request->input('inventory_item_id')
        ]);

        return redirect('/')->with('success', 'Your new notelette has been saved!');
    }

    public function destroyNotelette(Notelette $notelette)
    {
        $notelette->delete();

        return back()->with('success', 'Notelette deleted!');
    }

    public function destroyNote(Note $note)
    {
        $note->delete();

        return back()->with('success', 'Note deleted!');
    }
}
