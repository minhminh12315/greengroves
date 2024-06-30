@extends('livewire.admin.index')
@section('content')

<div class="container">
    <h1>New product</h1>
    <p>Create new product</p>
    <form wire:submit="store_product" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div>
                    <h5>Infomation</h5>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label for="name">Product name: </label>
                            <input wire:model="name" type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label for="category">Category: </label>
                            <select name="category_id" id="category" class="text-capitalize form-control" required>
                                @if ($category->count() > 0)
                                @foreach ($category as $cat)
                                <option class="text-capitalize" value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <p>Go bottom page to create new category!</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description: </label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="images">Image: </label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                </div>

                <div>
                    <div>
                        <h5>Pricing & Stocks</h5>
                        <hr>
                    </div>
                    <div>
                        <div class="form-group product_type">
                            <label for="product_type">Product type</label>
                            <br>
                            <input type="radio" name="product_type" value="0" checked> Single Product
                            <input type="radio" name="product_type" value="1"> Variable Product
                        </div>
                    </div>
                </div>

                <div>
                    <button type="button" class="btn btn-info badge mt-2" id="add_variant">Add Variant</button>
                </div>

                <div id="variants_container"></div>

                <button type="button" class="btn btn-info badge mt-2" id="generate_combinations">Generate Combinations</button>

                <div id="combinations_container"></div>

                <button type="submit" class="btn btn-primary mt-2">Add Product</button>
            </div>
        </div>

    </form>

    <button class="btn btn-info badge addnew_category mt-4" type="button">Add new Category</button>
    <form wire:submit="addnew_category" id="form_addnew_category">
        <div class="form-group">
            <label for="category_addnew">Category: </label>
            <input wire:model="category_addnew" type="text" name="category_addnew" id="category_addnew" class="form-control" required>
        </div>
        <label for="parent_id" class="form-label">Parent Category</label>
        <select name="parent_id" id="parent_id" wire:model="parent_id">

            <option value="">None</option>
            @foreach($category as $category)
            <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" id="store_category" class="btn btn-primary mt-2">Add Category</button>
        <button type="button" id="cancel_category" class="btn btn-danger mt-2">Cancel</button>
        @if(session()->has('categoryDup'))
        <div class="alert alert-danger mt-2">
            {{ session('categoryDup') }}
        </div>
        @endif
    </form>
</div>
@endsection