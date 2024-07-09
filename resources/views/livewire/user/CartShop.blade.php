@extends('livewire.user.index')
@section('content')
<section id="CartShop">
    <div class="containerCartShop m-5">
        <div class="row p-3">
            <div class="col-6">
                <div class="cartShopTitle">
                    <h2>Cart Page</h2>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button class="btn btn-danger">Clear All</button>
            </div>
        </div>
        @if (count($cart) > 0)
        <div class="row p-3">
            <div class="col-12">
                <div class="cartShopTable table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">
                                    Check box
                                </th>
                                <th scope="col" class="text-center">Images</th>
                                <th scope="col" class="text-center">Product</th>
                                <th scope="col" class="text-center">Vaiant</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $key => $item)
                            <tr>
                                <td>
                                    <div class="wrapper-container">
                                        <div class="wrapper-item">
                                            <input type="checkbox" wire:model="selectedItems" value="{{ $item['variant_id'] }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if (isset($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 50px; height: 50px;">
                                    @else
                                    No Image
                                    @endif
                                </td>
                                <td class="text-center">{{ $item['name'] }}</td>
                                <td class="text-center">
                                    <ul>
                                        @foreach ($item['variants'] as $variant)
                                        <li>{{ $variant['variant_name'] }}: {{ $variant['variant_option_name'] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">${{ $item['price'] }}</td>
                                <td class="text-center d-flex">
                                    <button wire:click="decrementQuantity({{ $key }})">-</button>
                                    <input wire:model="quantities.{{ $key }}" type="number" class="form-control text-center" min="1">
                                    <button wire:click="incrementQuantity({{ $key }})">+</button>
                                </td>
                                <td class="text-center">${{ $item['price'] }}</td>
                                <td class="text-center">
                                    <button class="btn btn-danger">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        @else
        <div class="row p-3">
            <div class="col-12">
                <div class="cartShopEmpty">
                    <p>Your cart is empty.</p>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 text-start">
                <div class="totalPrice">
                    <div class="wrapper-container">
                        <div class="wrapper-item">
                            <div class="d-inline textPrice">Total Price :</div>
                            <div class="d-inline textPrice">${{ $totalPrice }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="checkOutButtonContainer d-flex justify-content-end align-content-center">
                    <button class="btn btn-secondary checkOutButton">Check Out</button>
                </div>
            </div>
        </div>
    </div>
    
</section>
@endsection