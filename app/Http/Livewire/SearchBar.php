<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\NPC;
use App\Models\Quest;
use Livewire\Component;

class SearchBar extends Component
{
    public $term = '';

    public function clear()
    {
        $this->term = '';
    }

    public function render()
    {
        if (auth()->check()){
            $npcOutput = NPC::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $questOutput = Quest::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $locationOutput = Location::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $invItemOutput = InventoryItem::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);

            $data = [
                'npcOutput' => $npcOutput,
                'questOutput' => $questOutput,
                'locationOutput' => $locationOutput,
                'invItemOutput' => $invItemOutput
            ];
        }else{
            $data = ['cocnut' => 'lime'];
        }

        return view('livewire.search-bar', $data);
    }
}
