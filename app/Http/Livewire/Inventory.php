<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Livewire\Component;

class Inventory extends Component
{
    public $savedDDB;
    public $showInv = false;
    public $sheetNumber;
    public $error;
    public $name;

    public $catName;

    public $toggle;

    public $inventoryItems;

    public $query;

    public $notebook;

    public function mount(Request $request)
    {
        auth()->user()->inv ? $this->toggle = auth()->user()->inv : $this->toggle = 0;

        if (isset(auth()->user()->ddb)){
            $this->sheetNumber = auth()->user()->ddb;
            $this->savedDDB = true;
        }

        $this->notebook = $request->query('n');

        $this->getInv();

        $this->query = url('/item?').Arr::query(['c' => $this->catName]);
    }

    public function prev()
    {
        User::where('id', auth()->user()->id)->update(['inv' => $this->toggle]);
    }

    public function getInv()
    {
        cache()->remember('ddb.{auth()->user()->id}', now()->addHours(3), function () {
            if (isset($this->sheetNumber)){
                if ($this->sheetNumber == ""){
                    $this->error = null;
                    $this->showInv = false;
                    return;
                }
                $fileURL = 'https://character-service.dndbeyond.com/character/v3/character/' . $this->sheetNumber;
                if (preg_match('/^[0-9]{8}$/', $this->sheetNumber)){
                    $charFile = @file_get_contents($fileURL);
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
        });

        $this->notebook
        ? $this->inventoryItems = InventoryItem::all()->where('user_id', auth()->user()->id)->where('notebook_id', $this->notebook)
        : $this->inventoryItems = InventoryItem::all()->where('user_id', auth()->user()->id);
    }

    public function import()
    {
        if (isset($this->inv)){
            foreach ($this->inv as $item){
                InventoryItem::create([
                    'name' => Arr::get($item['definition'], 'name', 'testing'),
                    'description' => Arr::get($item['definition'], 'description', 'testing'),
                    'user_id' => auth()->user()->id,
                    'notebook_id' => $this->notebook
                ]);
            }
            $this->toggle = 1;
            $this->getInv();
        }else{
            $this->error = "There's nothing to import.";
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
            'name' => $this->name
        ]);
    }
}
