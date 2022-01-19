<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\Notebook;
use App\Models\NPC;
use App\Models\Organization;
use App\Models\Quest;
use Illuminate\Http\Request;
use Livewire\Component;

class Item extends Component
{
    public $pageHeading = 'Do tell the tail of this fantastic new entry into your journal!';

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
    public $notebooks;
    public $notebookId;

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
                'npc_id' => $this->npc,
                'location_id' => $this->location,
                'user_id' => auth()->user()->id,
                'notebook_id' => $this->notebookId
            ]);
        }elseif ($this->category === 'npc'){
            NPC::create([
                'name' => $this->heading,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
                'location_id' => $this->location,
                'notebook_id' => $this->notebookId
            ]);
        }elseif ($this->category === 'location'){
            Location::create([
                'name' => $this->heading,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
                'notebook_id' => $this->notebookId
            ]);
        }elseif ($this->category === 'inventory-item'){
            InventoryItem::create([
                'name' => $this->heading,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
                'npc_id' => $this->npc,
                'location_id' => $this->location,
                'quest_id' => $this->quest,
                'notebook_id' => $this->notebookId
            ]);
        }elseif ($this->category === 'organization'){
            Organization::create([
                'name' => $this->heading,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
                'npc_id' => $this->npc,
                'location_id' => $this->location,
                'notebook_id' => $this->notebookId
            ]);
        }

        return redirect('/')->with('success', $this->heading . ' has been created!');
    }

    public function mount(Request $request)
    {
        $this->notebookId = $request->query('n');
        $this->notebookId
        ? $this->locations = Location::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1)->where('notebook_id', $this->notebookId)
        : $this->locations = Location::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
        $this->notebookId
        ? $this->npcs = NPC::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1)->where('notebook_id', $this->notebookId)
        : $this->npcs = NPC::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
        $this->notebookId
        ? $this->quests = Quest::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1)->where('notebook_id', $this->notebookId)
        : $this->quests = Quest::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
        $this->notebookId
        ? $this->organizations = Organization::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1)->where('notebook_id', $this->notebookId)
        : $this->organizations = Organization::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);
        $this->notebooks = Notebook::all()->where('user_id', auth()->user()->id)->sortBy('name', SORT_REGULAR, 1);

        $this->category = preg_replace('/[s]$/','', $this->c);
    }

    public function render()
    {
        return view('livewire.item')->layout('components.layout');
    }
}
