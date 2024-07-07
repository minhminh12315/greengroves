@extends('livewire.user.index')
@section('content')

<section id="productDetailsPage">
    <div class="container-fluid">

        <div class="row currentAddress p-4">
            <div class="col-12 d-flex align-items-center ">
                <div class="me-2 " style="cursor: pointer;">
                    <div class=" linkHover">HOME</div>
                </div>
                <div class="me-2 d-flex align-items-center " style="cursor: pointer;">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ms-2 linkHover">CATEGORY</span>
                </div>
                <div class="me-2 d-flex align-items-center " style="cursor: pointer;">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ms-2 linkHover">CATEGORY_CHILD</span>
                </div>
                <div class="d-flex align-items-center " style="cursor: pointer;">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ms-2 linkHover">PRODUCT_NAME</span>
                </div>
            </div>
        </div>
        <div class="productDetailContainer">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($product->productImages as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ Storage::url($image->path) }}" class="d-block slickImg" alt="Product Image {{ $key + 1 }}">
                                    </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="row d-flex justify-content-evenly align-items-center productImageList">
                                @foreach ($product->productImages as $key => $image)
                                <div class="col-auto productItems ">
                                    <div class="productImageItems">
                                        <button class="border border-0 bg-transparent" type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}">
                                            <img width="100" height="100" src="{{ Storage::url($image->path) }}" class="img-fluid" alt="Product Image {{ $key + 1 }}">
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="shareContainer col-12 d-flex justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 col-4 d-flex justify-content-start justify-content-md-end align-content-center">
                                    <div class="shareText">
                                        Share:
                                    </div>
                                </div>
                                <div class="col-xl-6 col-8">
                                    <div class="d-flex justify-content-center">
                                        <div class="share">
                                            <button class="btn btn-primary" id="copyLinkButton" type="button">Copy Link</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 ps-4 pe-4">
                    <div class="container-fluid ProductDetail">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-12">
                                <h2>{{ $product->name }}</h2>
                            </div>
                            <!-- Price -->
                            <div class="col-12 mt-2">
                                @if ($this->price)
                                <div class="price">
                                    <span>$ {{ number_format($this->price, 0, ',', '.') }}</span>
                                </div>
                                @else
                                <div>$ {{ $product->productVariants->min('price') }} - {{ $product->productVariants->max('price') }}</div>
                                @endif
                                
                                
                            </div>
                            <div class="col-12 mt-2">
                                <p>Đã bán: <span>1000 sản phẩm</span></p>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="description">{{ $product->description }}</div>
                            </div>
                            <div class="col-12 mt-2">
                                @if ($variants->isNotEmpty())
                                @foreach ($variants as $variant)
                                <div class="row align-items-center">
                                    <div class="col-2 col-xxl-2 col-md-3 d-flex align-content-center">{{ $variant->name }}</div>
                                    <div class="col-10 col-md-9">
                                        <div class="row px-4 d-flex justify-content-start">
                                            @foreach ($variantOptions->where('variant_id', $variant->id) as $variantOption)
                                            <div class="col-auto p-1">
                                                <label for="variantOption_{{ $variantOption->id }}">{{ $variantOption->name }}</label>
                                                <input wire:model="selectedOptions.{{ $variant->id }}" wire:click="updateSelectedOptions" type="radio" id="variantOption_{{ $variantOption->id }}" name="variantOption_{{ $variant->id }}" value="{{ $variantOption->id }}">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <!-- input Quantity -->
                            <div class="col-12 mt-3">
                                <div class="row align-items-center">
                                    <div class="col-3 col-xxl-2 d-flex align-content-center">Số
                                        lượng:</div>
                                    <div class="col-5 col-sm-3 col-md-6 col-xxl-3">
                                        <div class="input-group quantity-group">
                                            <button wire:click="decrement_quantity" class="btn btn-outline-secondary" type="button" id="button-decrease">-</button>
                                            <input wire:model="quantity" type="text" class="form-control text-center" value="1" aria-label="Quantity" id="quantity">
                                            <button wire:click="increment_quantity" class="btn btn-outline-secondary" type="button" id="button-increase">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- button Add to cart  -->
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary w-100">Thêm
                                            giỏ hàng</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-success w-100">Mua
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
                    <h2>Sản phẩm liên quan</h2>
                </div>

                <div class="col-6 text-end">
                    <a href="#" class="viewAllLink ">Xem tất cả <i class="fas fa-angle-right"></i></a>
                </div>
            </div>

            <div class="row relativeProduct flex-wrap pt-3">
                <div class="col-4 col-md-auto m-md-2">
                    <div class="card mouse">
                        <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title p-1">Card title</h5>
                            <div class="row">
                                <div class="col-12 col-md-6 textItems ">
                                    <div class="price text-md-center">
                                        <span>22.99$</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 textItems mt-1">
                                    <div class="wasSell">
                                        Đã bán 13,8k
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-4 col-md-auto m-md-2">
                    <div class="card mouse">
                        <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title p-1">Card title</h5>
                            <div class="row">
                                <div class="col-12 col-md-6 textItems">
                                    <div class="price text-md-center">
                                        <span>22.99$</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 textItems">
                                    <div class="wasSell">
                                        Đã bán 13,8k
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-4 col-md-auto m-md-2">
                    <div class="card mouse">
                        <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title p-1">Card title</h5>
                            <div class="row">
                                <div class="col-12 col-md-6 textItems">
                                    <div class="price text-md-center">
                                        <span>22.99$</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 textItems">
                                    <div class="wasSell text-center">
                                        Đã bán 13,8k
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-auto m-2 hidden">
                    <div class="card mouse">
                        <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title p-1">Card title</h5>
                            <div class="d-flex justify-content-between align-items-center flex-container">
                                <div class="price">
                                    <span>22.99$</span>
                                </div>
                                <div class="wasSell text-center">
                                    Đã bán 13,8k
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-auto m-2 hidden">
                    <div class="card mouse">
                        <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
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
                    <div class="card mouse">
                        <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
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
                    <div class="card mouse">
                        <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
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

    <script>
        document.getElementById('copyLinkButton').addEventListener('click', function() {
            var currentUrl = window.location.href;
            var tempInput = document.createElement('input');
            tempInput.value = currentUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            // Thông báo sao chép thành công
            alert('Link sản phẩm đã được sao chép: ' + currentUrl);
        });
    </script>
</section>

@endsection