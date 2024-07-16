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
        <div class="row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-2 row-cols-1 g-5">
            @foreach ($products as $p)
            <div class="col">
                <div class="card user-card-product">
                    <a wire:navigate href="{{route('user.product-detail', $p->id)}}">
                        <div class="overflow-hidden">
                            <img src="https://dummyimage.com/600x400/000/fff888" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title ">{{$p->name}}</h5>
                            @if($p->productVariants->isNotEmpty())
                            <p class="card-text">{{ number_format($p->productVariants->min('price'), 2) }}</p>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination links -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
