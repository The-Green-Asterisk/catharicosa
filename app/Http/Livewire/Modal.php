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
        $this->catName = $catName;
        $this->cid = $cid;

        if ($catName === 'quests'){
            $category = Quest::all()->where('id', $cid);
        }elseif ($catName === 'npcs'){
            $category = NPC::all()->where('id', $cid);
        }elseif ($catName === 'locations'){
            $category = Location::all()->where('id', $cid);
        }elseif ($catName === 'inventory-items'){
            $category = InventoryItem::all()->where('id', $cid);
        }

        $this->category = $category->first();
    }

    public function render()
    {
        return view('livewire.modal', [
            'category' => $this->category
        ]);
    }
}
