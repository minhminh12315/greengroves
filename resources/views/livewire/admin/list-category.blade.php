@extends('livewire.admin.index')
@section('content')
<div>
    <div class="d-flex align-items-center justify-content-between">
        <div class="mb-3">
            <h3 class="fw-bold">Categories List</h3>
            <p>Manage your categories</p>
        </div>
        <button class="btn btn-success mb-3 d-flex align-items-center justify-content-center gap-2"  data-bs-toggle="modal" data-bs-target="#listcategory-addnew-category">
            <span class="material-symbols-outlined fs-5 text-light">
                add_circle
            </span>
            <span class="text-light">
                ADD NEW CATEGORY
            </span>
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Parent Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td class="{{ $category->parent ? '' : 'text-secondary' }}">
                    {{ $category->parent ? $category->parent->name  : 'None' }}
                </td>
                <td>
                    <button class="btn btn-updateOrAdd" wire:click="editCategory({{ $category->id }})" type="button" data-bs-toggle="modal" data-bs-target="#listcategory-edit-category">
                        <span class="material-symbols-outlined mt-1 fs-6">
                            edit_square
                        </span>
                    </button>
                    <button class="btn btn-delete" wire:click="confirmDelete({{ $category->id }})" type="button" data-bs-toggle="modal" data-bs-target="#listcategory-delete-category">
                        <span class="material-symbols-outlined fs-6 mt-1">
                            delete
                        </span>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade " id="listcategory-edit-category" wire:ignore>
        <div class="modal-dialog modal-dialog-centered">
            <div class=" modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column gap-4" wire:submit.prevent="updateCategory">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input wire:model="name" type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Parent Category</label>
                            <select wire:model="parent_id" class="form-control" id="parent_id">
                                @foreach ($categories as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" wire:loading.attr="disable">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="listcategory-delete-category" aria-modal="true" wire:ignore>
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteCategory" wire:loading.attr="disable">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore id="listcategory-addnew-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column gap-4" wire:submit.prevent="addCategory">
                        <div class="form-group">
                            <label for="newName">Category Name</label>
                            <input wire:model="name" type="text" class="form-control" id="newName">
                        </div>
                        <div class="form-group">
                            <label for="newParentId">Parent Category</label>
                            <select wire:model="parent_id" class="form-control" id="newParentId">
                                <option value="" class="d-none">--Choose Parent Category--</option>
                                @foreach ($categories as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" wire:loading.attr="disable" class="btn btn-success" >Add New</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection