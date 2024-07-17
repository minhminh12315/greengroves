<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination;

    public $products;
    public $listProductCategory = false;
    public $category;
    public $test_paginate;

    public function mount($id = null)
    {
        if ($id) {
            $this->products = Product::with('productVariants.subVariants.variantOption.variant', 'productImages')
                ->where('category_id', $id)
                ->get();
            $this->listProductCategory = true;
            $this->category = Categories::find($id);
            foreach ($this->category->children as $child) {
                $this->products = $this->products->merge(Product::with('productVariants.subVariants.variantOption.variant', 'productImages')
                    ->where('category_id', $child->id)
                    ->get());
                    if($child->children){
                        foreach ($child->children as $child2) {
                            $this->products = $this->products->merge(Product::with('productVariants.subVariants.variantOption.variant', 'productImages')
                                ->where('category_id', $child2->id)
                                ->get());
                        }
                    }
            }
        } else {
            $this->products = Product::with('productVariants.subVariants.variantOption.variant', 'productImages')
                ->get();
            $this->listProductCategory = false;
        }
        foreach ($this->products as $product) {
            foreach ($product->productImages as $image) {
                Log::info('Product Image', ['product_id' => $product->id, 'image_path' => $image->path]);
            }
        }
    }

    public function render()
    {
        return view('livewire.user.list-product');
    }
}
