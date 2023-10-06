<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Permission;


class AdminDynamicMenu extends Component
{

    public function logout()
    {
        auth()->logout();
        return $this->redirect(route('login'), true);
    }

    public function render()
    {
        return view(
            'livewire.components.admin-dynamic-menu'
        );
    }
}
