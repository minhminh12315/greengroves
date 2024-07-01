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
                                <th scope="col" class="text-center" >Product</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center" >Quantity</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="wrapper-container">
                                        <div class="wrapper-item">
                                            <input type="checkbox" class="selectItem">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <img src="https://dummyimage.com/600x400/000/fff2fd" alt="Product 1" class="img-thumbnail" style="width: 160px;height: 160px;">
                                </td>
                                <td class="text-center">Product 1</td>
                                <td class="text-center">$19.99</td>
                                <td>
                                    <input type="number" class="form-control text-center" value="1" min="1">
                                </td>
                                <td class="text-center">$19.99</td>
                                <td class="text-center">
                                    <button class="btn btn-danger">Remove</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="wrapper-container">
                                        <div class="wrapper-item">
                                            <input type="checkbox" class="selectItem">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <img src="https://dummyimage.com/600x400/000/fff2fd" alt="Product 1" class="img-thumbnail" style="width: 160px;height: 150px;">
                                </td>
                                <td class="text-center">Product 1</td>
                                <td class="text-center">$19.99</td>
                                <td>
                                    <input type="number" class="form-control text-center" value="1" min="1">
                                </td>
                                <td class="text-center">$19.99</td>
                                <td class="text-center">
                                    <button class="btn btn-danger">Remove</button>
                                </td>
                            </tr>
                            <!-- Add more products as needed -->

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 text-start">
                <div class="totalPrice">
                    <div class="wrapper-container">
                        <div class="wrapper-item">
                            <div class="d-inline textPrice">Total Price :</div>
                            <div class="d-inline textPrice">$19.99</div>
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
