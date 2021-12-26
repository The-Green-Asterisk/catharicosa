<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Inventory extends Component
{
    public $inv;

    public function getInv()
    {
        $char_file = file_get_contents('https://character-service.dndbeyond.com/character/v3/character/11600727');
        $char = json_decode($char_file, false);
        $this->inv = $char->data->inventory;
    }

    public function render()
    {
        $this->getInv();

        return view('livewire.inventory', [
            'inv' => $this->inv
        ]);
    }
}
