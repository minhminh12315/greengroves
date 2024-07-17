<?php

namespace App\Livewire\User;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CartShop extends Component
{
    public $cart = [];
    public $totalPrice = 0.0;
    public $selectedItems = [];
    public $quantities = [];
    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
    {
        $this->updateCart();
        $this->cart = session()->get('cart', []);

        foreach ($this->cart as $key => $item) {
            $this->quantities[$key] = $item['quantity'];
        }
        $this->calculateTotalPrice();
    }
    public function select_all()
    {
        if(count($this->cart) == count($this->selectedItems)) {
            $this->selectedItems = [];
        } else {
            $this->selectedItems = array_keys($this->cart);
        }
    }
    public function clearAllCart()
    {
        session()->forget('cart');
        $this->cart = [];
        $this->quantities = [];
        $this->totalPrice = 0.0;
        $this->dispatch('cartUpdated');
        $this->updateCart();
    }
    public function updateCart()
    {
        $this->cart = session()->get('cart', []);
        $this->calculateTotalPrice();
    }
    public function removeItem($variantId)
    {
        if(isset($this->cart[$variantId])) {
            unset($this->cart[$variantId]);
            session()->put('cart', $this->cart);
        }
        $this->dispatch('cartUpdated');
        $this->calculateTotalPrice();
    }
    public function updatedQuantities()
    {
        foreach ($this->quantities as $key => $quantity) {
            if (isset($this->cart[$key])) {
                $this->cart[$key]['quantity'] = $quantity;
            }
        }
        if(count($this->cart) == 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $this->cart);
        }
        $this->calculateTotalPrice();
    }

    public function incrementQuantity($variantId)
    {
        if (isset($this->quantities[$variantId])) {
            if(ProductVariant::find($variantId)->quantity > $this->quantities[$variantId]) {
                $this->quantities[$variantId]++;
                $this->updatedQuantities();
            } else {
                session()->flash('errorQuantity', 'Số lượng sản phẩm không đủ');
            }
        }
    }

    public function decrementQuantity($variantId)
    {
        if (isset($this->quantities[$variantId]) && $this->quantities[$variantId] > 1) {
            $this->quantities[$variantId]--;
            $this->updatedQuantities();
        }
    }
    public function calculateTotalPrice()
    {
        $this->totalPrice = 0.0;
        foreach ($this->cart as $item) {
            $this->totalPrice += $item['price'] * $item['quantity'];
        }
    }
    public function checkout()
    {
        session()->put('checkout', $this->selectedItems);
        return redirect()->route('users.checkout');
    }
    public function render()
    {
        $totalPrice = 0;
        foreach ($this->cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('livewire.user.cartShop', [
            'cart' => $this->cart,
            'totalPrice' => $totalPrice,
        ]);
    }
}
