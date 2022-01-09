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

        if ($this->catName == null && $this->catName != $catName){
            $this->catName = $catName;
        }
        if ($this->cid == null && $this->cid != $cid){
            $this->cid = $cid;
        }

        if ($this->catName === 'quests'){
            $category = Quest::all()->where('id', $this->cid)->first();
        }elseif ($this->catName === 'npcs'){
            $category = NPC::all()->where('id', $this->cid)->first();
        }elseif ($this->catName === 'locations'){
            $category = Location::all()->where('id', $this->cid)->first();
        }elseif ($this->catName === 'inventory-items'){
            $category = InventoryItem::all()->where('id', $this->cid)->first();
        }

        $this->category = $category;
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
