<?php

namespace App\Http\Livewire;

use App\Models\Note;
use Livewire\Component;

class NewNote extends Component
{
    public $title = 'Notes for today';

    public $body;

    public function mount()
    {
        $this->title = 'Notes for ' . now()->toDayDateTimeString();
    }

    public function submit()
    {
        Note::create([
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.new-note');
    }
}
