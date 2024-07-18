@extends('livewire.user.index')
@section('content')
<section id="CartShop">
    @if (count($cart) > 0)
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-6">
                <div class="cartShopTitle">
                    <h2>Cart Page</h2>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button wire:click="clearAllCart" class="btn btn-danger">Clear All</button>
            </div>
        </div>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">
                        <input wire:click="select_all" type="checkbox" class="form-check-input">
                    </th>
                    <th scope="col" class="text-secondary">Product</th>
                    <th scope="col" class="text-secondary">Price</th>
                    <th scope="col" class="text-secondary">Quantity</th>
                    <th scope="col" class="text-secondary">Total</th>
                    <th scope="col" class="text-secondary">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $key => $item)
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input " wire:model.live="selectedItems" value="{{ $item['variant_id'] }}">
                    </td>
                    <td>
                        <div class="d-flex justify-content-start align-items-start gap-3">
                            @if (isset($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="80" height="80">
                            @else
                            No Image
                            @endif
                            {{ $item['name'] }}
                            <ul>
                                @foreach ($item['variants'] as $variant)
                                <li>{{ucfirst($variant['variant_name'])}}: {{ $variant['variant_option_name'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                    <td>
                        ${{ number_format($item['price']) }}
                    </td>
                    <td>
                        <div class="quantity-container w-50 h-100">
                            <button wire:click="decrementQuantity({{ $key }})" type="button">-</button>
                            <input wire:model="quantities.{{ $key }}" class="text-center" type="text" class="text-center">
                            <button wire:click="incrementQuantity({{ $key }})" type="button">+</button>
                        </div>
                    </td>
                    <!-- Quantity Error -->
                    @if(session()->has('errorQuantity'))
                    <div class="text-danger">{{ session('errorQuantity') }}</div>
                    @endif
                    <td class="">${{ number_format($item['price'] )}}</td>
                    <td class="">
                        <button wire:click="removeItem({{$item['variant_id']}})" class="btn-delete">
                            <span class="material-symbols-outlined fs-5 mt-1">
                                delete
                            </span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container-fluid sticky-bottom p-4 cart-sub-table">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="fs-3">Total Price : <span class="fs-4 text-success">${{ number_format($totalPrice) }}</span></div>
            @if(auth()->user())
            @if($selectedItems)
            <button wire:click="checkout" class="checkOutButton">CHECK OUT</button>
            @else
            <button class="checkOutButton cursor-not-allowed" disabled>CHECK OUT</button>
            @endif
            @else
            <a href="{{ route('login') }}" class="checkOutButton">Login to Checkout</a>
            @endif
        </div>
    </div>
    @else
    <div class="cartEmpty">
        <img src="https://scontent.fhan18-1.fna.fbcdn.net/v/t1.15752-9/450456150_1072673534533711_8782095852012449840_n.png?stp=dst-png_p206x206&_nc_cat=110&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeEHebh2MRmXeINlzpruVgnnIbqyF2fJY9EhurIXZ8lj0dfqdwcYkGX5ckmXxqkcVKDpqCKIxar1giv1G6cgIEkD&_nc_ohc=XypmDleeHUYQ7kNvgHS_VUH&_nc_ht=scontent.fhan18-1.fna&oh=03_Q7cD1QFSiT_PBavmBNgoA4UVowQtMqyKRru7avB8NeA-pnRd8Q&oe=66BF7E44" alt="">
        <p class="fs-4 fw-bold">Your cart is empty.</p>
        <p class="text-secondary text-center">Looks like you have not added anything to your cart. Go ahead & explore top categories</p>
    </div>
    @endif

</section>
@endsection