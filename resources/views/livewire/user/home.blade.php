@extends('livewire.user.index')
@section('content')
<div>
    <!-- CAROUSEL -->
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://dummyimage.com/600x400/000/fff888" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://dummyimage.com/600x400/000/13d420" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://dummyimage.com/600x400/000/fff2fd" class="d-block w-100" alt="...">
                </div>
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
                <div class="col">
                    <div class="card user-card-product" style="height: 100%;">
                        <a href="">
                            <div class="overflow-hidden">
                                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">$99</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card user-card-product" style="height: 100%;">
                        <a href="">
                            <div class="overflow-hidden">
                                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">$99</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card user-card-product" style="height: 100%;">
                        <a href="">
                            <div class="overflow-hidden">
                                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">$99</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card user-card-product" style="height: 100%;">
                        <a href="">
                            <div class="overflow-hidden">
                                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">$99</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card user-card-product" style="height: 100%;">
                        <a href="">
                            <div class="overflow-hidden">
                                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">$99</p>
                            </div>
                        </a>
                    </div>
                </div>
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