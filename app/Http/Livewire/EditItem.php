<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\NPC;
use App\Models\Quest;
use Livewire\Component;

class EditItem extends Component
{
    public $pageHeading = 'What would you like to change about your story?';

    public $heading;
    public $description;
    public $category;
    public $locations;
    public $location;
    public $npcs;
    public $npc;
    public $quests;
    public $quest;
    public $c;
    public $itemId;
    public $libraryItem;

    protected $rules = [
        'heading' => 'required|max:255',
        'description' => 'required',
        'category' => 'required',
        'location' => 'nullable',
        'npc' => 'nullable',
        'quest' => 'nullable'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        if ($this->category != $this->c){
            if ($this->category === 'quest'){
                $newItem = Quest::create([
                    'title' => $this->heading,
                    'description' => $this->description,
                    'npc_id' => $this->npc,
                    'location_id' => $this->location,
                    'user_id' => auth()->user()->id
                ]);
            }elseif ($this->category === 'npc'){
                $newItem = NPC::create([
                    'name' => $this->heading,
                    'description' => $this->description,
                    'user_id' => auth()->user()->id,
                    'location_id' => $this->location
                ]);
            }elseif ($this->category === 'location'){
                $newItem = Location::create([
                    'name' => $this->heading,
                    'description' => $this->description,
                    'user_id' => auth()->user()->id
                ]);
            }elseif ($this->category === 'inventory-item'){
                $newItem = InventoryItem::create([
                    'name' => $this->heading,
                    'description' => $this->description,
                    'user_id' => auth()->user()->id,
                    'npc_id' => $this->npc,
                    'location_id' => $this->location,
                    'quest_id' => $this->quest
                ]);
            }
            foreach($this->libraryItem->notelettes as $notelette){
                $newItem->notelettes()->attach($notelette);
            }
            $this->libraryItem->delete();
        }else{
            if ($this->category === 'quest'){
                $this->libraryItem->update([
                    'user_id' => auth()->user()->id,
                    'title' => $this->heading,
                    'description' => $this->description,
                    'npc_id' => $this->npc,
                    'location_id' => $this->location,
                ]);
            }elseif ($this->category === 'npc'){
                $this->libraryItem->update([
                    'user_id' => auth()->user()->id,
                    'name' => $this->heading,
                    'description' => $this->description,
                    'location_id' => $this->location
                ]);
            }elseif ($this->category === 'location'){
                $this->libraryItem->update([
                    'user_id' => auth()->user()->id,
                    'name' => $this->heading,
                    'description' => $this->description,
                ]);
            }elseif ($this->category === 'inventory-item'){
                $this->libraryItem->update([
                    'user_id' => auth()->user()->id,
                    'name' => $this->heading,
                    'description' => $this->description,
                    'npc_id' => $this->npc,
                    'quest_id' => $this->quest,
                    'location_id' => $this->location
                ]);
            }
        }

        return redirect('/')->with('success', 'Your adventure journal has been successfully updated!');
    }

    public function mount($category, $item)
    {
        $this->c = $category;
        $this->itemId = $item;

        $this->locations = Location::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
        $this->npcs = NPC::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
        $this->quests = Quest::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);

        $this->category = preg_replace('/[s]$/','', $this->c);

        if ($this->category == 'quest'){
            $this->libraryItem = Quest::all()->where('id', $this->itemId)->first();
        }
        if ($this->category == 'location'){
            $this->libraryItem = Location::all()->where('id', $this->itemId)->first();
        }
        if ($this->category == 'npc'){
            $this->libraryItem = NPC::all()->where('id', $this->itemId)->first();
        }
        if ($this->category == 'inventory-item'){
            $this->libraryItem = InventoryItem::all()->where('id', $this->itemId)->first();
        }

        $this->heading = $this->libraryItem->name ?? $this->libraryItem->title;
        $this->description = $this->libraryItem->description;
        $this->location = $this->libraryItem->location->id ?? null;
        $this->npc = $this->libraryItem->npc->id ?? null;
        $this->quest = $this->libraryItem->quest->id ?? null;
    }

    public function render()
    {
        return view('livewire.item')->layout('components.layout');
    }
}
