<?php

namespace App\Http\Livewire;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Session extends Component
{
    public $email;

    public $password;

    public $remember = false;

    protected $rules = [
        'email' => 'required|email|exists:users,email',
        'password' => 'required'
    ];

    protected $listeners = ['sessionStore' => 'store'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        if (auth()->attempt($this->validate(), $this->remember)) {
            session()->regenerate();
            redirect('/')->with('success', 'Welcome back, traveler! I\'ve kept your seat warm, and your stein cold!');
        }else{
            throw ValidationException::withMessages([
                'password' => 'I\'m sorry, I couldn\'t validate that information. Try again.'
            ]);
        };
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Safe journies, friend! You\'ll always have an open tab here!');
    }

    public function render()
    {
        return view('livewire.session')->layout('components.layout');
    }
}
