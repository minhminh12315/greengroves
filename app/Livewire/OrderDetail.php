<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OrderDetail extends Component
{
    public $order;
    public $orderDetail;

    public function mount($id)
    {
        $this->order = Order::find($id);
        $this->orderDetail = $this->order->orderDetails;
        Log::info($this->orderDetail);
    }
    public function render()
    {
        return view('livewire.order-detail');
    }
}
