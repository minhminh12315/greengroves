@extends('livewire.user.index')
@section('content')
<div>
    <div class="container">
        {{ Breadcrumbs::render('home') }}
    </div>
    <!-- CAROUSEL -->
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
            <div class="carousel-indicators">
                <!-- Các chỉ số slide sẽ được tạo ra dựa trên số lượng hình ảnh có type là 'slide' -->
                @foreach($carouselImages as $index => $image)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($carouselImages as $index => $image)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($image->path) }}" class="d-block w-100" alt="Slide {{ $index + 1 }}">
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- GARDENING TOOLS -->
    <div class="container mt-5">
        <div class="d-flex flex-column gap-4">
            <h1 class="text-center">-- GARDENING TOOLS --</h1>
            <div class="row row-cols-lg-4 row-cols-md-3 row-cols-1 g-3">
                @foreach($gardeningtools as $key => $product)
                <div class="col">
                    <div class="card user-card-product">
                        <a href="{{ route('user.product-detail', ['id' => $product->id]) }}">
                            <div class="overflow-hidden">
                                @if($product->productImages->isNotEmpty())
                                <img src="{{ Storage::url($product->productImages[0]->path) }}" class="card-img-top" alt="Product Image">
                                @else
                                <img src="{{ asset('images/default-image.jpg') }}" class="card-img-top" alt="Default Image">
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">{{$product->name}}</h4>
                                @if($product->productVariants->isNotEmpty())
                                <p class="card-text"> {{$product->productVariants->min('price')}} </p>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- NEWS -->
    <div class="container mt-5">
        <div class="d-flex flex-column gap-4">
            <h1 class="text-center">-- NEWS --</h1>
            <div class="row row-cols-lg-3 row-cols-1  g-3">
                <div class="col">
                    <div class="card user-card-news" style="height: 100%; width:100%;">
                        <a href="">
                            <div class="overflow-hidden">
                                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card user-card-news" style="height: 100%; width:100%;">
                        <a href="">
                            <div class="overflow-hidden">
                                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card user-card-news" style="height: 100%; width:100%;">
                        <a href="">
                            <div class="overflow-hidden">
                                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection