@extends('livewire.admin.index')
@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <div class="mb-3">
            <h3 class="fw-bold">News</h3>
            <p>Manage your news</p>
        </div>
        <button class="btn btn-success mb-3 d-flex align-items-center justify-content-center gap-2" wire:click="resetAll" data-bs-toggle="modal" data-bs-target="#news-addnew">
            <span class="material-symbols-outlined fs-5 text-light">
                add_circle
            </span>
            <span class="text-light">
                ADD NEW NEWS
            </span>
        </button>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">News</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>News Title</th>
                        <th>News Description</th>
                        <th>News Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($news->isNotEmpty())
                    @foreach ($news as $newsItem)
                    <tr>
                        <td>{{ $newsItem->id }}</td>
                        <td>{{ $newsItem->title }}</td>
                        <td>{{ $newsItem->description }}</td>
                        <td><img src="{{ Storage::url($newsItem->path) }}" alt="{{ $newsItem->title }}" width="100" height="100"></td>
                        <td>{{ $newsItem->created_at }}</td>
                        <td>{{ $newsItem->updated_at }}</td>
                        <td>
                            <button class="btn btn-updateOrAdd" wire:click="openEditNewsModal({{ $newsItem->id }})" type="button" data-bs-toggle="modal" data-bs-target="#news-edit">
                                <span class="material-symbols-outlined mt-1 fs-6">
                                    edit_square
                                </span>
                            </button>
                            <button class="btn btn-delete" wire:click="openDeleteNewsModal({{ $newsItem->id }})" type="button" data-bs-toggle="modal" data-bs-target="#news-delete">
                                <span class="material-symbols-outlined fs-6 mt-1">
                                    delete
                                </span>
                            </button>
                        </td>
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
    <div class="modal fade" id="news-addnew" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Add News</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column gap-4" wire:submit.prevent="store_news" enctype="multipart/form-data">
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
                            <input type="file" class="form-control" id="news_image_path" wire:model="news_image_path">
                            @error('news_image_path') <span class="error">{{ $message }}</span> @enderror

                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="news-edit" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Edit News</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column gap-4" wire:submit.prevent="update_news" enctype="multipart/form-data">
                        <div class="form-group d-none">
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
                            <input wire:model="news_image_path" type="file" class="form-control" id="news_image_path">
                            @if ($news_image_path)
                            <div>New Images:</div>
                            <img src="{{ $news_image_path->temporaryUrl() }}" width="100" height="100" class="mt-1 mb-1" alt="image">
                            @elseif($news_old_image_path)
                            <div>Old Images:</div>
                            <img src="{{ Storage::url($news_old_image_path) }}" width="100" height="100" class="mt-1 mb-1" alt="image">
                            @else
                            <p class="text-danger">No file chosen</p>
                            @endif
                            @error('news_image_path') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="news-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this news?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete_image">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
