<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListCategory extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $categoryId;
    public $name;
    public $description;
    public $parent_id;
    protected $paginationTheme = 'bootstrap';

    public function editCategory($categoryId)
    {
        $category = Categories::find($categoryId);
        $this->categoryId = $categoryId;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;
        $this->dispatch('toggleModalEdit')->self();
    }


    public function updateCategory()
    {
        $category = Categories::find($this->categoryId);
        $category->update([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);
        $this->reset(['name', 'parent_id']);
        $this->dispatch('closModal')->self();
        $this->dispatch('reload')->self();
    }

    public function confirmDelete($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->dispatch('toggleModalDelete')->self();
    }


    public function deleteCategory()
    {
        $category = Categories::find($this->categoryId);
        $category->delete();
        $this->dispatch('swalsuccess', [
            'title' => 'Congratulation!',
            'text' => 'Deleted successfully!',
            'icon' => 'success',
        ]);
        $this->dispatch('closModal')->self();
        $this->dispatch('reload')->self();
    }

    public function toggleModalAdd()
    {
        $this->dispatch('toggleModalAdd')->self();
    }

    public function addCategory()
    {
        Categories::create([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);
        $this->reset(['name', 'parent_id']);
        $this->dispatch('dataTable');
        return $this->redirect('/admin/list_category', navigate: true);
    }

    public function render()
    {
        $categories = Categories::with('parent', 'children')->paginate(8);

        return view('livewire.admin.list-category', [
            'categories' => $categories,
        ]);
    }
}
