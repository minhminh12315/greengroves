@extends('livewire.user.index')
@section('content')
<div class="p-5" id="AboutPage">
    <div class="ms-3">
        {{ Breadcrumbs::render('about') }}
    </div>
    <div class="aboutUsContainer ">
        <div class="row row-cols-1 g-5">
            <div class="col">
                <div class="d-flex justify-content-center align-items-center flex-column gap-2">
                    <h1 class="text-center">WE ARE GETHSEMANI !</h1>
                    <p class="text-center">We are on a mission to bring for gardening enthusiasts</p>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-row gap-1 flex-nowrap align-items-center justify-content-center w-100 flex-shrink">
                </div>
            </div>
            <div class="col">
                <h4 class="text-center">Unique design, Each house is a masterpiece, dedicated to every little detail in your garden!</h4>
            </div>
            <div class="col">
                <div class="d-flex flex-row gap-1 flex-nowrap align-items-center justify-content-center w-100 flex-shrink">
                    <img src="https://dummyimage.com/600x400/000/fff888" class="we-are-img-169" alt="">
                    <img src="https://dummyimage.com/600x400/000/fff888" class="we-are-img-169" alt="">
                    <img src="https://dummyimage.com/600x400/000/fff888" class="we-are-img-169" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h1 class="text-center p-2">GETHSEMANI - WHO ARE WE?</h1>
        <div class="row row-cols-lg-2 row-cols-md-1 row-cols-1 g-3 p-3">
            <div class="col">
                <img src="https://dummyimage.com/600x400/000/fff888" class="we-are-img-43" alt="...">
            </div>
            <div class="col">
                <p class="lh-lg"><b>Established in 2024</b>, GETHSEMANI is a brand dedicated to gardening enthusiasts, providing high-quality green plants and gardening tools. We not only sell products but also share gardening knowledge to help you create and maintain small-scale gardens effectively. With GETHSEMANI, you will find peace in gardening and satisfaction from meticulously selected products. We offer detailed guides and gardening tips, from choosing the right plants and planting techniques to caring for green plants, helping you create a lush and vibrant green space. Let GETHSEMANI be your trusted partner in turning your dream of a verdant garden into reality.</p>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h1 class="text-center p-2">WHAT CONSTITUTES GETHSEMNI ?</h1>
        <div class="row row-cols-lg-2 row-cols-md-1 row-cols-1 g-3 p-3">
            <div class="col">
                <p class="lh-lg">GETHSEMANI is born out of a passionate love for gardening and a deep affection for nature. We are committed to delivering quality products, from a diverse range of green plants to advanced gardening tools, making it easier for you to nurture and grow your garden. What sets GETHSEMANI apart is that we do more than just sell products; we share gardening knowledge and expertise through detailed articles and video guides. We believe that understanding and loving plants will help you create a lush, vibrant living space. It is our dedication and responsibility towards our customers that have forged the GETHSEMANI brand, making us your trusted partner on your gardening journey.</p>
            </div>
            <div class="col">
                <img src="https://dummyimage.com/600x400/000/fff888" class="we-are-img-43" alt="...">
            </div>

        </div>
    </div>

    <div class="mt-5">
        <h1 class="text-center p-2">DESIGN</h1>
        <div class="row row-cols-md-3 row-cols-sm-1 row-cols-1 g-3">
            <div class="col">
                <div class="d-flex flex-column gap-3 align-items-center justify-content-start">
                    <img src="https://dummyimage.com/600x400/000/fff888" class="we-are-img-43" alt="...">
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex flex-column gap-3">
                            <p class="lh-base">
                                <b>Inspiration Source</b>
                                Exploiting aspects revolving around gardening enthusiasts, GETHSEMANI seeks an iconic image strongly connected to their story.
                            </p>
                            <p class="lh-base">
                                <b>Sketch</b>
                                From initial sketches, our talented artisans embark on the handcrafting process of greenery and garden tools. Each product is created with passion and high skill, carrying the stories and life philosophy of GETHSEMANI.
                            </p>
                            <p class="lh-base">
                                <b>MANUFACTURING</b>
                                From initial sketches, our talented artisans embark on the handcrafting process of greenery and garden tools. Each product is created with passion and high skill, carrying the stories and life philosophy of GETHSEMANI.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column gap-3 align-items-center justify-content-start">
                    <img src="https://dummyimage.com/600x400/000/fff888" class="we-are-img-43" alt="...">
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex flex-column gap-3">
                            <p class="lh-base">
                                <b>Utilizing Modern Technology</b>
                                GETHSEMANI continuously invests in technology to enhance product quality. The design and production processes utilize advanced graphic software and modern machinery, ensuring the highest accuracy and perfection.
                            </p>
                            <p class="lh-base">
                                <b>Efficiency Optimization</b>
                                We always seek to optimize the production process to not only meet but also exceed our customers' expectations for uniqueness and aesthetic appeal.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column gap-3 align-items-center justify-content-start">
                    <img src="https://dummyimage.com/600x400/000/fff888" class="we-are-img-43" alt="...">
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex flex-column gap-3">
                            <p class="lh-base">
                                <b>Proud of Skills</b>
                                With a team of professional artisans, GETHSEMANI confidently brings the most quality and unique products. Each item is not just a piece of furniture but also an artistic masterpiece created from passion and love for the craft.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection