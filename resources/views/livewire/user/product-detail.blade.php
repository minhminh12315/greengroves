
@extends('livewire.user.index')
@section('content')

<section id="productDetailsPage">
    <div class="container-fluid">
        <div class="row currentAddress p-4">
            <div class="col-12 d-flex align-items-center">
                <div class="me-2" style="cursor: pointer;">
                    <div onmouseover="this.style.color='red'; this.style.transform='scale(1.05)'; this.nextElementSibling.style.display='inline'" onmouseout="this.style.color='black'; this.style.transform='scale(1)'; this.nextElementSibling.style.display='none'">HOME</div>
                </div>
                <div class="me-2 d-flex align-items-center" style="cursor: pointer;">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ms-2"  onmouseover="this.style.color='red'; this.style.transform='scale(1.05)'; this.nextElementSibling.style.display='inline'" onmouseout="this.style.color='black'; this.style.transform='scale(1)'; this.nextElementSibling.style.display='none'">CATEGORY</span>
                </div>
                <div class="me-2 d-flex align-items-center" style="cursor: pointer;">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ms-2"  onmouseover="this.style.color='red'; this.style.transform='scale(1.05)'; this.nextElementSibling.style.display='inline'" onmouseout="this.style.color='black'; this.style.transform='scale(1)'; this.nextElementSibling.style.display='none'">CATEGORY_CHILD</span>
                </div>
                <div class="d-flex align-items-center" style="cursor: pointer;">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ms-2"  onmouseover="this.style.color='red'; this.style.transform='scale(1.05)'; this.nextElementSibling.style.display='inline'" onmouseout="this.style.color='black'; this.style.transform='scale(1)'; this.nextElementSibling.style.display='none'">PRODUCT_NAME</span>
                </div>
            </div>
        </div>
        <div class="productDetailContainer">
            <div class="row">
                <div class="col-12 col-md-6 p-4">
                    <div class="row">
                        <div class="col-12 m-2">
                            <div id="carouselExample"
                                class="carousel slide"
                                data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="./img1.jpg"
                                            class="d-block slickImg "
                                            alt="Product Image 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="./img1.jpg"
                                            class="d-block slickImg"
                                            alt="Product Image 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="./img1.jpg"
                                            class="d-block slickImg"
                                            alt="Product Image 3">
                                    </div>
                                </div>
                                <button class="carousel-control-prev"
                                    type="button"
                                    data-bs-target="#carouselExample"
                                    data-bs-slide="prev">
                                    <span
                                        class="carousel-control-prev-icon"
                                        aria-hidden="true"></span>
                                    <span
                                        class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next"
                                    type="button"
                                    data-bs-target="#carouselExample"
                                    data-bs-slide="next">
                                    <span
                                        class="carousel-control-next-icon"
                                        aria-hidden="true"></span>
                                    <span
                                        class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>

                        <div class="col-12 productImageList">
                            <div
                                class="row d-flex justify-content-center align-items-center">
                                <div class="col-2 px-1">
                                    <div class="productImageItems">
                                        <img src="./logo.webp"
                                            class="img-fluid" alt>
                                    </div>
                                </div>
                                <div class="col-2 px-1">
                                    <div class="productImageItems">
                                        <img src="./logo.webp"
                                            class="img-fluid" alt>
                                    </div>
                                </div>
                                <div class="col-2 px-1">
                                    <div class="productImageItems">
                                        <img src="./logo.webp"
                                            class="img-fluid" alt>
                                    </div>
                                </div>
                                <div class="col-2 px-1">
                                    <div class="productImageItems">
                                        <img src="./logo.webp"
                                            class="img-fluid" alt>
                                    </div>
                                </div>
                                <div class="col-2 px-1">
                                    <div class="productImageItems">
                                        <img src="./logo.webp"
                                            class="img-fluid" alt>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="shareContainer">
                            <div class="row align-items-center">
                                <div
                                    class="col-md-3 col-3 d-flex justify-content-end justify-content-md-end align-content-center">
                                    <div class="shareText">
                                        Chia sẻ:
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="row px-xl-5">
                                        <div class="col-4">
                                            <a href="#"
                                                class="btn btn-primary"><i
                                                    class="fa-brands fa-facebook linkFont"></i></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="btn btn-primary"><i
                                                    class="fa-brands fa-twitter linkFont"></i></i></a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#"
                                            class="btn btn-primary"><i
                                                class="fa-brands fa-instagram linkFont"></i></i></a>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-md-5 col-5 d-flex justify-content-md-center justify-content-sm-start align-content-center">
                            <div class="likeText">
                                <i class="fas fa-heart"></i> Đã thích
                                (12k)
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-12 p-4">
            <div class="container-fluid ProductDetail">
                <div class="row">
                    <div class="col-12">
                        <h2>Tên sản phẩm</h2>
                    </div>
                    <div class="col-12">
                        <h4><span class="text-danger">$99.99</span></h4>
                    </div>
                    <div class="col-12">
                        <p>Đánh giá sao: <span
                                class="text-warning">★★★★★</span></p>
                        <p>Đánh giá: <span>500 đánh giá</span></p>
                        <p>Đã bán: <span>1000 sản phẩm</span></p>
                    </div>
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div
                                class="col-2 col-xxl-2 col-md-3 d-flex align-content-center">Size
                                :</div>
                            <div class="col-10 col-md-9">
                                <div
                                    class="row px-4 d-flex justify-content-start">
                                    <div class="col-auto p-1">
                                        <button type="button"
                                            class="btn btn-secondary">XS</button>
                                    </div>
                                    <div class="col-auto p-1">
                                        <button type="button"
                                            class="btn btn-secondary">S</button>
                                    </div>
                                    <div class="col-auto p-1">
                                        <button type="button"
                                            class="btn btn-secondary">M</button>
                                    </div>
                                    <div class="col-auto p-1">
                                        <button type="button"
                                            class="btn btn-secondary">L</button>
                                    </div>
                                    <div
                                        class="col-auto p-1 d-md-none d-xl-block">
                                        <button type="button"
                                            class="btn btn-secondary">XL</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <p>Mô tả sản phẩm:</p>
                        <p>Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Nullam vehicula purus ac
                            mauris consectetur, ut finibus metus
                            maximus. Phasellus pretium risus et nulla
                            finibus, vel venenatis leo feugiat.</p>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row align-items-center">
                            <div
                                class="col-3 col-xxl-2 d-flex align-content-center">Số
                                lượng:</div>
                            <div
                                class="col-5 col-sm-3 col-md-6 col-xxl-3">
                                <div class="input-group quantity-group">
                                    <button
                                        class="btn btn-outline-secondary"
                                        type="button"
                                        id="button-decrease">-</button>
                                    <input type="text"
                                        class="form-control text-center"
                                        value="1" aria-label="Quantity"
                                        id="quantity">
                                    <button
                                        class="btn btn-outline-secondary"
                                        type="button"
                                        id="button-increase">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-6">
                                <button type="button"
                                    class="btn btn-primary w-100">Thêm
                                    giỏ hàng</button>
                            </div>
                            <div class="col-6">
                                <button type="button"
                                    class="btn btn-success w-100">Mua
                                    hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<div class="container-fluid relativeProductContainer p-3">
    <div class="row">
            <div class="col-6">
                <h2 >Sản phẩm liên quan</h2>
            </div>

            <div class="col-6 text-end">
                <a href="#" class="viewAllLink ">Xem tất cả <i
                        class="fas fa-angle-right"></i></a>
            </div>
    </div>

        <div class="row relativeProduct flex-wrap pt-3">
            <div class="col-4 col-md-auto m-md-2">
                <div class="card mouse" >
                    <img src="./logo.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title p-1">Card title</h5>
                        <div class="d-flex justify-content-between align-items-center flex-container">
                            <div class="price">
                                <span>22.99$</span>
                            </div>
                            <div class="wasSell">
                                Đã bán 13,8k
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-4 col-md-auto m-md-2">
                <div class="card mouse" >
                    <img src="./logo.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title p-1">Card title</h5>
                        <div class="d-flex justify-content-between align-items-center flex-container">
                            <div class="price">
                                <span>22.99$</span>
                            </div>
                            <div class="wasSell">
                                Đã bán 13,8k
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-4 col-md-auto m-md-2">
                <div class="card mouse" >
                    <img src="./logo.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title p-1">Card title</h5>
                        <div class="d-flex justify-content-between align-items-center flex-container">
                            <div class="price">
                                <span>22.99$</span>
                            </div>
                            <div class="wasSell">
                                Đã bán 13,8k
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-auto m-2 hidden">
                <div class="card mouse" >
                    <img src="./logo.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title p-1">Card title</h5>
                        <div class="d-flex justify-content-between align-items-center flex-container">
                            <div class="price">
                                <span>22.99$</span>
                            </div>
                            <div class="wasSell">
                                Đã bán 13,8k
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-auto m-2 hidden">
                <div class="card mouse" >
                    <img src="./logo.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title p-1">Card title</h5>
                        <div class="d-flex justify-content-between align-items-center flex-container">
                            <div class="price">
                                <span>22.99$</span>
                            </div>
                            <div class="wasSell">
                                Đã bán 13,8k
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-auto m-2 hidden">
                <div class="card mouse" >
                    <img src="./logo.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title p-1">Card title</h5>
                        <div class="d-flex justify-content-between align-items-center flex-container">
                            <div class="price">
                                <span>22.99$</span>
                            </div>
                            <div class="wasSell">
                                Đã bán 13,8k
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-auto m-2 hidden">
                <div class="card mouse" >
                    <img src="./logo.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title p-1">Card title</h5>
                        <div class="d-flex justify-content-between align-items-center flex-container">
                            <div class="price">
                                <span>22.99$</span>
                            </div>
                            <div class="wasSell">
                                Đã bán 13,8k
                            </div>
                        </div>

                    </div>
                </div>

            </div>





        </div>
    </div>

    </div>
</section>

@endsection
