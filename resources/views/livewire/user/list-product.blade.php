@extends('livewire.user.index')
@section('content')
<section id="listProductPage">
    <div class="container">
        @if (!$listProductCategory)
        <div class="container">
            {{ Breadcrumbs::render('shop') }}
        </div>
        @else
        <div class="container">
            {{ Breadcrumbs::render('category', $category) }}
        </div>
        @endif

        <!-- cai cua Minh -->
        @if($products)
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 g-3">
            @foreach ($products as $product)
            <div class="col">
                <div class="card-product">
                    <a wire:navigate href="{{ route('user.product-detail', $product->id) }}">
                        <div class="card-img-wrapper">
                            <img src="{{ Storage::url($product->productImages->first()->path) }}" class="card__img" alt="...">
                            @if($product->type === 'single')
                            <button class="btncard-addToCart">ADD TO CART</button>
                            @else
                            <button class="btncard-selectOption">SELECT OPTION</button>
                            @endif
                        </div>
                        <div class="card-data">
                            <h5 class="card-product-name">{{ $product->name }}</h5>
                            <div class="card-category">{{ $product->category->name }}</div>
                            <div class="card-product-type">{{ $product->type }}</div>
                            @if($product->productVariants->isNotEmpty())
                            <div class="card-price">${{ number_format($product->productVariants->min('price'), 2) }}</div>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p>No products found.</p>
        @endif
    </div>
</section>
@endsection