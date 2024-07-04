@extends('livewire.user.index')
@section('content')
<div class="container">
    <form class="row row-cols-md-2 row-cols-sm-1">
        <div class="col-md-8 col-sm-12">
            <h3 class="mb-4">Checkout</h3>
            <div class="form-checkout">
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-6">
                        <label class="p-1" for="email">Email*</label>
                        <input type="text" class="form-control p-1" name="email" required>
                    </div>
                </div>
                <h4 class="mb-4">Delivery</h4>
                <div class="row mb-4">
                    <div class="col-md-6 col-sm-12">
                        <label class="p-1" for="name">Fullname*</label>
                        <input type="text" class="form-control p-1" name="name" required>
                    </div>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="col-md-6 col-sm-12 mb-4">
                        <label class="p-1" for="phone">Phone Number*</label>
                        <input type="text" class="form-control p-1" name="phone" required>
            </div>
                    <div class="col-md-6 col-sm-12 mb-4">
                        <label class="p-1" for="address">Address*</label>
                        <input type="text" class="form-control p-1" name="address" required>
                    </div>
                </div>
                <div class="row row-cols-md-2 row-cols-sm-1">
                    <div class="col-md-6 col-sm-12 mb-4">
                        <label class="p-1" for="street">Distric*</label>
                        <input type="text" class="form-control p-1" name="street" required>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-4">
                        <label class="p-1" for="city">City*</label>
                        <input type="text" class="form-control p-1" name="city" required>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <label class="p-1" for="Name">Notes - Optional</label>
                    <textarea class="form-control p-1" name="name"></textarea>
                </div>
            </div>
        </div>
        <div class="subTotal bg-body-tertiary rounded-3 position-sticky col-md-4 col-sm-12 p-3">
            <div class="border-bot d-flex justify-content-between fs-3 fw-bold mb-4">
                <div>Total Price</div>
                <div>9.999.999$</div>
            </div>
            <div class="fs-6 mb-3">
                <div class="d-flex justify-content-between">
                    <div>Product Price:</div>
                    <div class="fw-bold">99.999$</div>
    </div>
                <div class="d-flex justify-content-between">
                    <div>Delivery:</div>
                    <div class="fw-bold">99.999$</div>
                </div>
            </div>
            <div class="fs-6 fw-bold">Cart</div>
            <div class="border-bot mb-3">
                <div class="d-flex row mb-3">
                    <img class="col-3" src="" alt="image">
                    <div class="col-7">
                        <div>Product Name</div>
                        <p class="small">Material</p>
                        <p class="small">Color</p>
                        <p class="small">Size</p>
                    </div>
                    <div class="col-2 text-end">Price</div>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <div>Payment Method</div>
                <div class="fw-bold fs-5">Cash On Delivery</div>
            </div>
            <button class="btn btn-success w-100 rounded-pill mb-4">Checkout</button>
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