<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $loginForm;
    public $email;
    public $password;
    public $rememberMe;

    public string $alert;

    public function mount()
    {
        $this->loginForm = config('forms.adminLogin');
    }

    public function login()
    {
        // dd($this);
        $this->validate(config('forms.adminLogin.validation'));
        try {
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->rememberMe)) {
                return $this->redirect(route('tasks'), true);
            }
            $this->alert = 'Email or Password is not right please try again.';
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
