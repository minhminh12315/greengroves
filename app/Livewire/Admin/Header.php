<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Renderless;
use Livewire\Component;

class Header extends Component
{
    #[Renderless]
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.admin.header');
    }
}
