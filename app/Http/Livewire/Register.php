<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|max:255|confirmed'
    ];

    public function updated($propertyName)
    {
        $propertyName === 'password_confirmation'
            ? $propertyName = 'password'
            : $propertyName = $propertyName;

        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.register')->layout('components.layout');
    }
}
