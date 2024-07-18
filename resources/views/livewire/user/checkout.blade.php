@extends('livewire.user.index')
@section('content')
<div class="container">
    <form wire:submit="checkoutFinal" class="row row-cols-md-2 row-cols-sm-1">
        <div class="col-md-8 col-sm-12">
            <h3 class="mb-4">Checkout</h3>
            <div class="form-checkout">
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-6">
                        <label class="p-1" for="email">Email*</label>
                        <input disabled wire:model="email" type="text" class="form-control p-1 @error('email') is-invalid @enderror" name="email" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h4 class="mb-4">Delivery</h4>

                <div class="row mb-4">
                    <div class="col-md-6 col-sm-12">
                        <label class="p-1" for="name">Fullname*</label>
                        <input wire:model="name" type="text" class="form-control p-1 @error('name') is-invalid @enderror" name="name" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="col-md-6 col-sm-12 mb-4">
                        <label class="p-1" for="phone">Phone Number*</label>
                        <input wire:model="phone" type="text" class="form-control p-1 @error('phone') is-invalid @enderror" name="phone">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-4">
                        <label class="p-1" for="address">Address*</label>
                        <input wire:model="address" type="text" class="form-control p-1 @error('address') is-invalid @enderror" name="address">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="col-md-6 col-sm-12 mb-4">
                        <label class="p-1" for="street">Street*</label>
                        <input wire:model="street" type="text" class="form-control p-1 @error('street') is-invalid @enderror" name="street">
                        @error('street')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-4">
                        <label class="p-1" for="city">City*</label>
                        <input wire:model="city" type="text" class="form-control p-1 @error('city') is-invalid @enderror" name="city">
                        @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <label class="p-1" for="name">Notes - Optional</label>
                    <textarea wire:model="note" class="form-control p-1" name="note"></textarea>
                </div>

            </div>
        </div>
        <div class="subTotal bg-body-tertiary rounded-3 position-sticky col-md-4 col-sm-12 p-3">
            <div class="border-bot d-flex justify-content-between fs-3 fw-bold mb-4">
                <div>Total Price</div>
                <div class="text-success">{{$this->totalPrice}}$</div>
            </div>
            <div class="fs-6 mb-3">
                <div class="d-flex justify-content-between">
                    <div>Product Price:</div>
                    <div class="fw-bold text-success">{{$this->grandTotal}}$</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>Delivery:</div>
                    @if($this->deliveryFee == 0)
                    <div class="fw-bold">Free</div>
                    @else
                    <div class="fw-bold">{{$this->deliveryFee}}$</div>
                    @endif
                </div>
            </div>
            <div class="fs-5 ms-2 fw-bold">Cart</div>
            @foreach ($this->cart as $item)
            <div class=" mb-3 row">
                <img class="col-3" src="{{ Storage::url($item['image']) }}" width="80" height="80" alt="image">
                <div class="col-7">
                    <div class="d-flex">
                    <div>{{$item['name']}}</div>
                    </div>
                    @foreach ($item['variants'] as $variant)
                    <p>{{ $variant['variant_name'] }}: {{ $variant['variant_option_name'] }}</p>
                    @endforeach
                </div>
                <div class="col-2 text-success fs-5">{{$item['price']}}$</div>
            </div>
            @endforeach
            <div class="d-flex justify-content-between mb-4">
                <div>Payment Method</div>
                <div class="fw-bold fs-5">Cash On Delivery</div>
            </div>
            
            <button type="submit" class="btn btn-success w-100 rounded-pill mb-4">Checkout</button>
            <button class="btn btn-outline-dark w-100 rounded-pill">Back</button>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $('input').on('blur', function() {
                var userInput = $(this).val().trim();

                if (!userInput) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
    @endsection