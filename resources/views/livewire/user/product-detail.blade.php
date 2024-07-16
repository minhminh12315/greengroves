@extends('livewire.user.index')
@section('content')

<section id="productDetailsPage">
    <div class="container-fluid">
        <div class="container">
            {{ Breadcrumbs::render('product-detail', $product) }}
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
                                @if($product->productImages)
                                @foreach ($product->productImages as $key => $image)
                                <div class="col-auto productItems ">
                                    <div class="productImageItems">
                                        <button class="border border-0 bg-transparent" type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}">
                                            <img width="100" height="100" src="{{ Storage::url($image->path) }}" class="img-fluid" alt="Product Image {{ $key + 1 }}">
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div>khong anh</div>
                                @endif
                            </div>
                        </div>

                        <div class="shareContainer col-12 d-flex justify-content-center mt-1">
                            <div class="row">
                                <div class="col-xl-4 col-4 d-flex justify-content-start justify-content-md-end align-content-center">
                                    <div class="shareText">
                                        Share:
                                    </div>
                                </div>
                                <div class="col-xl-8 col-8">
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
                                    <span>$ {{ number_format($this->price, 2) }}</span>
                                </div>
                                @else
                                <div>
                                    $ {{ number_format($product->productVariants->min('price'), 2) }} - $ {{ number_format($product->productVariants->max('price'), 2) }}
                                </div>
                                @endif


                            </div>
                            <div class="col-12 mt-2">
                                @if($quantityStock)
                                <div> Quantity stock: {{ number_format($quantityStock) }}</div>
                                @endif
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
                                <div class="row align-items-center d-flex">
                                    <div class="col-3 col-xxl-2 d-flex align-content-center">Số
                                        lượng:</div>
                                    <div class="col-5 col-xxl-6 col-sm-3 col-md-6  d-flex">

                                        <div class="input-group quantity-group">
                                            <button wire:click="decrement_quantity" class="btn btn-outline-secondary" type="button" id="button-decrease">-</button>
                                            <input wire:model="quantity" type="text" class="form-control text-center" value="1" aria-label="Quantity" id="quantity">
                                            <button wire:click="increment_quantity" class="btn btn-outline-secondary" type="button" id="button-increase">+</button>
                                            <!-- show Quantity Stock -->

                                            <!-- Quantity Error -->
                                        </div>
                                    </div>
                                    @if(session()->has('errorQuantity'))
                                    <div class="alert alert-danger mt-2 h-100 w-75">{{ session('errorQuantity') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- button Add to cart  -->
                            <div class="col-12 mt-4">
                                <div class="row">
                                    @if(session()->has('error'))
                                    <div class="alert alert-danger mt-2 h-75">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    <div class="col-6">
                                        <button wire:click="addToCart" class="btn btn-primary w-100">Thêm vào giỏ hàng</button>
                                    </div>

                                    <div class="col-6">
                                        <button wire:click="buyNow" type="button" class="btn btn-success w-100">Mua hàng</button>
                                    </div>
                                    @if (session()->has('success'))
                                    <div class="alert alert-success mt-2 h-75">
                                        {{ session('success') }}
                                    </div>
                                    @endif
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
                    <a wire:navigate href="{{route('user.list-product-category', $product -> category_id)}}" class="viewAllLink ">Xem tất cả <i class="fas fa-angle-right"></i></a>
                </div>
            </div>

            <div class="row relativeProduct flex-wrap pt-3">
                @foreach ($this->productSameCategory as $psc)
                <div class="col-4 col-md-auto m-md-2">
                    <a href="{{route('user.product-detail', $psc->id)}}">
                        <div class="card mouse">
                            @if ($psc->productImages->isEmpty())
                            <div>khong co anh</div>
                            @else
                            <img src="{{Storage::url($psc->productImages->first()->path)}}" width="100" height="100" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title p-1">{{$psc->name}}</h5>
                                <div class="row">
                                    <div class="col-12 col-md-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>{{$psc->productVariants->min('price')}}$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach


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