@extends('livewire.admin.index')
@section('content')
<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Product Type</th>
                <th>Product Image</th>
                <th>Sum Quantity Stock</th>
                <th>Price</th>
                <th>Variant</th>
                <th>Each Quantity Stock</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($products as $product)
            @if($product->type == 'single')
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->type }}</td>
                <td>
                    @if($product->productImages)
                    @foreach ($product->productImages as $image)
                    <img src="{{ Storage::url($image->path) }}" alt="image" width="100">
                    @endforeach
                    @endif
                </td>
                @foreach ($product->productVariants as $variant)
                <td>{{ $variant->quantity }}</td>
                <td>{{ $variant->price }}</td>
                <td colspan="2"></td> <!-- Cột rỗng để giữ cùng dòng với sản phẩm -->
                <td><button class="btn btn-primary" wire:click="editVariant({{ $variant->id }})" type="button">Update</button></td>
                <td><button class="btn btn-danger" wire:click="confirmDelete({{ $variant->id }})" type="button">Delete</button></td>
                @endforeach
            </tr>
            @else
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->type }}</td>
                <td>
                    @if($product->productImages)
                    @foreach ($product->productImages as $image)
                    <img src="{{ Storage::url($image->path) }}" alt="image" width="100">
                    @endforeach
                    @endif
                </td>
                <td>{{ $product->productVariants->sum('quantity') }}</td>

            @foreach ($product->productVariants as $key => $variant)
            
                <td>{{ $variant->price }}</td>
                <td>
                    @foreach ($variant->subVariants as $subVariant)
                    <div><b>{{ $subVariant->variantOption->variant->name }}</b>: {{ $subVariant->variantOption->name }}</div>
                    @endforeach
                </td>
                <td>{{ $variant->quantity }}</td>
                <td><button class="btn btn-primary" wire:click="editVariant({{ $variant->id }})" type="button">Update</button></td>
                <td><button class="btn btn-danger" wire:click="confirmDelete({{ $variant->id }})" type="button">Delete</button></td>
            </tr>
            @if ($loop->last && $key === count($product->productVariants) - 1)
            <!-- Đây là biến thể cuối cùng -->
            @else
            <tr>
                <td colspan="5"></td> 
            @endif
            @endforeach
            @endif
            @endforeach
        </tbody>
    </table>
    @if($editVariantModal)
        <div class="modal fade show" style="display: block;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title">Edit Variant</h5>
                        <button type="button" class="close btn btn-danger" wire:click="hideModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group">
                                <label for="name">Product name</label>
                                <input wire:model="product_name" type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="category">Product category</label>
                                <select wire:model="product_category" class="form-control" name="category" id="category">
                                    <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                                    @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Product Image</label>
                                @if($this->product_images)
                                <input wire:model="product_images" type="file" class="form-control" id="image" multiple>
                                @foreach ($this->product_images as $image)
                                <img src="{{ $image->temporaryUrl() }}" alt="image" width="100">
                                @endforeach
                                @else
                                @if($product->productImages)
                                @foreach ($product->productImages as $image)
                                <input wire:model="product_images" type="file" class="form-control" id="image" multiple>
                                <img src="{{ Storage::url($image->path) }}" alt="image" width="100">
                                @endforeach
                                @endif
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="quantity">Product Quantity</label>
                                <input wire:model="update_quantity" type="text" class="form-control" id="quantity">
                            </div>
                            <div class="form-group">
                                <label for="price">Variant Price</label>
                                <input wire:model="update_price" type="text" class="form-control" id="price">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="hideModal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="updateVariant">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    @if($deleteVariantModal)
        <div class="modal fade show" style="display: block;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="close btn btn-danger" wire:click="hideDeleteModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this variant?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="hideDeleteModal">Close</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteVariant">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
</div>
@endsection