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

    public $products;
    public $listProductCategory = null;
    public $category;

    public function mount($id = null){
        if($id){
            $this->products = Product::with('productVariants.subVariants.variantOption.variant')->where('category_id',$id)->get();
            $this -> listProductCategory = true; 
            $this->category = Categories::find($id); 
        }
        else{
            $this->products = Product::with('productVariants.subVariants.variantOption.variant')->get();
            $this -> listProductCategory = false; 
        }
    }

    public function render()
    {   
        return view('livewire.user.list-product', [
            'products' => $this->products
        ]);
    }
}
