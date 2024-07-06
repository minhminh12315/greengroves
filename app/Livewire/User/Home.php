<?php

namespace App\Livewire\User;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Home extends Component
{
    public $products;

    public function render()
    {
        // Tải tất cả sản phẩm cùng với các biến thể và hình ảnh
        $this->products = Product::with([
            'productVariants.subVariants.variantOption.variant',
            'productImages'
        ])->get();

        $carouselImages = Image::where('type', 'slide')->get();

        // Logging thông tin
        foreach($this->products as $product){
            foreach($product->productImages as $image){
                Log::info('images: ' . $image->path);
            }
        }

        return view('livewire.user.home', ['products' => $this->products, 'carouselImages' => $carouselImages]);
    }
}
