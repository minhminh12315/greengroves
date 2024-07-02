@extends('livewire.user.index')
@section('content')
<div class="checkoutPage container">
    <div class="delivery p-3">
        <h2 class="mb-5">Delivery</h2>
        <form class="form-checkout">
            <div class="row mb-5">
                <div class="col-7 checkout-box input-group-lg">
                    <input type="text" class="form-control" id="firstName" required>
                    <label for="firstName">First Name</label>
                </div>
                <div class="col-5 checkout-box input-group-lg">
                    <input type="text" class="form-control" id="lastName" required>
                    <label for="lastName">Last Name</label>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-8 checkout-box input-group-lg">
                    <input type="text" class="form-control" id="address" required>
                    <label for="address">Address</label>
                </div>
                <div class="col-4 checkout-box input-group-lg">
                    <input type="text" class="form-control" id="city" required>
                    <label for="city">City</label>
                </div>
            </div>
            <div class="row mb-3 ">
                <div class="col-6 checkout-box input-group-lg">
                    <input type="text" class="form-control" id="phone" required>
                    <label for="phone">Phone</label>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input border border-secondary"></input>
                <span class="small">LƯU THÔNG TIN NGƯỜI DÙNG</span>
            </div>
            <p class="text-uppercase small mb-5">* Hiện tại chúng tôi chỉ hỗ trợ phương thức thanh toán khi nhận hàng (COD)</p>
        </form>
    </div>
    <div class="line bg-secondary"></div>
    <div class="subTotal p-3">
        <h2 class="mb-2">Cart</h2>
        <div class="checkout-product mb-5">
            <div class="checkout-product-image">
                <img src="https://dummyimage.com/600x400/000/fff" class="rounded-4">
                <div class="checkout-quantity rounded-circle bg-primary-subtle">
                    <div>2</div>
                </div>
            </div>
            <div class="checkout-product-details">
                <div class="checkout-product-infor">
                    <div class="checkout-product-name">Nhẫn Bạc S925 Winter Lotus Ring Helios Silver Original</div>
                    <p class="text-small">Chất liệu</p>
                    <p class="text-small">Size</p>
                    <p class="text-small">Màu</p>
                </div>
            </div>
            <div class="checkout-product-price text-end">
                <div>9.999.999$</div>
            </div>
        </div>
        <div class="subtotal-transport mb-5">
            <div class="checkout-subtotal d-flex justify-content-between mb-3">
                <div class="text-uppercase fw-bold small">Sub Total</div>
                <div>9.999.999$</div>
            </div>
            <div class="checkout-transport d-flex justify-content-between mb-3">
                <div class="text-uppercase fw-bold small">Transport</div>
                <div>Free</div>
            </div>
        </div>
        <div class="checkout-total d-flex justify-content-between mb-3">
            <div class="text-uppercase fs-5 fw-bold">Total</div>
            <div>9.999.999$</div>
        </div>
        <div class="text-center">
            <input type="submit" value="Checkout" class="btn btn-success w-75"></input>
        </div>
    </div>
</div>
@endsection