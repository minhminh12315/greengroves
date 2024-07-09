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
    public $search;

    public function mount()
    {
        $this->categories = Categories::whereNull('parent_id')->get();
        $searchTerm = '%' . $this->search . '%';
        $this->productSearch = Product::where('name', 'like', $searchTerm)->get();
    }
    public function updateSearch()
    {
        $searchTerm = '%' . $this->search . '%';
        $productSearch = Product::where('name', 'like', $searchTerm)->get();
        Log::info($productSearch);
    }

    public function render()
    {
        return view('livewire.user.header');
    }
}
