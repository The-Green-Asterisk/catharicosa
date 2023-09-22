<?php

namespace App\Http\Livewire;

use App\Models\Notebook;
use Illuminate\Http\Request;
use Livewire\Component;

class NotebookSwitch extends Component
{
    public $notebookId;

    public $notebookName;

    public $notebooks;

    public $name;

    public $url;

    public $n;

    protected $queryString = [
        'n' => ['except' => '']
    ];

    public function notebookSwitch($n)
    {
        $this->n = $n;

        return redirect($this->url . '?n=' . $n);
    }

    public function mount(Request $request)
    {
        if (auth()->check()){
            $this->url = $request->getPathInfo();

            $this->notebookId = $request->query('n');

            if (isset($this->notebookId)){
                $this->notebookName = Notebook::find($this->notebookId)->name;
            }

            $this->notebooks = Notebook::all()->where('user_id', auth()->user()->id);
        }
    }

    public function create()
    {
        $notebook = Notebook::create([
            'user_id' => auth()->user()->id,
            'name' => $this->name
        ]);

        return redirect($this->url . '?n=' . $notebook->id);
    }

    public function update()
    {
        Notebook::find($this->notebookId)->update([
            'name' => $this->notebookName
        ]);

        return redirect($this->url . '?n=' . $this->notebookId);
    }

    public function delete($id)
    {
        Notebook::destroy($id);

        return redirect($this->url);
    }

    public function render()
    {
        return view('livewire.notebook-switch');
    }
}
