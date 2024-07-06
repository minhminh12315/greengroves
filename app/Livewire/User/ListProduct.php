<?php

namespace App\Livewire\User;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ListProduct extends Component
{   
    public $product;
    public function render()
    {   
        $this->product = Product::with('productVariants.subVariants.variantOption.variant')->get();
        foreach($this->product as $product){
            Log::info($product);
            Log::info($product->productVariants);
        }

        $data = [
            'products' => $this->product
        ];
        return view('livewire.user.list-product', $data);
    }
}
