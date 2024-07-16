@extends('livewire.user.index')
@section('content')

<section id="productDetailsPage">
    <div class="container-fluid">
        <div class="container">
            {{ Breadcrumbs::render('product-detail', $product) }}
        </div>

        <div class="productDetailContainer">
            <div class="row g-md-0 g-4">
                <div class="col-12 col-md-6 ">
                    <div class="d-flex flex-md-row flex-column gap-2">
                        <div id="carouselExample" class="carousel order-md-2 order-1 overflow-hidden w-100 h-100">
                            <div class="carousel-inner">
                                @foreach ($product->productImages as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ Storage::url($image->path) }}" class=" slickImg" alt="Product Image {{ $key + 1 }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex justify-content-start gap-4 flex-md-column flex-row order-md-1 order-2 align-items-center productImageList">
                            @if($product->productImages)
                            @foreach ($product->productImages as $key => $image)
                            <button type="button" class="thumbnail-button" type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}">
                                <img width="100" height="100" src="{{ Storage::url($image->path) }}" class="img-fluid thumbnail-button" alt="Product Image {{ $key + 1 }}">
                            </button>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 ps-4 pe-4">
                    <div class="container-fluid d-flex flex-column align-content-start gap-4">
                        <div class="productDetail-name">{{ $product->name }}</div>

                        <div class="d-flex flex-row justify-content-start align-content-center gap-5">
                            <div class="productDetail-category">Category: <span class="text-success">{{$product->category->name}}</span></div>
                            <div class="productDetail-stock">Stock:
                                @if($quantityStock)
                                <span class="text-success">{{ number_format($quantityStock) }} In Stock</span>
                                @else
                                <span class="text-danger">Out of Stock</span>
                                @endif
                            </div>
                        </div>

                        <div class="productDetail-price">
                            @if ($price)
                            <span>$ {{ number_format($price, 2) }}</span>
                            @else
                            <span>
                                $ {{ number_format($product->productVariants->min('price'), 2) }} - $ {{ number_format($product->productVariants->max('price'), 2) }}
                            </span>
                            @endif
                        </div>





                        <div class="productDetail-description">{!! $product->description !!}</div>

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

                        <!-- input Quantity -->
                        <div class="align-items-center d-flex">
                            <div class="d-flex gap-2 flex-row  w-100">
                                <div class="quantity-container ">
                                    <button wire:click="decrement_quantity" type="button"  id="button-decrease">-</button>
                                    <input wire:model="quantity" type="text" class="text-center" value="1" aria-label="Quantity" id="quantity">
                                    <button wire:click="increment_quantity" type="button"  id="button-increase">+</button>
                                </div>
                                <button wire:click="addToCart" class="productDetail-addToCart">ADD TO CART</button>
                            </div>

                        </div>

                        <button wire:click="buyNow" type="button" class="productDetail-buynow">Mua hàng</button>
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