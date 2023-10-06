<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $loginForm;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $rememberMe;

    public string $alert;

    public function mount()
    {
        $this->loginForm = config('forms.register');
    }

    public function register()
    {
        $this->validate(config('forms.register.validation'));

        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->rememberMe)) {
                return $this->redirect(route('tasks'), true);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.register');
    }
}
