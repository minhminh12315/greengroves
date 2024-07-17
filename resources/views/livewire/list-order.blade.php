@extends('livewire.index')
@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>List Of Ordered Products</h1>
        <div class="btn-showAsideSetting d-lg-none d-block">
            <span class="material-symbols-outlined">
                menu
            </span>
        </div>
    </div>
    <div class="row">
        <div class="ordered-item col-12">
            <!-- order-detail-item -->
            <div class="d-flex flex-row justify-content-between align-items-center mb-4 w-100">
                <div class="d-flex flex-row justify-content-start align-items-center gap-4">
                    <img class="ordered-img" width="100" height="100" src="https://dummyimage.com/600x400/000/fff" alt="">
                    <div class="d-flex flex-column gap-2">
                        <h4>Product Name</h4>
                        <div>Category</div>
                        <div>x1</div>
                    </div>
                </div>
                <p class="text-success fs-4">$59</p>
            </div>
            <!-- order-detail-item -->

            <div class="d-flex justify-content-center align-items-end flex-column border-top w-100 p-4">
                <div class="d-flex flex-row align-items-center justify-content-center gap-1">
                    <p>Total price:</p>
                    <div class="text-success fs-3">$59</div>
                </div>
                <button class="btn_success">Repurchase</button>
            </div>
        </div>
    </div>
</div>
@endsection