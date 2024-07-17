<?php

namespace App\Livewire;

use App\Livewire\Admin\Order;
use App\Models\Order as ModelsOrder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ListOrder extends Component
{
    public $orders;
    public function mount()
    {
        $this->orders = ModelsOrder::where('user_id', auth()->id())->get();
        Log::info($this->orders);
    }
    public function render()
    {
        return view('livewire.list-order');
    }
}
