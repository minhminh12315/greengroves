<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Variant;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductDetail extends Component
{   
    public $product;
    public $quantity = 1;
    public $selectedOptions = [];
    public $variantOptions = [];
    public $variants= [];
    public $price;

    public function mount($id)
    {
        $this->product = Product::with([
            'productVariants.subVariants.variantOption.variant',
            'productImages'
        ])->find($id);
        $this->variantOptions = $this->product->productVariants
        ->flatMap->subVariants
        ->pluck('variantOption')
        ->unique('id');
        $this->variants = Variant::whereIn('id', $this->variantOptions->pluck('variant_id'))->get();
        
        foreach ($this->variants as $variant) {
            $this->selectedOptions[$variant->id] = null;
        }
    }

    public function increment_quantity()
    {
        $this->quantity++;
    }

    public function decrement_quantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function updated()
    {
        Log::info('selectedOptions: ' . json_encode($this->selectedOptions));
        $this->calculatePrice();
    }

    public function calculatePrice()
    {
        $selectedOptions = $this->selectedOptions;

        if (count($selectedOptions) === count($this->variants)) {
            $productVariant = ProductVariant::where('product_id', $this->product->id)
                ->whereHas('subVariants', function ($query) use ($selectedOptions) {
                    $query->whereIn('variant_option_id', $selectedOptions);
                }, '=', count($selectedOptions))
                ->first();

            if ($productVariant) {
                $this->price = $productVariant->price;
            } else {
                $this->price = 0;
            }
        } else {
            $this->price = 0;
        }
        Log::info('price: ' . $this->price);
    }
    
    
    public function render()
    {
        
        return view('livewire.user.product-detail', [
            'product' => $this->product,
            'variants' => $this->variants,
            'variantOptions' => $this->variantOptions,
            'price' => $this->price,
        ]);
    }
}
