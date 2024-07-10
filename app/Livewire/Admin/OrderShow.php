<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Component;

class OrderShow extends Component
{
    public $order;
    public $orderDetails;
    public function mount($id)
    {
        $this->order = Order::find($id);
        $this->orderDetails = OrderDetail::where('order_id', $id)->get();
        
    }
    public function render()
    {
        return view('livewire.admin.order-show');
    }
}
