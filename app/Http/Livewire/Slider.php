<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Slider extends Component
{
    public $categories;

    public $catName;

    public function render()
    {
        return view('livewire.slider', [
            'categories' => $this->categories,
            'catName' => $this->catName
        ]);
    }
}
