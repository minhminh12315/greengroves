@extends('livewire.admin.index')
@section('content')
<div>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mb-3">
                <h3 class="fw-bold">Images List</h3>
                <p>Manage your images</p>
            </div>
            <button class="btn btn-success mb-3 d-flex align-items-center justify-content-center gap-2" @click="$dispatch('toggleModalAdd')">
                <span class="material-symbols-outlined fs-5 text-light">
                    add_circle
                </span>
                <span class="text-light">
                    ADD NEW IMAGE
                </span>
            </button>
        </div>

        @if($distinctTypes->isNotEmpty())
        @foreach ($distinctTypes as $type)
        <div class="table-responsive mt-2">
            <h2 class="mb-2 text-capitalize">{{ $type }}</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image Title</th>
                        <th>Image Description</th>
                        <th>Image Type</th>
                        <th>Image Path</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($images as $image)
                    @if($image->type == $type)
                    <tr>
                        <td>{{ $image->title }}</td>
                        <td>{{ $image->description }}</td>
                        <td>{{ $image->type }}</td>
                        <td><img src="{{ Storage::url($image->path) }}" alt="Image" style="width: 100px; height: 100px;"></td>
                        <td>
                            <button wire:click="openEditImageModal({{ $image->id }})" class="btn btn-updateOrAdd" type="button" >
                                <span class="material-symbols-outlined mt-1 fs-6">
                                    edit_square
                                </span>
                            </button>
                            <button wire:click="openDeleteImageModal({{ $image->id }})" class="btn btn-delete" type="button">
                                <span class="material-symbols-outlined fs-6 mt-1">
                                    delete
                                </span>
                            </button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        @endforeach
        @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image Title</th>
                    <th>Image Description</th>
                    <th>Image Type</th>
                    <th>Image Path</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <td colspan="5">
                    No image found. Please add some images to the system.
                </td>
            </tbody>
        </table>
        @endif
    </div>

    <div class="modal fade" id="listimage-delete-img">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this image?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete_image">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="listimage-addnew-img"  wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between d-flex justify-content-between">
                    <h5 class="modal-title">Add New Image</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column gap-3" wire:submit.prevent="store_image" enctype="multipart/form-data">
                        <div class="form-group mt-2 mb-2">
                            <label for="image_title_new">Image Title</label>
                            <input type="text" class="form-control" id="image_title_new" wire:model="image_title_new">
                        </div>
                        @error('image_title_new') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group mt-2 mb-2">
                            <label for="image_description_new">Image description</label>
                            <input type="text" class="form-control" id="image_description_new" wire:model="image_description_new">
                        </div>
                        @error('image_description_new') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group mt-2 mb-2">
                            @if($addNewImageType)
                            <div class="d-flex justify-content-between mt-2 mb-2">
                                <label for="image_type_new">Image type</label>
                                <button class="btn btn-primary badge " wire:click="oldtype" type="button">Old Type</button>
                            </div>

                            <input type="text" class="form-control" id="image_type_new" wire:model="image_type_new" value="{{ $image_type_new }}" placeholder="please input new type">
                            @else
                            <div class="d-flex justify-content-between mt-2 mb-2">
                                <label for="image_type_new">Image type</label>
                                <button class="btn btn-success badge" wire:click="newtype" type="button">+ New Type</button>
                            </div>
                            <select class="form-control" id="image_type_new" wire:model="image_type_new">
                                @foreach ($distinctTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <label for="image_path_new">Image path</label>
                            <input type="file" class="form-control" id="image_path_new" wire:model="image_path_new">
                            @if ($image_path_new)
                            <img src="{{ $image_path_new->temporaryUrl() }}" width="100" height="100" class="mt-1 mb-1" alt="image">
                            @endif
                        </div>
                        @error('image_path_new') <span class="text-danger">{{ $message }}</span> @enderror
                        <button type="submit" class="btn btn-success mt-2 mb-2">Add New</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="listimage-edit-img" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Edit Image</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column gap-4" wire:submit.prevent="update_image" enctype="multipart/form-data">
                        <input type="hidden" wire:model="edit_image_id">
                        <div class="form-group">
                            <label for="edit_image_title">Image Title</label>
                            <input type="text" class="form-control" id="edit_image_title" wire:model="edit_image_title">
                        </div>
                        <div class="form-group">
                            <label for="edit_image_description">Image Description</label>
                            <input type="text" class="form-control" id="edit_image_description" wire:model="edit_image_description">
                        </div>
                        <div class="form-group">
                            <label for="edit_image_type">Image Type</label>
                            <select class="form-control" id="edit_image_type" wire:model="edit_image_type">
                                @foreach($distinctTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" >
                            <label for="edit_image_path">Image Path</label>
                            <input type="file" class="form-control" id="edit_image_path" wire:model="edit_image_path">
                            @if($edit_image_path)
                            <img src="{{ $edit_image_path->temporaryUrl() }}" alt="Current Image" class="pt-1 pb-1" style="width: 100px; height: 100px;">
                            @elseif($this->edit_old_image_path)
                            <img src="{{ Storage::url($edit_old_image_path) }}" alt="Current Image" class="pt-1 pb-1" style="width: 100px; height: 100px;">
                            @else
                            <input type="file" class="form-control" id="edit_image_path" wire:model="edit_image_path">
                            <p class="text-danger">No file chosen</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@script
<script>
    $(document).ready(() => {
        $wire.on('toggleModalAdd', () => {
            $('#listimage-addnew-img').modal('show');
        });
        $wire.on('toggleModalEdit', () => {
            $('#listimage-edit-img').modal('show');
        });

        $wire.on('toggleModalDelete', () => {
            $('#listimage-delete-img').modal('show');
        });
        $wire.on('closeModal', () => {
            $('.modal').modal('hide');
        });
        $wire.on('reload', () => {
            location.reload();
        })
    });
</script>
@endscript