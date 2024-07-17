<?php

namespace App\Livewire\User;

use App\Models\EmailNotification;
use App\Models\Image;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Home extends Component
{
    public $products;
    public $gardeningtools;

    #[Validate('required|min:5|email')]
    public $emailNotificationToSend;
    protected $listeners = ['notify' => 'notify'];

    public function notify($message)
    {
        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => $message,
            'icon' => 'success',
        ]);
    }
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
        $topProducts = OrderDetail::select('product_variant_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_variant_id')
        ->orderByDesc('total_quantity')
        ->limit(10)
        ->get();
        Log::info('top product: '. $topProducts);
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
