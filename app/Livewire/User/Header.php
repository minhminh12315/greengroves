<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Categories;
use Illuminate\Support\Facades\Log;

class Header extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Categories::whereNull('parent_id')->get();
    }

    public function render()
    {
        return view('livewire.user.header');
    }
}
