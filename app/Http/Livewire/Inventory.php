<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Inventory extends Component
{
    public $savedDDB;
    public $inv;
    public $showInv = false;
    public $sheetNumber;
    public $error;
    public $name;
    public $toggle = 0;

    public function mount()
    {
        if (isset(auth()->user()->ddb)){
            $this->sheetNumber = auth()->user()->ddb;
            $this->savedDDB = true;
        }
        $this->getInv();
    }

    public function getInv()
    {
        if (isset($this->sheetNumber))
        {
            if ($this->sheetNumber == "")
            {
                $this->error = null;
                $this->showInv = false;
                return;
            }
            $fileURL = 'https://character-service.dndbeyond.com/character/v3/character/' . $this->sheetNumber;
            if (preg_match('/^[0-9]{8}$/', $this->sheetNumber))
            {
                $charFile = file_get_contents($fileURL);
                $char = json_decode($charFile, false);
                $this->showInv = true;
            }
            if (isset($char->success)){
                $this->inv = $char->data->inventory;
            }else{
                $this->error = "That's not a valid number";
                $this->showInv = false;
            }
            if (isset($char->data->name)){
                $this->name = $char->data->name;
            }else{
                $this->name = null;
                $this->showInv = false;
            }
        }else{
            $this->sheetNumber = "";
            $this->error = null;
            $this->showInv = false;
        }
    }

    public function save()
    {
        if($this->sheetNumber == '' or null){
            $this->sheetNumber = null;
        }else{
            User::where('id', auth()->user()->id)->update(['ddb' => $this->sheetNumber]);
            $this->savedDDB = true;
            $this->getInv();
            return redirect('/')->with('success', 'Your D&D Beyond inventory reference has been saved!');
        }
    }

    public function delete()
    {
        User::where('id', auth()->user()->id)->update(['ddb' => null]);
        $this->savedDDB = false;
        $this->sheetNumber = null;
        $this->getInv();
    }

    public function render()
    {
        return view('livewire.inventory', [
            'inv' => $this->inv,
            'name' => $this->name
        ]);
    }
}
