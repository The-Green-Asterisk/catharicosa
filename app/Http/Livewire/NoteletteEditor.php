<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\Notelette;
use App\Models\NPC;
use App\Models\Quest;
use Livewire\Component;

class NoteletteEditor extends Component
{
    public $body;
    public $orig;
    public $notelette;

    public $quests;
    public $locations;
    public $npcs;
    public $inventoryItems;

    public $questArray = [];
    public $locationArray = [];
    public $npcArray = [];
    public $itemArray = [];

    public $showNoteletteEditor = false;

    protected $listeners = ['editNotelette', 'closeNotelette'];

    public function editNotelette(Notelette $notelette)
    {
        $this->showNoteletteEditor = true;
        $this->body = $notelette->body;
        $this->orig = $notelette->body;
        $this->notelette = $notelette;

        if ($notelette->quest()->pluck('id')->toArray() !== null){
            foreach ($notelette->quest()->pluck('id')->toArray() as $id){
                $this->questArray[] = '' . $id . '';
            }
        }
        if ($notelette->location()->pluck('id')->toArray() !== null){
            foreach ($notelette->location()->pluck('id')->toArray() as $id){
                $this->locationArray[] = '' . $id . '';
            }
        }
        if ($notelette->npc()->pluck('id')->toArray() !== null){
            foreach($notelette->npc()->pluck('id')->toArray() as $id){
                $this->npcArray[] = '' . $id . '';
            }
        }
        if ($notelette->item()->pluck('id')->toArray() !== null){
            foreach($notelette->item()->pluck('id')->toArray() as $id){
                $this->itemArray[] = '' . $id . '';
            }
        }
    }

    public function save()
    {
        $newNote = str_replace($this->orig, $this->body, $this->notelette->note()->pluck('body')->first());
        $this->notelette->note()->update(['body' => $newNote]);
        $this->notelette->update(['body' => $this->body]);

        $this->notelette->quest()->detach();
        $this->notelette->location()->detach();
        $this->notelette->npc()->detach();
        $this->notelette->item()->detach();

        $this->notelette->quest()->sync($this->questArray);
        $this->notelette->location()->sync($this->locationArray);
        $this->notelette->npc()->sync($this->npcArray);
        $this->notelette->item()->sync($this->itemArray);

        return redirect('/')->with('success', 'Notelette saved!');
    }

    public function deleteNotelette()
    {
        $this->notelette->delete();
        
        return redirect('/')->with('success', 'Notelette has been deleted!');
    }

    public function closeNotelette()
    {
        $this->showNoteletteEditor = false;
    }

    public function mount()
    {
        if (auth()->check() === true){
            $this->quests = Quest::all()->where('user_id', auth()->user()->id);
            $this->locations = Location::all()->where('user_id', auth()->user()->id);
            $this->npcs = NPC::all()->where('user_id', auth()->user()->id);
            $this->inventoryItems = InventoryItem::all()->where('user_id', auth()->user()->id);
        }
    }

    public function render()
    {
        return view('livewire.notelette-editor');
    }
}
