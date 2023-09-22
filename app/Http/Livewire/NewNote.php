<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Livewire\Component;

class NewNote extends Component
{
    public $title = 'Notes for today';

    public $body;

    public $notebooks;

    public $notebookId;

    public function mount(Request $request)
    {
        $this->notebookId = $request->query('n');

        $this->notebooks = Notebook::all()->where('user_id', auth()->user()->id);

        $this->title = 'Notes for ' . now()->tz(auth()->user()->timezone)->toDayDateTimeString();
    }

    public function submit()
    {
        if ($this->body && $this->title !== null) {
            Note::create([
                'title' => $this->title,
                'body' => nl2br($this->body),
                'user_id' => auth()->user()->id,
                'notebook_id' => $this->notebookId
            ]);
        }else{return;}

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.new-note');
    }
}
