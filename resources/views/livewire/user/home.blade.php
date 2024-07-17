@extends('livewire.user.index')
@section('content')
<div class="container">
    <!-- CAROUSEL -->
    <div class="mt-4">
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
                    <img src="{{ Storage::url($image->path) }}" class="d-block object-fit-cover w-100 vh-100" alt="Slide {{ $index + 1 }}">
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

    <!-- Hot Items -->
    <div class=" mt-5">
        <div class="d-flex flex-column gap-4">
            <div class="home-elementor-title">
                <div class="fw-bold fs-2">Hot Items</div>
                <a class="fs-4" href="">See all >></a>
            </div>
            <div class="d-flex justify-content-center align-item-center">
                <div class="card-swiper-container swiper">
                    <div class="card-swiper-content">
                        <div class="swiper-wrapper">
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- GARDENING TOOLS -->
    <div class=" mt-5">
        <div class="d-flex flex-column gap-4">
            <div class="home-elementor-title">
                <div class="fw-bold fs-2">GARDENING TOOLS</div>
                <a class="fs-4" href="">See all >></a>
            </div>
            <div class="d-flex justify-content-center align-item-center">
                <div class="card-swiper-container swiper">
                    <div class="card-swiper-content">
                        <div class="swiper-wrapper">
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-product swiper-slide">
                                <a href="" class="overflow-hidden">
                                    <div class="card-img-wrapper">
                                        <img src="https://dummyimage.com/600x400/000/fff" alt="image" class="card__img card__img-slide">
                                        <button class="btncard-addToCart">ADD TO CART</button>
                                    </div>
                                    <div class="card-data">
                                        <div class="card-product-name">Weed</div>
                                        <div class="card-price">$99.0</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Join our newsletter -->
    <div class="mt-5 join-newletter-container">
        <div class="row">
            <div class="col-md-5 col-12 d-flex flex-column justify-content-center gap-5">
                <div class="d-flex flex-column">
                    <p class="fs-5 opacity-75">Let's create a peaceful garden in our house</p>
                    <div class="join-newletter-title">
                        <div class="fw-bold fs-2">JOIN OUR NEWSLETTER</div>
                        <span class="material-symbols-outlined">
                            potted_plant
                        </span>
                    </div>
                </div>
                <p class="fs-5 opacity-75">Stay updated with our latest news, offers, and promotions.</p>
                <form wire:submit="subcribe">
                    <input wire:model="emailNotificationToSend" class="form-control join-newletter-input" type="email" placeholder="Enter your email" autocomplete="off" required>
                    <button wire:loading.attr="disabled" type="submit" class="btn-subcribe"><i class="fa-regular fa-paper-plane"></i></button>
                </form>
            </div>
            <div class="col-md-7 col-12">
                <img src="https://i.pinimg.com/564x/33/5d/b3/335db37b87853fce392cd247746a198b.jpg" alt="">
            </div>
        </div>

    </div>

    <!-- NEWS -->
    <div class="mt-5">
        <div class="d-flex flex-column gap-4">
            <div class="home-elementor-title">
                <div class="fw-bold fs-2">NEWS</div>
                <a class="fs-4" href="">See all >></a>
            </div>
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