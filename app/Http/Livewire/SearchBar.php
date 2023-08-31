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
        if (auth()->check() && $this->term != '' && $this->term != null){
            $searchTerms = explode(' ', $this->term);
            $searchTerm = '%' . str_replace(' ', '%', $this->term) . '%';

            $this->notebook
            ? $noteOutput = Note::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $noteOutput = Note::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10);
            foreach ($noteOutput as $note){
                foreach ($searchTerms as $searchTerm){
                    $note->title = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', $note->title);
                    $note->body = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', substr($note->body, 0, 255));
                }
            }

            $this->notebook
            ? $noteletteOutput = Notelette::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $noteletteOutput = Notelette::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10);
            foreach ($noteletteOutput as $notelette){
                foreach ($searchTerms as $searchTerm){
                    $notelette->body = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', $notelette->description);
                }
            }

            $this->notebook
            ? $npcOutput = NPC::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $npcOutput = NPC::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10);
            foreach ($npcOutput as $npc){
                foreach ($searchTerms as $searchTerm){
                    $npc->name = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', $npc->name);
                    $npc->description = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', substr($npc->description, 0, 255));
                }
            }
            
            $this->notebook
            ? $questOutput = Quest::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $questOutput = Quest::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10);
            foreach ($questOutput as $quest){
                foreach ($searchTerms as $searchTerm){
                    $quest->title = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', $quest->title);
                    $quest->description = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', substr($quest->description, 0, 255));
                }
            }
            
            $this->notebook
            ? $locationOutput = Location::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $locationOutput = Location::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10);
            foreach ($locationOutput as $location){
                foreach ($searchTerms as $searchTerm){
                    $location->name = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', $location->name);
                    $location->description = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', substr($location->description, 0, 255));
                }
            }
            
            $this->notebook
            ? $invItemOutput = InventoryItem::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $invItemOutput = InventoryItem::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10);
            foreach ($invItemOutput as $invItem){
                foreach ($searchTerms as $searchTerm){
                    $invItem->name = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', $invItem->name);
                    $invItem->description = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', substr($invItem->description, 0, 255));
                }
            }
            
            $this->notebook
            ? $organizationOutput = Organization::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10)->where('notebook_id', $this->notebook)
            : $organizationOutput = Organization::search($searchTerm)->where('user_id', auth()->user()->id)->paginate(10);
            foreach ($organizationOutput as $organization){
                foreach ($searchTerms as $searchTerm){
                    $organization->name = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', $organization->name);
                    $organization->description = str_ireplace($searchTerm, '<b>' . $searchTerm . '</b>', substr($organization->description, 0, 255));
                }
            }

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
            $data = [
                'noteOutput' => null,
                'noteletteOutput' => null,
                'npcOutput' => null,
                'questOutput' => null,
                'locationOutput' => null,
                'invItemOutput' => null,
                'organizationOutput' => null
            ];
        }

        return view('livewire.search-bar', $data);
    }
}
