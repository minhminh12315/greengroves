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
        if (session()->has('cart')) {
            session()->forget('cart');
        }
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.admin.header');
    }
    public function setting_user()
    {
        return redirect()->route('setting_user');
    }
}
