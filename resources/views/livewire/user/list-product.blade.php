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
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 g-3">
            @foreach ($products as $p)
            <div class="col">
                <div class="card-product">
                    <a wire:navigate href="{{route('user.product-detail', $p->id)}}">
                        <div class="card-img-wrapper">
                            <img src="https://dummyimage.com/600x400/000/fff888" class="card__img" alt="...">
                            @if($p->type === 'single')
                            <button class="btncard-addToCart">ADD TO CART</button>
                            @else
                            <button class="btncard-selectOption">SELECT OPTION</button>
                            @endif
                        </div>
                        <div class="card-data">
                            <h5 class="card-product-name">{{$p->name}}</h5>
                            <div class="card-category">{{$p->category->name}}</div>
                            <div class="card-product-type">{{$p->type}}</div>
                            @if($p->productVariants->isNotEmpty())
                            <div class="card-price">${{ number_format($p->productVariants->min('price'), 2) }}</div>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection