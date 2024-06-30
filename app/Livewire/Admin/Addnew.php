<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Addnew extends Component
{
    public $name;
    public $description;
    
    public $category_addnew;
    public $parent_id;
    public function render()
    {
        $data = [
            'category' => Categories::all(),
            
        ];

        return view('livewire.admin.addnew', $data);
    }

    public function addnew_category()
    {   
        $this -> validate([
            'category_addnew' => 'required',
        ]);
        $categoryExist = Categories::where('name', $this->category_addnew)->first();
        if(!$categoryExist)
        {
            try{
                $category = new Categories();
                $category->name = $this->category_addnew;
                if(isset($this->parent_id)){
                    $category->parent_id = $this->parent_id;
                }
                if($category->parent_id == 0){
                    $category->parent_id = null;
                }
    
                $category->save();
    
                Log::info("Category added successfully: {$category->name}");
                $this->category_addnew = '';
                return $this->redirect('/admin/addnew');
    
            } catch(\Exception $e) {
                Log::error('Error adding category'. ['category' => $this->category_addnew]);
                dd($e);
            }
        } else{
            session()->flash('categoryDup', 'Category already exists');
            $this->category_addnew = '';
        }
    }

    public function store_product()
    {

    }


}
