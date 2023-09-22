<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;

class Box extends Component
{
    public $category;

    public $catName;

    public function render()
    {
        return view('livewire.category.box', [
            'category' => $this->category,
            'catName' => $this->catName
        ]);
    }
}
