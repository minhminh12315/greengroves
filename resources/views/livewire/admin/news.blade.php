@extends('livewire.admin.index')
@section('content')
<div class="container">
    <button wire:click="openAddNewsModal" class="btn btn-success" type="button">+ News</button>
    @if($AddNewsModal)
    <div class="modal fade show" style="display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add News</h5>
                    <button type="button" class="close" wire:click="closeAddNewsModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store_news" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="news_title">News Title</label>
                            <input type="text" class="form-control" id="news_title" wire:model="news_title">
                            @error('news_title') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="news_description">News description</label>
                            <input type="text" class="form-control" id="news_description" wire:model="news_description">
                            @error('news_description') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="news_image_path">News Image</label>
                            <input type="file" id="news_image_path" wire:model="news_image_path">
                            @error('news_image_path') <span class="error">{{ $message }}</span> @enderror
                            @if ($news_image_path)
                            <img src="{{ $news_image_path->temporaryUrl() }}" width="100" height="100" class="mt-1 mb-1" alt="image">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    @if($EditNewsModal)
    <div class="modal fade show" style="display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit News</h5>
                    <button type="button" class="close" wire:click="closeAddNewsModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update_news" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="news_id">News Id</label>
                            <input disabled type="text" class="form-control" id="news_id" wire:model="news_id">
                        </div>
                        <div class="form-group">
                            <label for="news_title">News Title</label>
                            <input type="text" class="form-control" id="news_title" wire:model="news_title">
                            @error('news_title') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="news_description">News description</label>
                            <input type="text" class="form-control" id="news_description" wire:model="news_description">
                            @error('news_description') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="news_image_path">News Image</label>
                            @if ($news_image_path)
                            <input type="file" id="news_image_path" wire:model="news_image_path">
                            <img src="{{ $news_image_path->temporaryUrl() }}" width="100" height="100" class="mt-1 mb-1" alt="image">
                            @elseif($news_old_image_path)
                            <input type="file" id="news_image_path" wire:model="news_image_path">
                            <img src="{{ Storage::url($news_old_image_path) }}" width="100" height="100" class="mt-1 mb-1" alt="image">
                            @else
                            <input type="file" id="news_image_path" wire:model="news_image_path">
                            <p class="text-danger">No file chosen</p>
                            @endif
                            @error('news_image_path') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    @if($DeleteNewsModal)
    <div class="modal fade show" style="display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" wire:click="closeDeleteNewsModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this image?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDeleteNewsModal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete_image">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">News</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>News Title</th>
                        <th>News Description</th>
                        <th>News Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($news->isNotEmpty())
                    @foreach ($news as $newsItem)
                    <tr>
                        <td>{{ $newsItem->title }}</td>
                        <td>{{ $newsItem->description }}</td>
                        <td><img src="{{ Storage::url($newsItem->path) }}" alt="{{ $newsItem->title }}" width="100" height="100"></td>
                        <td>{{ $newsItem->created_at }}</td>
                        <td>{{ $newsItem->updated_at }}</td>
                        <td><button wire:click="openEditNewsModal({{ $newsItem->id }})" class="btn btn-primary" type="button">Edit</button></td>
                        <td><button wire:click="openDeleteNewsModal({{ $newsItem->id }})" class="btn btn-danger" type="button">Delete</button></td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6">No News Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection