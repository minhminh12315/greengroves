<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Sidebar extends Component
{
    public function displayMainSettingContent(){
        $this->dispatch('showMainSettingContent');
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
}
