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
            $this->category = Quest::find($this->cid);
        }elseif ($this->catName === 'npcs'){
            $this->category = NPC::find($this->cid);
        }elseif ($this->catName === 'locations'){
            $this->category = Location::find($this->cid);
        }elseif ($this->catName === 'inventory-items'){
            $this->category = InventoryItem::find($this->cid);
        }
    }

    public function deleteItem()
    {
        $name = $this->category->title ?? $this->category->name;
        $this->category->delete();

        return redirect('/')->with('success', $name . ' has been deleted!');
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
