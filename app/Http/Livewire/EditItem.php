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
    public $notebooks;
    public $notebook;
    public $notebookId;
    public $organizations;
    public $organization;

    protected $rules = [
        'heading' => 'required|max:255',
        'description' => 'required',
        'category' => 'required',
        'location' => 'nullable',
        'npc' => 'nullable',
        'quest' => 'nullable',
        'organization' => 'nullable',
        'notebook' => 'nullable'
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
                    'user_id' => auth()->user()->id,
                    'notebook_id' => $this->notebook
                ]);
            }elseif ($this->category === 'npc'){
                $newItem = NPC::create([
                    'name' => $this->heading,
                    'description' => $this->description,
                    'user_id' => auth()->user()->id,
                    'location_id' => $this->location,
                    'organization_id' => $this->organization,
                    'notebook_id' => $this->notebook
                ]);
            }elseif ($this->category === 'location'){
                $newItem = Location::create([
                    'name' => $this->heading,
                    'description' => $this->description,
                    'user_id' => auth()->user()->id,
                    'notebook_id' => $this->notebook
                ]);
            }elseif ($this->category === 'inventory-item'){
                $newItem = InventoryItem::create([
                    'name' => $this->heading,
                    'description' => $this->description,
                    'user_id' => auth()->user()->id,
                    'npc_id' => $this->npc,
                    'location_id' => $this->location,
                    'quest_id' => $this->quest,
                    'notebook_id' => $this->notebook
                ]);
            }elseif ($this->category === 'organization'){
                $newItem = Organization::create([
                    'name' => $this->heading,
                    'description' => $this->description,
                    'user_id' => auth()->user()->id,
                    'location_id' => $this->location,
                    'notebook_id' => $this->notebook
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
                    'notebook_id' => $this->notebook
                ]);
            }elseif ($this->category === 'npc'){
                $this->libraryItem->update([
                    'user_id' => auth()->user()->id,
                    'name' => $this->heading,
                    'description' => $this->description,
                    'location_id' => $this->location,
                    'organization_id' => $this->organization,
                    'notebook_id' => $this->notebook
                ]);
            }elseif ($this->category === 'location'){
                $this->libraryItem->update([
                    'user_id' => auth()->user()->id,
                    'name' => $this->heading,
                    'description' => $this->description,
                    'notebook_id' => $this->notebook
                ]);
            }elseif ($this->category === 'inventory-item'){
                $this->libraryItem->update([
                    'user_id' => auth()->user()->id,
                    'name' => $this->heading,
                    'description' => $this->description,
                    'npc_id' => $this->npc,
                    'quest_id' => $this->quest,
                    'location_id' => $this->location,
                    'notebook_id' => $this->notebook
                ]);
            }elseif ($this->category === 'organization'){
                $this->libraryItem->update([
                    'user_id' => auth()->user()->id,
                    'name' => $this->heading,
                    'description' => $this->description,
                    'location_id' => $this->location,
                    'notebook_id' => $this->notebook
                ]);
            }
        }

        return redirect('/')->with('success', 'Your adventure journal has been successfully updated!');
    }

    public function deleteItem()
    {
        $name = $this->libraryItem->name ?? $this->libraryItem->title;
        $this->libraryItem->delete();

        return redirect('/')->with('success', $name . ' has been deleted!');
    }

    public function mount($category, $item, Request $request)
    {
        $this->notebookId = $request->query('n');
        $this->c = $category;
        $this->itemId = $item;

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

        if ($this->category == 'quest'){
            $this->libraryItem = Quest::find($this->itemId);
        }
        if ($this->category == 'location'){
            $this->libraryItem = Location::find($this->itemId);
        }
        if ($this->category == 'npc'){
            $this->libraryItem = NPC::find($this->itemId);
        }
        if ($this->category == 'inventory-item'){
            $this->libraryItem = InventoryItem::find($this->itemId);
        }
        if ($this->category == 'organization'){
            $this->libraryItem = Organization::find($this->itemId);
        }
        $this->heading = $this->libraryItem->name ?? $this->libraryItem->title;
        $this->description = $this->libraryItem->description;
        $this->location = $this->libraryItem->location_id ?? null;
        $this->npc = $this->libraryItem->npc_id ?? null;
        $this->quest = $this->libraryItem->quest_id ?? null;
        $this->notebook = $this->libraryItem->notebook_id ?? null;
        $this->organization = $this->libraryItem->organization_id ?? null;
    }

    public function render()
    {
        return view('livewire.item')->layout('components.layout');
    }
}
