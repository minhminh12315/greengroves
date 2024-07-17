<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $products;
    public $product;
    public $update_quantity;
    public $update_price;
    public $variantId;
    public $product_name;
    public $product_description;
    public $product_category;
    public $product_images;
    public $categories;
    public $product_old_images = [];

    public function editVariant($variantId)
    {
        $this->variantId = $variantId;
        $variant = ProductVariant::find($variantId);
        $this->update_quantity = $variant->quantity;
        $this->update_price = $variant->price;
        $this->product_name = $variant->product->name;
        $this->product_description = $variant->product->description;
        $this->product_category = $variant->product->category;
        $this->product_old_images = $variant->product->productImages()->pluck('path')->toArray();
        Log::info('Product old images', ['images' => $this->product_old_images]);
    }
    public function updateVariant()
    {
        $this->validate([
            'update_quantity' => 'required|numeric',
            'update_price' => 'required|numeric',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_category' => 'required',
            'product_images' => 'nullable',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'update_quantity.required' => 'The Quantity field is required.',
            'update_quantity.numeric' => 'The Quantity field must be a number.',
            'update_price.required' => 'The Price field is required.',
            'update_price.numeric' => 'The Price field must be a number.',
            'product_name.required' => 'The Product Name field is required.',
            'product_description.required' => 'The Product Description field is required.',
            'product_category.required' => 'The Product Category field is required.',
            'product_images.image' => 'The Product Image must be an image.',
            'product_images.mimes' => 'The Product Image must be a file of type: jpeg, png, jpg, gif, svg.',
            'product_images.max' => 'The Product Image must not be greater than 2048 kilobytes.',
        ]);
        $variant = ProductVariant::find($this->variantId);
        $variant->update([
            'quantity' => $this->update_quantity,
            'price' => $this->update_price,
        ]);
        $product = Product::find($variant->product_id);
        $product->update([
            'name' => $this->product_name,
            'description' => $this->product_description,
            'category' => $this->product_category,
        ]);
        if ($this->product_images) {
            foreach ($this->product_images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/assets/images', $imageName);
                Log::info('Image moved', ['image' => $imagePath]);
                $publicPath = 'assets/images/' . $imageName;
                Log::info('Image path', ['path' => $publicPath]);

                $image = new ProductImage();
                $image->product_id = $product->id;
                foreach ($product->productImages as $pi) {
                    $pi->delete();
                }
                $image->path = $publicPath;
                $image->save();
            }
        }
        $this->product_images = null;
        $this->dispatch('closeModal');
        $this->mount();
    }

    #[Renderless]
    public function confirmDelete($variantId)
    {
        $this->variantId = $variantId;
    }

    public function deleteVariant()
    {
        $variant = ProductVariant::find($this->variantId);
        $variant->delete();
        if ($variant->product->productVariants->count() == 0) {
            $variant->product->delete();
        }
        $this->dispatch('closeModal');
        $this->mount();
    }

    public function mount()
    {
        $this->categories = Categories::all();
        $this->products = Product::with([
            'productVariants.subVariants.variantOption.variant'
        ])->get();
        $variant = ProductVariant::all();
        $product = Product::all();
    }

    public function render()
    {
        $products = Product::with([
            'productVariants.subVariants.variantOption.variant'
        ]);

        return view('livewire.admin.list-product', ['products' => $products]);
    }
}
