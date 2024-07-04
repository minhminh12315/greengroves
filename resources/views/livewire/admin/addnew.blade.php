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
                            <select wire:model="category_id" name="category_id" id="category" class="text-capitalize form-control" required>
                                @if ($category->count() > 0)
                                @foreach ($category as $cat)
                                <option class="text-capitalize" value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                                @else
                                <option value="">No category</option>
                                @endif
                            </select>
                            <p>Go bottom page to create new category!</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description: </label>
                    <textarea wire:model="description" name="description" id="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="images">Image: </label>
                    <input wire:model="images" type="file" name="images" id="images" class="form-control" multiple>
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
                            <input wire:model="product_type" wire:click="setProductType('single')" type="radio" name="product_type" value="single" checked> Single Product
                            <input wire:model="product_type" wire:click="setProductType('variable')" type="radio" name="product_type" value="variable"> Variable Product
                        </div>
                        @if($product_type == 'single')
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="quantity">Quantity: </label>
                                <input wire:model="quantity_single" type="number" name="quantity" id="quantity" class="form-control" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="price">Price: </label>
                                <input wire:model="price_single" type="number" name="price" id="price" class="form-control" required>
                            </div>
                        </div>
                        @elseif($product_type == 'variable')
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" wire:click="showVariantAttributeModal">+ Variant Attribute</button>
                        </div>
                        <div class="form-group row">
                            {{-- Lặp qua từng thuộc tính biến thể --}}
                            @foreach($variantAttributes as $index => $attribute)
                            <div class="col-12 col-md-6">
                                <label for="variant">Variant Attribute</label>
                                <select wire:model="variantAttributes.{{ $index }}.variant" name="variant" id="variant" class="form-control mt-1">
                                    <option value="">Select Variant</option>
                                    @if(isset($variants_display) && count($variants_display) > 0)
                                    @foreach($variants_display as $variant)
                                    <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-12 col-md-5">
                                <label for="variant_option">Variant Option</label>
                                {{-- Lặp qua từng tùy chọn của thuộc tính biến thể --}}
                                @foreach($attribute['options'] as $optionIndex => $option)
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <input type="text" wire:model="variantAttributes.{{ $index }}.options.{{ $optionIndex }}" name="variant_options[]" id="variant_options" class="form-control" placeholder="Enter Variant Option">
                                    <button type="button" class="btn btn-danger ml-2" wire:click="deleteOption({{ $index }}, {{ $optionIndex }})">Delete</button>
                                </div>
                                @endforeach

                                <div class="d-flex justify-content-end w-100 mt-1">
                                    <button type="button" class="btn btn-primary badge" wire:click="addVariantOption({{ $index }})">Add Variant Option</button>
                                </div>
                            </div>

                            <div class="col-1 align-self-end">
                                <button type="button" class="btn btn-danger mb-2" wire:click="deleteAttribute({{ $index }})">Delete Attribute</button>
                            </div>
                            @endforeach
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary badge" wire:click="addVariantAttribute">Add Variant Attribute</button>
                        </div>

                        <div class="mt-2">
                            <button type="button" class="btn btn-primary" wire:click="generateCombinations">Generate Combinations</button>
                        </div>

                        @if (!empty($variantCombinations))
                        <div class="bordered p-2 row">
                            @foreach($variantCombinations as $index => $combination)
                            <div class="col">
                                <p>Variant: {{ $combination['variant'] }}</p>
                                <p>Option: {{ $combination['option'] }}</p>
                                <input type="number" wire:model="variantCombinations.{{ $index }}.quantity" placeholder="Enter Quantity">
                                <input type="number" wire:model="variantCombinations.{{ $index }}.price" placeholder="Enter Price">
                            </div>
                            @endforeach
                        </div>
                        @endif



                        @endif

                        @if($VariantAttributeModal)
                        <div class="modal fade show" style="display: block;" aria-modal="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Variant Attribute</h5>
                                        <button type="button" class="close" wire:click="hideVariantAttributeModal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="newVariantName">Variant Name</label>
                                                <input type="text" class="form-control" id="newVariantName" wire:model="newVariantName">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" wire:click="hideVariantAttributeModal">Close</button>
                                        <button type="button" class="btn btn-primary" wire:click="addNewVariantAttribute">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-backdrop fade show"></div>
                        @endif


                    </div>
                </div>
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