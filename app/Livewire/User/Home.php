<?php

namespace App\Livewire\User;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Home extends Component
{
    public $products;
    public $gardeningtools;
    public function mount()
    {
        $this->products = Product::with([
            'productVariants.subVariants.variantOption.variant',
            'productImages'
        ])->limit(10)->get();
        $this->gardeningtools = Product::where('category_id', 1)->orderBy('created_at', 'desc')->limit(8)->get();

    }
    public function render()
    {
        $carouselImages = Image::where('type', 'slide')->get();

        return view('livewire.user.home', ['products' => $this->products, 'carouselImages' => $carouselImages]);
    }
}
