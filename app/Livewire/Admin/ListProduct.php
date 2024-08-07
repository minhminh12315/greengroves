<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $product;
    public $update_quantity;
    public $update_price;
    public $variantId;
    public $product_name;
    public $product_description;
    public $product_category;
    public $product_images;
    public $categories;
    public $new_category;
    public $product_old_images = [];
    public $type = 'all';
    protected $paginationTheme = 'bootstrap';

    public function editVariant($variantId)
    {
        // $this->editVariantModal = true;
        $this->variantId = $variantId;
        $variant = ProductVariant::find($variantId);
        $this->update_quantity = $variant->quantity;
        $this->update_price = $variant->price;
        $this->product_name = $variant->product->name;
        $this->product_description = $variant->product->description;
        $this->product_category = $variant->product->category;
        $this->product_old_images = $variant->product->productImages()->pluck('path')->toArray();
        Log::info('Product old images', ['images' => $this->product_old_images]);
        $this->dispatch('toggleModalEdit')->self();
        Log::info('category', ['category' => $this->product_category]);
    }
    public function updateVariant()
    {
        $this->validate([
            'update_quantity' => 'required|numeric',
            'update_price' => 'required|numeric',
            'product_name' => 'required',
            'product_description' => 'required',
            'new_category' => 'required',
            'product_images' => 'nullable',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'update_quantity.required' => 'The Quantity field is required.',
            'update_quantity.numeric' => 'The Quantity field must be a number.',
            'update_price.required' => 'The Price field is required.',
            'update_price.numeric' => 'The Price field must be a number.',
            'product_name.required' => 'The Product Name field is required.',
            'product_description.required' => 'The Product Description field is required.',
            'new_category.required' => 'The Product Category field is required.',
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
        $product->name = $this->product_name;
        $product->description = $this->product_description;
        $product->category_id = $this->new_category;
        $product->save();
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
        $this->variantId = null;
        $this->update_quantity = null;
        $this->update_price = null;
        $this->product_name = null;
        $this->product_description = null;
        $this->new_category = null;
        $this->product_old_images = [];
        $this->dispatch('closModal')->self();
        $this->dispatch('reload')->self();
        $this->mount();
    }
    public function confirmDelete($variantId)
    {
        $this->variantId = $variantId;
        $this->dispatch('toggleModalDelete')->self();
    }

    public function deleteVariant()
    {
        $variant = ProductVariant::find($this->variantId);

        if ($variant) {
            $product = $variant->product;
            $variant->delete();

            if ($product->productVariants->count() == 0) {
                $product->delete();
            }
        } else {
            // Handle case where variant is not found
            session()->flash('error', 'Variant not found.');
        }
        $this->dispatch('closModal')->self();
        $this->dispatch('reload')->self();
    }
    public function mount()
    {
        $this->categories = Categories::all();
    }

    public function render()
    {
        $products = Product::with('productVariants.subVariants.variantOption.variant', 'productImages', 'category')->paginate(5);
        return view('livewire.admin.list-product', [
            'products' => $products,
        ]);
    }
}
