<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\Note;
use App\Models\Notelette;
use App\Models\NPC;
use App\Models\Organization;
use App\Models\Quest;
use Illuminate\Http\Request;
use Livewire\Component;

class SearchBar extends Component
{
    public $term = '';
    public $notebook;

    public function clear()
    {
        $this->term = '';
    }

    public function mount(Request $request)
    {
        $this->notebook = $request->query('n');
    }

    public function render()
    {
        if (auth()->check()){
            $this->notebook
            ? $noteOutput = Note::search($this->term)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $noteOutput = Note::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $this->notebook
            ? $noteletteOutput = Notelette::search($this->term)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $noteletteOutput = Notelette::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $this->notebook
            ? $npcOutput = NPC::search($this->term)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $npcOutput = NPC::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $this->notebook
            ? $questOutput = Quest::search($this->term)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $questOutput = Quest::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $this->notebook
            ? $locationOutput = Location::search($this->term)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $locationOutput = Location::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $this->notebook
            ? $invItemOutput = InventoryItem::search($this->term)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $invItemOutput = InventoryItem::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);
            $this->notebook
            ? $organizationOutput = Organization::search($this->term)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $organizationOutput = Organization::search($this->term)->where('user_id', auth()->user()->id)->paginate(10);

            $data = [
                'noteOutput' => $noteOutput,
                'noteletteOutput' => $noteletteOutput,
                'npcOutput' => $npcOutput,
                'questOutput' => $questOutput,
                'locationOutput' => $locationOutput,
                'invItemOutput' => $invItemOutput,
                'organizationOutput' => $organizationOutput
            ];
        }else{
            $data = ['coconut' => 'lime'];
        }

        return view('livewire.search-bar', $data);
    }
}
