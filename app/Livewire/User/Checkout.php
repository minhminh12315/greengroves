<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
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
    public $email;
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
        $user = Auth::user();
        Log::info('user: ' . json_encode($user));
        $this->email = $user->email ?? $this->email;
        $this->name = $user->fullname ?? $this->name;
        $this->phone = $user->phone ?? $this->phone;
        $this->address = $user->address ?? $this->address;
        $this->street = $user->street ?? $this->street;
        $this->city = $user->city ?? $this->city;
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
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'street' => 'required',
            'city' => 'required',
        ], [
            'name.required' => 'Name is required',
            'phone.required' => 'Phone is required',
            'address.required' => 'Address is required',
            'street.required' => 'Street is required',
            'city.required' => 'City is required',
        ]);
        $userId = Auth::id();
        Log::info($this->name);
        Log::info($this->street);
        Log::info($this->city);
        Log::info($this->note);

        try {
            $order = new Order();
            $order->user_id = $userId;
            $order->phone = $this->phone;
            $order->address = $this->address;
            $order->name = $this->name;
            $order->street = $this->street;
            $order->city = $this->city;
            if ($this->note) {
                $order->note = $this->note;
            }
            $order->total = $this->totalPrice;
            $order->save();
            Log::info('order: ' . json_encode($order));
            $user = Auth::user();
            $user->fullname ??= $this->name;
            $user->phone ??= $this->phone;
            $user->address ??= $this->address;
            $user->street ??= $this->street;
            $user->city ??= $this->city;
            $user->save();

            foreach ($this->cart as $key => $item) {
                if (in_array($key, $this->checkout)) {
                    Log::info('Processing cart item', ['key' => $key, 'item' => $item]); // Log the item structure

                    // Ensure product_variant_id is present in item
                    if (!isset($item['variant_id'])) {
                        Log::error('variant_id missing for cart item', ['key' => $key, 'item' => $item]);
                        continue; // Skip this item if variant_id is missing
                    }

                    try {
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'product_variant_id' => $item['variant_id'], // Ensure this is set correctly
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'total' => $item['price'] * $item['quantity'],
                        ]);

                        // Reduce the quantity of ProductVariant
                        $productVariant = ProductVariant::find($item['variant_id']);
                        if ($productVariant) {
                            $productVariant->quantity -= $item['quantity'];
                            $productVariant->save();
                        }

                        // Remove item from cart
                        unset($this->cart[$key]);
                    } catch (\Exception $e) {
                        Log::error('Error creating OrderDetail', [
                            'order_id' => $order->id,
                            'product_variant_id' => $item['variant_id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'total' => $item['price'] * $item['quantity'],
                            'exception' => $e->getMessage()
                        ]);
                    }
                }
            }
            $this->totalPrice = 0.0;
            $this->grandTotal = 0.0;
            $this->note = '';
            session()->put('cart', $this->cart);
            session()->forget('checkout');
            $this->dispatch('cartUpdated');
            toast()->success('Order placed successfully');
            return redirect()->route('users.home');
        } catch (\Exception $e) {
            Log::error('Error during checkout', [
                'user_id' => $userId,
                'cart' => $this->cart,
                'checkout' => $this->checkout,
                'exception' => $e->getMessage()
            ]);
        }
    }
    public function render()
    {
        return view('livewire.user.checkout');
    }
}
