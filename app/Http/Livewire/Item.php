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

    protected $rules = [
        'heading' => 'required|max:255',
        'description' => 'required',
        'category' => 'required'
    ];

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
        }

        return redirect('/');
    }

    public function mount()
    {
        $this->locations = Location::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
    }

    public function render()
    {
        return view('livewire.item')->layout('components.layout');
    }
}
