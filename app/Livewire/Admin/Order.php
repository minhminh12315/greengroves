<?php

namespace App\Livewire\Admin;

use App\Models\Order as ModelsOrder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Order extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = ModelsOrder::all();
        Log::info($this->orders);
    }
    public function render()
    {
        return view('livewire.admin.order');
    }
}
