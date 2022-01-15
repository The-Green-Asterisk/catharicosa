<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\NPC;
use App\Models\Quest;
use Livewire\Component;

class ItemIndex extends Component
{
    public $catName;
    public $query;

    public function mount($category)
    {
        $this->catName = $category;
        $this->query = url('/item?').\Illuminate\Support\Arr::query(['c' => $this->catName]);
    }
    public function render()
    {
        if ($this->catName === 'quests') {
            $categories = Quest::all()->where('user_id', auth()->user()->id);
        }
        if ($this->catName === 'npcs') {
            $categories = NPC::all()->where('user_id', auth()->user()->id);
        }
        if ($this->catName === 'locations') {
            $categories = Location::all()->where('user_id', auth()->user()->id);
        }
        if ($this->catName === 'inventory-items') {
            $categories = InventoryItem::all()->where('user_id', auth()->user()->id);
        }

        $data = [
            'categories' => $categories,
            'catName' => $this->catName
        ];
        
        return view('livewire.item-index', $data)->layout('components.layout');
    }
}
