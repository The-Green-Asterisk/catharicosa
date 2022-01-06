<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\NPC;
use App\Models\Quest;
use Livewire\Component;

class Item extends Component
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

    protected $rules = [
        'heading' => 'required|max:255',
        'description' => 'required',
        'category' => 'required'
    ];

    protected $queryString = ['c' => ['except', '']];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        if ($this->category === 'quest'){
            Quest::create([
                'title' => $this->heading,
                'description' => $this->description,
                'user_id' => auth()->user()->id
            ]);
        }elseif ($this->category === 'npc'){
            NPC::create([
                'name' => $this->heading,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
                'location_id' => $this->location
            ]);
        }elseif ($this->category === 'location'){
            Location::create([
                'name' => $this->heading,
                'description' => $this->description,
                'user_id' => auth()->user()->id
            ]);
        }elseif ($this->category === 'inventory-item'){
            Item::create([
                'name' => $this->heading,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
                'npc_id' => $this->npc,
                'quest' => $this->quest
            ]);
        }

        return redirect('/');
    }

    public function mount()
    {
        $this->locations = Location::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
        $this->npcs = NPC::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
        $this->quests = Quest::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);

        $this->category = preg_replace('/[s]$/','', $this->c);
    }

    public function render()
    {
        return view('livewire.item')->layout('components.layout');
    }
}