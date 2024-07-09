@extends('livewire.admin.index')
@section('content')
<div>
    <div class="container">
        <button wire:click="openAddNewImagesModal" class="btn btn-primary mt-2" type="button">Add New Image</button>
        @if($addNewImagesModal)
        <div class="modal fade show" style="display: block;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between d-flex justify-content-between">
                        <h5 class="modal-title">Add New Image</h5>
                        <button  type="button" class="close btn btn-danger" wire:click="closeAddNewImagesModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="store_image" enctype="multipart/form-data">
                            <div class="form-group mt-2 mb-2">
                                <label for="image_title_new">Image Title</label>
                                <input type="text" class="form-control" id="image_title_new" wire:model="image_title_new">
                            </div>
                            <div class="form-group mt-2 mb-2">
                                <label for="image_description_new">Image description</label>
                                <input type="text" class="form-control" id="image_description_new" wire:model="image_description_new">
                            </div>
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
                                    <button class="btn btn-primary badge " wire:click="newtype" type="button">New Type</button>
                                </div>
                                <select class="form-control" id="image_type_new" wire:model="image_type_new">
                                    @if($distinctTypes->isNotEmpty())
                                    @foreach ($distinctTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                    @else
                                    <option value="">Have no type</option>
                                    @endif
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
                            <button type="submit" class="btn btn-primary mt-2 mb-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
        @endif

        @if($editImageModal)
        <div class="modal fade show" style="display: block;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title">Edit Image</h5>
                        <button type="button" class="close btn btn-danger" wire:click="closeEditNewsModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="update_image" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <label for="edit_image_path">Image Path</label>
                                @if($edit_image_path)
                                <input type="file" class="form-control" id="edit_image_path" wire:model="edit_image_path">
                                <img src="{{ $edit_image_path->temporaryUrl() }}" alt="Current Image" class="pt-1 pb-1" style="width: 100px; height: 100px;">
                                @elseif($edit_old_image_path)
                                <input type="file" class="form-control" id="edit_image_path" wire:model="edit_image_path">
                                <img src="{{ Storage::url($edit_old_image_path) }}" alt="Current Image" class="pt-1 pb-1" style="width: 100px; height: 100px;">
                                @else
                                <input type="file" class="form-control" id="edit_image_path" wire:model="edit_image_path">
                                <p class="text-danger">No file chosen</p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
        @endif

        @if($deleteImageModal)
        <div class="modal fade show" style="display: block;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="close btn btn-danger" wire:click="closeDeleteImageModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this image?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeDeleteImageModal">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="delete_image">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
        @endif

        @if($distinctTypes->isNotEmpty())
        @foreach ($distinctTypes as $type)
        <div class="card ps-2 pe-2 mt-2">
            <div class="card-title">
                <h2 class="ms-3 mt-2 text-capitalize">{{ $type }}</h2>
            </div>
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
                            <button wire:click="openEditImageModal({{ $image->id }})" class="btn btn-primary" type="button">Edit</button>
                            <button wire:click="openDeleteImageModal({{ $image->id }})" class="btn btn-danger" type="button">Delete</button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        @endforeach

        @endif
    </div>
</div>
@endsection