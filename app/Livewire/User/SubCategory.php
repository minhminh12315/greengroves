<?php

namespace App\Livewire\User;

use App\Models\Categories;
use Livewire\Component;

class SubCategory extends Component
{
    // public $parentCategoryId;
    public $subCategories;
    public function mount($parentCategoryId){
        $this -> subCategories = Categories::where('parent_id', $parentCategoryId)->with('children')->get();
    }
    public function render()
    {
        return view('livewire.user.sub-category');
    }
}
