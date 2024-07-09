<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Checkout extends Component
{
    public $cart = [];
    public $checkout = [];
    public $deliveryFee = 0.0;
    public $grandTotal = 0.0;
    public $totalPrice = 0.0;
    public $name;
    public $note;
    public $phone;
    public $address;
    public $street;
    public $city;
    public function mount()
    {
        $this->checkout = session()->get('checkout', []);
        $this->cart = collect(session()->get('cart', []))
            ->filter(function ($item, $key) {
                return in_array($key, $this->checkout);
            })
            ->all();

        Log::info('checkout: ' . json_encode($this->checkout));
        Log::info('cart: ' . json_encode($this->cart));
        $this->calculateTotalPrice();
    }
    public function calculateTotalPrice()
    {
        $this->grandTotal = 0.0;
        foreach ($this->cart as $item) {
            Log::info('item: ' . json_encode($item));
            $this->grandTotal += $item['price'] * $item['quantity'];
        }
        $this->totalPrice = $this->grandTotal + $this->deliveryFee;
        Log::info('grandTotal: ' . $this->grandTotal);
        
    }
    public function checkoutFinal()
    {
        $order = Order::create([
            'user_id' => 1,
            'phone' => $this->phone,
            'address' => $this->address,
            'total' => $this->totalPrice,
            'name' => $this->name,
            'street' => $this->street,
            'city' => $this->city,
            'note' => $this->note,
        ]);

        foreach ($this->cart as $key => $item) {
            if (in_array($key, $this->checkout)) {
                Log::info('key: ' . $key);
                Log::info('item: ' . json_encode($item));
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item['variant_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
    
                // Giảm số lượng của ProductVariant
                $productVariant = ProductVariant::find($item['variant_id']);
                if ($productVariant) {
                    $productVariant->quantity -= $item['quantity'];
                    $productVariant->save();
                }
    
                // Xóa mục khỏi giỏ hàng
                unset($this->cart[$key]);
            }
        }
        session()->put('cart', $this->cart);
        session()->forget('checkout');
    }
    public function render()
    {
        return view('livewire.user.checkout');
    }
}
