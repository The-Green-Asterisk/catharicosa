<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Inventory extends Component
{
    public $inv;

    public $sheetNumber;

    public $error;

    public $name;

    public function mount()
    {
        $this->getInv();
    }

    public function getInv()
    {
        if (isset($this->sheetNumber))
        {
            if ($this->sheetNumber === "")
            {
                $this->error = "";
                return;
            }
            $fileURL = 'https://character-service.dndbeyond.com/character/v3/character/' . $this->sheetNumber;
            if (preg_match('/^[0-9]{8}$/', $this->sheetNumber))
            {
                $charFile = file_get_contents($fileURL);
                $char = json_decode($charFile, false);
            }
            isset($char->success)
                ? $this->inv = $char->data->inventory
                : $this->error = "That's not a valid number";
            isset($char->data->name)
                ? $this->name = $char->data->name
                : $this->name = null;
        }else{
            $this->sheetNumber = "";
            $this->error = "";
        }
    }

    public function render()
    {
        return view('livewire.inventory', [
            'inv' => $this->inv,
            'name' => $this->name
        ]);
    }
}
