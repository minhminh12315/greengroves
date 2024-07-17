<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class ListCategory extends Component
{
    public $categories;
    public $editCategoryModal = false;
    public $deleteCategoryModal = false;
    public $addCategoryModal = false;
    public $categoryId;
    public $name;
    public $description;
    public $parent_id;

    public function mount()
    {
        $this->categories = Categories::with('parent', 'children')->get();
    }

    #[Renderless]
    public function editCategory($categoryId)
    {
        $category = Categories::find($categoryId);
        $this->categoryId = $categoryId;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;
        $this->editCategoryModal = true;
    }


    public function updateCategory()
    {
        $category = Categories::find($this->categoryId);
        $category->update([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);
        $this->reset(['name', 'parent_id']);
        $this->mount(); 
        $this->dispatch('closeModal');
    }

    public function confirmDelete($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->deleteCategoryModal = true;
    }

    #[Renderless]
    public function deleteCategory()
    {
        $category = Categories::find($this->categoryId);
        $category->delete();
        $this->dispatch('swalsuccess', [
            'title' => 'Congratulation!',
            'text' => 'Deleted successfully!',
            'icon' =>'success',
        ]);
        $this->dispatch('closeModal');
        $this->mount(); 
    }



    public function addCategory()
    {
        Categories::create([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);
        $this->reset(['name', 'parent_id']);
        $this->dispatch('closeModal');
        $this->mount(); 
    }

    public function render()
    {
        return view('livewire.admin.list-category');
    }
}
