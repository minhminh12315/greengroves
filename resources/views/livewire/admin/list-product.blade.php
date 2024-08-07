@extends('livewire.admin.index')
@section('content')
<section>
    <div class="mb-3">
        <h3 class="fw-bold">Product List</h3>
        <p>Manage your products</p>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Product Type</th>
                <th>Product Image</th>
                <th>Sum Quantity Stock</th>
                <th>Price</th>
                <th>Variant</th>
                <th>Each Quantity Stock</th>
                <th style="width: 5rem;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            @foreach ($product->productVariants as $key => $variant)
            <tr>
                @if($key === 0)
                <td rowspan="{{ $product->productVariants->count() }}" style="width: 17rem;">{{ $product->name }}</td>
                <td rowspan="{{ $product->productVariants->count() }}" style="width: 10rem;">{{ $product->category->name }}</td>
                <td rowspan="{{ $product->productVariants->count() }}">{{ $product->type }}</td>
                <td rowspan="{{ $product->productVariants->count() }}">
                    @if ($product->productImages->isNotEmpty())
                    @foreach ($product->productImages as $image)
                    <img src="{{ Storage::url($image->path) }}" alt="image" width="100">
                    @endforeach
                    @else
                    No Image Available
                    @endif
                </td>
                <td rowspan="{{ $product->productVariants->count() }}">{{ $product->productVariants->sum('quantity') }}</td>
                @endif
                <td>${{ number_format($variant->price, 2) }}</td>
                <td>
                    @foreach ($variant->subVariants as $subVariant)
                    <div><b>{{ $subVariant->variantOption->variant->name }}</b>: {{ $subVariant->variantOption->name }}</div>
                    @endforeach
                </td>
                @if ($product->type == 'single')
                <td></td>
                @else
                <td>{{ number_format($variant->quantity) }}</td>
                @endif
                <td>
                    <button class="btn btn-updateOrAdd" wire:click="editVariant({{ $variant->id }})" type="button">
                        <span class="material-symbols-outlined mt-1 fs-6">
                            edit_square
                        </span>
                    </button>
                    <button class="btn btn-delete" wire:click="confirmDelete({{ $variant->id }})" type="button">
                        <span class="material-symbols-outlined fs-6 mt-1">
                            delete
                        </span>
                    </button>
                </td>
            </tr>
            @endforeach
            @endforeach

        </tbody>
    </table>
    <div class="modal fade" id="listproduct-delete-product">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close btn btn-danger">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this variant?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="deleteVariant">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="listproduct-edit-product">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Edit Variant</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column gap-4" wire:submit.prevent="updateVariant" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Product name</label>
                            <input wire:model="product_name" type="text" class="form-control" id="name">
                            @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Product category</label>
                            <select wire:model="new_category" class="form-control" name="category" id="category">
                                @if($product_category)
                                <option value="{{ $product_category->id }}" selected>{{ $product_category->name }}</option>
                                @endif
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('new_category') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <input wire:model="product_images" type="file" class="form-control" id="image" multiple>
                            @if($product_images)
                            <div>New Images:</div>
                            @foreach ($product_images as $image)
                            <img src="{{ $image->temporaryUrl() }}" height="100" class="mt-1 mb-1" alt="image" width="100">
                            @endforeach
                            @elseif($product_old_images && count($product_old_images) > 0)
                            <div>Old Images:</div>
                            @foreach ($product_old_images as $image)
                            <img src="{{ Storage::url($image) }}" height="100" class="mt-1 mb-1" alt="image" width="100">
                            @endforeach
                            @else
                            <div>No images chosen</div>
                            @endif
                            @error('product_images') <span class="text-danger">{{ $message }}</span> @enderror
                            @error('product_images.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Product Quantity</label>
                            <input wire:model="update_quantity" type="text" class="form-control" id="quantity">
                            @error('update_quantity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Variant Price</label>
                            <input wire:model="update_price" type="text" class="form-control" id="price">
                            @error('update_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-success" wire:loading.attr="disable">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{ $products->links('vendor.pagination.default') }}




    @endsection

    @script
    <script>
        $(document).ready(() => {
            $wire.on('toggleModalEdit', () => {
                $('#listproduct-edit-product').modal('show');
            });
            $wire.on('toggleModalDelete', () => {
                $('#listproduct-delete-product').modal('show');
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