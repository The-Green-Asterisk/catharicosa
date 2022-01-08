<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\NPC;
use App\Models\Quest;
use Livewire\Component;

class EditItem extends Component
{
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

    public function update()
    {
        $this->validate();

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
        return view('livewire.edit-item')->layout('components.layout');
    }
}
