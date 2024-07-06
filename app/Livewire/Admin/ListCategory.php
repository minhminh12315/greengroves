<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
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

    public function editCategory($categoryId)
    {
        $category = Categories::find($categoryId);
        $this->categoryId = $categoryId;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;
        $this->editCategoryModal = true;
    }

    public function hideEditModal()
    {
        $this->editCategoryModal = false;
    }

    public function updateCategory()
    {
        $category = Categories::find($this->categoryId);
        $category->update([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ]);

        $this->editCategoryModal = false;
        $this->mount(); // Refresh the category list
    }

    public function confirmDelete($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->deleteCategoryModal = true;
    }

    public function deleteCategory()
    {
        $category = Categories::find($this->categoryId);
        $category->delete();
        $this->deleteCategoryModal = false;
        $this->mount(); // Refresh the category list
    }

    public function hideDeleteModal()
    {
        $this->deleteCategoryModal = false;
    }

    public function showAddCategoryModal()
    {
        $this->reset(['name', 'description', 'parent_id']);
        $this->addCategoryModal = true;
    }

    public function hideAddCategoryModal()
    {
        $this->addCategoryModal = false;
    }

    public function addCategory()
    {
        Categories::create([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ]);

        $this->addCategoryModal = false;
        $this->mount(); // Refresh the category list
    }

    public function render()
    {
        return view('livewire.admin.list-category');
    }
}
