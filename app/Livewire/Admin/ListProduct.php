<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination;

    public $products;
    public $editVariantModal = false;

    public $deleteVariantModal = false;
    public $product;
    public $update_quantity;
    public $update_price;
    public $variantId;
    public function editVariant($variantId)
    {
        $this->editVariantModal = true;
        $this->variantId = $variantId;
        $variant = ProductVariant::find($variantId);
        $this->update_quantity = $variant->quantity;
        $this->update_price = $variant->price;
    }
    public function hideModal()
    {
        $this->editVariantModal = false;
    }
    public function updateVariant()
    {
        $variant = ProductVariant::find($this->variantId);
        $variant->update([
            'quantity' => $this->update_quantity,
            'price' => $this->update_price,
        ]);

        $this->editVariantModal = false;
        $this->mount();
    }
    public function confirmDelete($variantId)
    {
        $this->variantId = $variantId;
        $this->deleteVariantModal = true;
    }

    public function deleteVariant()
    {
        $variant = ProductVariant::find($this->variantId);
        $variant->delete();
        if($variant->product->productVariants->count() == 0){
            $variant->product->delete();
        }
        $this->deleteVariantModal = false;
        $this->mount();
    }

    public function hideDeleteModal()
    {
        $this->deleteVariantModal = false;
    }
    public function mount()
    {
        $this->products = Product::with([
            'productVariants.subVariants.variantOption.variant'
        ])->get();
        $variant = ProductVariant::all();
        $product = Product::all();
        foreach($product as $p){
            if ($p->productVariants()->exists() === false) {
                $p->delete();
            }
        }
    }

    public function render()
    {
        $products = Product::with([
            'productVariants.subVariants.variantOption.variant'
        ]);
    
        return view('livewire.admin.list-product', ['products' => $products]);
    }
}
