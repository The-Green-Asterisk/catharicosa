<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\NPC;
use App\Models\Quest;
use Livewire\Component;

class Modal extends Component
{
    public $show = false;

    public $category;

    public $cid;

    public $catName;

    protected $listeners = ['showModal', 'closeModal'];

    protected $queryString = [
        'catName' => ['except' => ''],
        'cid' => ['except' => '']
    ];

    public function closeModal()
    {
        $this->catName = '';
        $this->cid = '';
        $this->show = false;
    }

    public function showModal($catName, $cid)
    {
        $this->show = true;
        $this->catName ?? $this->catName = $catName;
        $this->cid ?? $this->cid = $cid;

        if ($this->catName === 'quests'){
            $category = Quest::all()->where('id', $this->cid);
        }elseif ($this->catName === 'npcs'){
            $category = NPC::all()->where('id', $this->cid);
        }elseif ($this->catName === 'locations'){
            $category = Location::all()->where('id', $this->cid);
        }elseif ($this->catName === 'inventory-items'){
            $category = InventoryItem::all()->where('id', $this->cid);
        }

        $this->category = $category->first();
    }

    public function deleteItem()
    {
        $this->category->delete();
        return redirect('/')->with('success', 'Item has been deleted!');
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
