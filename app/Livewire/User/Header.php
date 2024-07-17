<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class Header extends Component
{
    public $categories;
    public $subcategories = [];
    public $selectedCategories = [];
    public $productSearch;
    public $search = "";
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->categories = Categories::whereNull('parent_id')->get();
        $searchTerm = '%' . $this->search . '%';
        $this->productSearch = Product::where('name', 'like', $searchTerm)->get();
        $this->cartCount = count(session('cart', []));
    }

    public function updateCartCount()
    {
        $this->cartCount = count(session('cart', []));
    }
    public function updateSearch()
    {
        $searchTerm = '%' . $this->search . '%';
        $this->productSearch = Product::where('name', 'like', $searchTerm)->get();
        Log::info($this->productSearch);
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    public function setting_user()
    {
        return redirect()->route('setting_user');
    }
    public function render()
    {
        $results = [];
        if(strlen($this->search) >= 1)
        {
            $results = Product::where('name', 'like', '%' . $this->search . '%')->limit(8)->get();

        }
        return view('livewire.user.header', [
            'results' => $results
        ]);
    }
}
