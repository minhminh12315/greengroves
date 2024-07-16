<?php

namespace App\Livewire\User;

use App\Models\EmailNotification;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Home extends Component
{
    public $products;
    public $gardeningtools;

    #[Validate('required|min:5|email')]
    public $emailNotificationToSend;

    public function subcribe()
    {
        $this->validate();

        $emailNotification = new EmailNotification();
        $emailNotification->email = $this->pull('emailNotificationToSend');
        $emailNotification->save();

        $this->dispatch('swalsuccess', [
            'title' => 'Subscribed!',
            'text' => 'You have successfully subscribed to our newsletter.',
            'icon' => 'success',
        ]);
    }
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
