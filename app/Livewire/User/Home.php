<?php

namespace App\Livewire\User;

use App\Models\EmailNotification;
use App\Models\Image;
use App\Models\News;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Home extends Component
{
    public $products;
    public $pots;
    public $topProducts;

    #[Validate('required|min:5|email')]
    public $emailNotificationToSend;
    protected $listeners = ['notify' => 'notify'];
    public $news;
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'emailNotificationToSend' => 'required|min:5|email'
        ], [
            'emailNotificationToSend.required' => 'Email is required.',
            'emailNotificationToSend.min' => 'Email must be at least 5 characters.',
            'emailNotificationToSend.email' => 'Please enter a valid email address.'
        ]);
    }

    public function notify($message)
    {
        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => $message,
            'icon' => 'success',
        ]);
    }
    public function getPropertyEmailNotificationToSend()
    {
        return $this->getErrorBag()->isNotEmpty();
    }
    public function subcribe()
    {
        $this->validate();
        $sucribed = EmailNotification::where('email', '=', $this->emailNotificationToSend);
        if ($sucribed->exists()) {
            $this->dispatch('swalsuccess', [
                'title' => 'Thank you for your interest in us!',
                'text' => 'But this email has been registered before.',
                'icon' => 'success',
            ]);
            $this->reset('emailNotificationToSend');
            return;
        }
        $emailNotification = new EmailNotification();
        $emailNotification->email = $this->pull('emailNotificationToSend');
        $emailNotification->save();

        $this->dispatch('swalsuccess', [
            'title' => 'Subscribed!',
            'text' => 'You have successfully subscribed to our newsletter.',
            'icon' => 'success',
        ]);
        $this->reset('emailNotificationToSend');
    }
    public function mount()
    {
        $this->topProducts = OrderDetail::select('product_variant_id', DB::raw('SUM(quantity) as total_quantity'))
            ->with(['productVariant.product.productImages'])
            ->groupBy('product_variant_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();
        Log::info('topProducts: ' . json_encode($this->topProducts));
        $this->products = Product::with([
            'productVariants.subVariants.variantOption.variant',
            'productImages'
        ])->limit(10)->get();
        $this->pots = Product::with([
            'productVariants',
            'productImages',
            'category'
        ])
        ->where('category_id', 8)
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();

        $this->news = News::orderBy('created_at', 'desc')->take(3)->get();
    }
    public function render()
    {
        $carouselImages = Image::where('type', 'Home_Slide')->get();

        return view('livewire.user.home', ['products' => $this->products, 'carouselImages' => $carouselImages , 'hasError' =>  $this->getErrorBag()->isNotEmpty()]);
    }
}
