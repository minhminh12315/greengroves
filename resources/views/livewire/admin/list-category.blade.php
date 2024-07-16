@extends('livewire.admin.index')
@section('content')
<div>
    <div class="d-flex align-items-center justify-content-between">
        <div class="mb-3">
            <h3 class="fw-bold">Categories List</h3>
            <p>Manage your categories</p>
        </div>
        <button class="btn btn-success mb-3 d-flex align-items-center justify-content-center gap-2" wire:click="showAddCategoryModal">
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
                    <button class="btn btn-updateOrAdd" wire:click="editCategory({{ $category->id }})" type="button">
                        <span class="material-symbols-outlined mt-1 fs-6">
                            edit_square
                        </span>
                    </button>
                    <button class="btn btn-delete" wire:click="confirmDelete({{ $category->id }})" type="button">
                        <span class="material-symbols-outlined fs-6 mt-1">
                            delete
                        </span>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($editCategoryModal)
    <div class="modal fade show" style="display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Chỉnh sửa danh mục</h5>
                    <button type="button" class="close btn btn-danger" wire:click="hideEditModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input wire:model="name" type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea wire:model="description" class="form-control" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Danh mục cha</label>
                            <select wire:model="parent_id" class="form-control" id="parent_id">
                                <option value="">None</option>
                                @foreach ($categories as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="hideEditModal">Đóng</button>
                    <button type="button" class="btn btn-primary" wire:click="updateCategory">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    @if($deleteCategoryModal)
    <div class="modal fade show" style="display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="close btn btn-danger" wire:click="hideDeleteModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa danh mục này không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="hideDeleteModal">Đóng</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteCategory">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    @if($addCategoryModal)
    <div class="modal fade show" style="display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Thêm Mới Danh Mục</h5>
                    <button type="button" class="close btn btn-danger" wire:click="hideAddCategoryModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="newName">Tên danh mục</label>
                            <input wire:model="name" type="text" class="form-control" id="newName">
                        </div>
                        <div class="form-group">
                            <label for="newDescription">Mô tả</label>
                            <textarea wire:model="description" class="form-control" id="newDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="newParentId">Danh mục cha</label>
                            <select wire:model="parent_id" class="form-control" id="newParentId">
                                <option value="">None</option>
                                @foreach ($categories as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="hideAddCategoryModal">Đóng</button>
                    <button type="button" class="btn btn-primary" wire:click="addCategory">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>


@endsection