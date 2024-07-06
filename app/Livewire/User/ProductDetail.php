<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductDetail extends Component
{   
    public $product;
    public $quantity = 1;
    public $selectedOptions = [];
    public $variantOptions;
    public $variants;
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

        // Initialize price based on selected options
        $this->updatePrice();
    }
    
    public function updatePrice()
    {
        // Check if all variants have been selected
        if (count(array_filter($this->selectedOptions)) == $this->variants->count()) {
            // Fetch the corresponding product variant based on selected options
            $productVariant = $this->product->productVariants->first(function ($variant) {
                // Check if the variant_option_id matches all selected option ids
                return collect($variant->subVariants->pluck('variantOption_id'))
                    ->every(fn ($id) => $id == $this->selectedOptions[$variant->id]);
            });

            if ($productVariant) {
                $this->price = $productVariant->price;
            }
        }
    }

    public function update($propertyName)
    {
        // Validate changes in quantity
        $this->validateOnly($propertyName, [
            'quantity' => 'required|numeric|min:1',
        ]);
        
        // Update price when selectedOptions change
        if (strpos($propertyName, 'selectedOptions') !== false) {
            $this->updatePrice();
        }
        
        Log::info($this->selectedOptions);
    }
    public function render()
    {
        
        return view('livewire.user.product-detail');
    }
}
