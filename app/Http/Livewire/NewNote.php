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
        if ($this->body && $this->title !== null) {
            Note::create([
                'title' => $this->title,
                'body' => nl2br($this->body),
                'user_id' => auth()->user()->id
            ]);
        }else{return;}

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.new-note');
    }
}
