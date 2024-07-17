@extends('livewire.user.index')
@section('content')

<section id="productDetailsPage">
    <div class="container-fluid mt-5">
        <div class="container">
            {{ Breadcrumbs::render('product-detail', $product) }}
        </div>

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
                            @elseif($quantityStock === 0)
                            <span class="text-danger">Out of Stock</span>
                            @else
                            <span class="text-success"> {{ $this->product->productVariants->sum('quantity') }} In Stock</span>
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


                    @if ($variants->isNotEmpty())
                    <div class="row g-3">
                        @foreach ($variants as $variant)
                        <div class="col-12">
                            <div class="d-flex flex-row gap-2 jutify-content-start align-items-center">
                                <div class="productDetail-variantName">{{ucfirst( $variant->name)}}</div>
                                <div class="d-flex flex-wrap gap-1 justify-content-between align-items-center">
                                    @foreach ($variantOptions->where('variant_id', $variant->id) as $variantOption)
                                    <div class="col-auto p-1 ">
                                        <input class="d-none productDetail-variantOption-input" wire:model="selectedOptions.{{ $variant->id }}" wire:click="updateSelectedOptions" type="radio" id="variantOption_{{ $variantOption->id }}" name="variantOption_{{ $variant->id }}" value="{{ $variantOption->id }}">
                                        <label class="productDetail-variantOption" data-variantId="{{$variant->id}}" for="variantOption_{{ $variantOption->id }}">{{ $variantOption->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- input Quantity -->
                    <div class="align-items-center d-flex">
                        <div class="d-flex gap-2 flex-row  w-100">
                            <div class="quantity-container ">
                                <button wire:click="decrement_quantity" type="button" id="button-decrease">-</button>
                                <input wire:model="quantity" type="text" class="text-center" value="1" aria-label="Quantity" id="quantity">
                                <button wire:click="increment_quantity" type="button" id="button-increase">+</button>
                            </div>
                            <button wire:click="addToCart" class="productDetail-addToCart">ADD TO CART</button>
                        </div>

                    </div>

                    <button wire:click="buyNow" type="button" class="productDetail-buynow">BUY NOW</button>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column gap-2 mt-5">
            <div class="fs-1 fw-bold">Description:</div>
            <div class="productDetail-description">{!! $product->description !!}</div>
        </div>

        @if (count($productSameCategory) > 0)
        <div class="d-flex flex-column gap-2 mt-5">
            <div class="d-flex flex-row justify-content-between align-content-center relatedProductWrapper">
                <div class="fs-2 fw-bold">RELATED PRODUCTS</div>
                <a wire:navigate href="{{route('user.list-product-category', $product -> category_id)}}" class="d-flex flex-row justify-content-center align-items-center gap-1"><span>See All</span> <i class="fas fa-angle-right mt-1"></i></a>
            </div>
            <div class="d-flex justify-content-start align-item-center">
                @if (count($productSameCategory) > 4)
                <div class="card-swiper-container swiper">
                    <div class="card-swiper-content">
                        <div class="swiper-wrapper">
                            @foreach ($productSameCategory as $psc)
                            <div class="card-product swiper-slide">
                                <a href="{{route('user.product-detail', $psc->id)}}" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        @if($psc->type === 'single')
                                        <button class="btncard-addToCart" wire:click="addToCart">ADD TO CART</button>
                                        @else
                                        <button class="btncard-selectOption"><a href="{{route('user.product-detail', $psc->id)}}">SELECT OPTION</a></button>
                                        @endif
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">{{$psc->name}}</div>
                                        <div class="card-price">${{$psc->productVariants->min('price')}}</div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
                @else
                @foreach ($productSameCategory as $psc)
                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 g-3 w-100">
                    <div class="col">
                        <div class="card-product">
                            <a href="{{route('user.product-detail', $psc->id)}}" class="overflow-hidden">
                                <div class="card-img-wrapper">
                                    <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                    @if($psc->type === 'single')
                                    <button class="btncard-addToCart" wire:click="addToCart">ADD TO CART</button>
                                    @else
                                    <button class="btncard-selectOption"><a href="{{route('user.product-detail', $psc->id)}}">SELECT OPTION</a></button>
                                    @endif
                                </div>
                                <div class="card-data">
                                    <div class="card-product-name">{{$psc->name}}</div>
                                    <div class="card-price">${{$psc->productVariants->min('price')}}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                @endforeach
                @endif
            </div>
        </div>
        @endif

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
        // $('.productDetails-variantoption').click(function() {
        //     var variantId = $(this).data('variantid');
        //     $('input[name=variantOption_' + variantId + ']').prop('checked', true);
        // });
    </script>
</section>

@endsection