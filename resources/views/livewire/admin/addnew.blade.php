@extends('livewire.admin.index')
@section('content')

<div class="container">
    <div class="mb-3">
        <h3 class="fw-bold">New product</h3>
        <p>Create new product</p>
    </div>
    <form wire:submit.prevent="store_product" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="border-bottom pt-2 pb-3">
                    <h4>Infomation</h4>
                </div>
                <div class="row mt-2 g-md-3 g-sm-4">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group d-flex flex-column gap-2 justify-content-between h-100 w-100">
                            <label for="name">Product name: </label>
                            <input wire:model="name" type="text" name="name" id="name" class="form-control" placeholder="Name">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group d-flex flex-column gap-2 h-100 w-100 justify-content-between">
                            <div class="d-flex justify-content-between">
                                <label for="category">Category: </label>
                                <div class="d-flex flex-row gap-1 align-items-center btn-addcate-addPage" wire:click="showAddCategoryModal">
                                    <span class="material-symbols-outlined fs-6 mt-1">
                                        add_circle
                                    </span>
                                    <span>
                                        New Category
                                    </span>
                                </div>
                            </div>
                            <select wire:model="category_id" name="category_id" id="category" class="text-capitalize form-select">
                                @if ($category->count() > 0)
                                <option selected class="d-none">--Choose Category--</option>
                                @foreach ($category as $cat)
                                <option class="text-capitalize" value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                                @else
                                <option value="">No category</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Description: </label>
                            <textarea wire:model="description" name="description" id="description" class="form-control" placeholder="Description"></textarea>
                            @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="images">Image: </label>
                            <input wire:model="images" type="file" name="images" id="images" class="form-control" multiple>
                            @if ($images)
                            <div class="mt-2">
                                @foreach ($images as $image)
                                <img src="{{ $image->temporaryUrl() }}" width="100" height="100" class="mr-2 mb-2">
                                @endforeach
                            </div>
                            @endif

                            @error('images') <span class="error text-danger">{{ $message }}</span> @enderror

                            @if ($errors->has('images.*'))
                            @foreach ($errors->get('images.*') as $key => $messages)
                            @foreach ($messages as $message)
                            <span class="error text-danger">{{ $message }}</span><br>
                            @endforeach
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-between gap-4">
                    <div class="border-bottom pt-4 pb-3">
                        <h4>Pricing & Stocks</h4>
                    </div>
                    <div class="d-flex flex-column gap-4">
                        <div class="form-group product_type">
                            <div class="d-flex flex-column w-100 gap-2">
                                <p>Product type</p>
                                <div class="d-flex flex-row gap-4">
                                    <div class="form-group select-typeOfProduct">
                                        <input id="single-product" wire:model="product_type" wire:click="setProductType('single')" type="radio" name="product_type" value="single" checked>
                                        <label for="single-product" class="d-flex flex-row gap-2 align-items-center justify-content-start">Single Product</label>
                                    </div>
                                    <div class="form-group select-typeOfProduct">
                                        <input id="variable-product" wire:model="product_type" wire:click="setProductType('variable')" type="radio" name="product_type" value="variable">
                                        <label for="variable-product">Variable Product</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($product_type == 'single')
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="quantity">Quantity: </label>
                                <input wire:model="quantity_single" type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                                @error('quantity_single') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="price">Price: </label>
                                <input wire:model="price_single" step="0.01" type="number" name="price" id="price" class="form-control" placeholder="Price">
                                @error('price_single') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @elseif($product_type == 'variable')
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row gap-1 align-items-center add-variant-attr" wire:click="addVariantAttribute">
                                <span class="material-symbols-outlined fs-6">
                                    forms_add_on
                                </span>
                                <span>
                                    Add Variant Attribute
                                </span>
                            </div>

                            <div class="d-flex flex-row gap-1 align-items-center new-variant-attr" wire:click="showVariantAttributeModal">
                                <span class="material-symbols-outlined fs-6 ">
                                    add_circle
                                </span>
                                <span>
                                    New Variant Attribute
                                </span>
                            </div>
                        </div>
                        <div class="form-group row g-5">
                            {{-- Lặp qua từng thuộc tính biến thể --}}
                            @foreach($variantAttributes as $index => $attribute)
                            <div class="col-12 col-md-6 align-self-center">
                                <label for="variant">Variant Attribute</label>
                                <div class="d-flex flex-row gap-1 align-items-center">
                                    <div class="btn-delete-variant-attr" wire:click="deleteAttribute({{ $index }})">
                                        <span class="material-symbols-outlined fs-5 mt-1">
                                            delete
                                        </span>
                                    </div>
                                    <select wire:model="variantAttributes.{{ $index }}.variant" name="variant" id="variant" class="form-control mt-1">
                                        <option value="">Select Variant</option>
                                        @if(isset($variants_display) && count($variants_display) > 0)
                                        @foreach($variants_display as $variant)
                                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('variantAttributes.' . $index . '.variant') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="variant_option">Variant Option</label>
                                {{-- Lặp qua từng tùy chọn của thuộc tính biến thể --}}
                                <div class="d-flex gap-2 flex-column">
                                    @foreach($attribute['options'] as $optionIndex => $option)
                                    <div class="d-flex justify-content-between align-items-center gap-1">
                                        <input type="text" wire:model="variantAttributes.{{ $index }}.options.{{ $optionIndex }}" name="variant_options[]" id="variant_options" class="form-control" placeholder="Enter Variant Option">
                                        <div class="btn-updateOrAdd" wire:click="addVariantOption({{ $index }})">
                                            <span class="material-symbols-outlined fs-5 mt-1">
                                                add
                                            </span>
                                        </div>
                                        <div class="btn-delete" wire:click="deleteOption({{ $index }}, {{ $optionIndex }})">
                                            <span class="material-symbols-outlined fs-5 mt-1">
                                                delete
                                            </span>
                                        </div>
                                    </div>
                                    @if(session()->has('optionDeleteError'))
                                    <div class="alert alert-danger">
                                        {{ session('optionDeleteError') }}
                                    </div>
                                    @endif
                                    @error('variantAttributes.' . $index . '.options.' . $optionIndex) <span class="error text-danger">{{ $message }}</span> @enderror
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>


                        <div class="mt-2">
                            <button type="button" class="btn-generate-combinations" wire:click="generateCombinations">
                                <span class="material-symbols-outlined text-light">
                                    downloading
                                </span>
                                Generate Combinations
                            </button>
                        </div>

                        @if (!empty($variantCombinations))
                        <div class="bordered p-2 row">
                            @foreach($variantCombinations as $index => $combination)
                            <div class="col">
                                <div class="card" style="background-color: #F0F0F0;">
                                    <div class="card-body">
                                        <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                                            <p>Variant: {{ $combination['variant'] }}</p>
                                            <p>Option: {{ $combination['option'] }}</p>
                                        </div>
                                        <div class="d-flex flex-row align-items-center justify-content-between gap-2">
                                            <input type="number" class="form-control" wire:model="variantCombinations.{{ $index }}.quantity" placeholder="Enter Quantity">
                                            @error('variantCombinations.' . $index . '.quantity') <span class="error text-danger">{{ $message }}</span> @enderror
                                            <input type="number" class="form-control" wire:model="variantCombinations.{{ $index }}.price" step="0.01" placeholder="Enter Price">
                                            @error('variantCombinations.' . $index . '.price') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn-addnew-product mt-2">
            <span class="material-symbols-outlined">
                deployed_code_update
            </span>
            Add Product
        </button>
    </form>
    @if($addCategoryModal)
    <div class="modal fade show" style="display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="close btn btn-danger" wire:click="hideAddCategoryModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addnew_category">
                        <div class="form-group">
                            <label for="category_addnew">Category Name</label>
                            <input type="text" class="form-control" id="category_addnew" wire:model="category_addnew">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Parent Category</label>
                            <select class="form-control" id="parent_id" wire:model="parent_id">
                                <option value="">Select Parent Category</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    @if($VariantAttributeModal)
    <div class="modal fade show" style="display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Add New Variant Attribute</h5>
                    <button type="button" class="close btn btn-danger" wire:click="hideVariantAttributeModal">
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

<script>
    $(document).ready(function() {
        $('input , textarea').on('blur', function() {
            var userInput = $(this).val().trim();

            if (!userInput) {
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });
    });
</script>
@endsection