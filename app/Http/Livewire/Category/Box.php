<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;

class Box extends Component
{
    public $category;

    public function render()
    {
        return view('livewire.category.box', [
            'category' => $this->category
        ]);
    }
}
