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

    public $listProductCategory = false;
    public $category;

    protected $paginationTheme = 'bootstrap'; // Hoặc 'tailwind' nếu bạn sử dụng Tailwind CSS

    public function mount($id = null)
    {
        if ($id) {
            $this->category = Categories::with('children.children')->find($id);
            $this->listProductCategory = true;
        }
    }

    public function render()
    {
        $query = Product::with('productVariants.subVariants.variantOption.variant', 'productImages');

        if ($this->listProductCategory && $this->category) {
            $categoryIds = collect([$this->category->id]);
            foreach ($this->category->children as $child) {
                $categoryIds->push($child->id);
                foreach ($child->children as $child2) {
                    $categoryIds->push($child2->id);
                }
            }
            $query->whereIn('category_id', $categoryIds);
        }

        $products = $query->paginate(12);

        foreach ($products as $product) {
            foreach ($product->productImages as $image) {
                Log::info('Product Image', ['product_id' => $product->id, 'image_path' => $image->path]);
            }
        }

        return view('livewire.user.list-product', ['products' => $products]);
    }
}