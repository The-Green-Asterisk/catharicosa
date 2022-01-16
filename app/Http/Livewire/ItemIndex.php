<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\NPC;
use App\Models\Organization;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Livewire\Component;

class ItemIndex extends Component
{
    public $catName;
    public $query;
    public $notebook;

    public function mount($category, Request $request)
    {
        $this->notebook = $request->query('n');
        $this->catName = $category;
        $this->query = url('/item?').Arr::query(['c' => $this->catName]);
    }
    public function render()
    {
        if ($this->catName === 'quests') {
            $this->notebook
            ? $categories = Quest::all()->where('user_id', auth()->user()->id)->where('notebook_id', $this->notebook)
            : $categories = Quest::all()->where('user_id', auth()->user()->id);
        }
        if ($this->catName === 'npcs') {
            $this->notebook
            ? $categories = NPC::all()->where('user_id', auth()->user()->id)->where('notebook_id', $this->notebook)
            : $categories = NPC::all()->where('user_id', auth()->user()->id);
        }
        if ($this->catName === 'locations') {
            $this->notebook
            ? $categories = Location::all()->where('user_id', auth()->user()->id)->where('notebook_id', $this->notebook)
            : $categories = Location::all()->where('user_id', auth()->user()->id);
        }
        if ($this->catName === 'inventory-items') {
            $this->notebook
            ? $categories = InventoryItem::all()->where('user_id', auth()->user()->id)->where('notebook_id', $this->notebook)
            : $categories = InventoryItem::all()->where('user_id', auth()->user()->id);
        }
        if ($this->catName === 'organizations') {
            $this->notebook
            ? $categories = Organization::all()->where('user_id', auth()->user()->id)->where('notebook_id', $this->notebook)
            : $categories = Organization::all()->where('user_id', auth()->user()->id);
        }

        $data = [
            'categories' => $categories,
            'catName' => $this->catName
        ];

        return view('livewire.item-index', $data)->layout('components.layout');
    }
}
