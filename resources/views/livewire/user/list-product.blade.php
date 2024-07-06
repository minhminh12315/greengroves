@extends('livewire.user.index')
@section('content')
<section id="listProductPage">
    <div class="container">
        <!-- cai cua Minh -->
        <div class="row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-2 row-cols-1 g-5">
            @foreach ($products as $p)
            <div class="card mouse">
                <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title ">Card title</h5>
                    <div class="row">
                        <div class="col-6 textItems ">
                            <div class="price text-md-center">
                                <span>22.99$</span>
                            </div>
                        </div>
                        <div class="col-6 textItems mt-1">
                            <div class="wasSell">
                                Đã bán 13,8k
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @endforeach

        </div>
        <!-- cai cua Minh -->
        <!-- <div class="row row-cols-xl-6">
            <div class="col d-flex justify-content-end">
                <div class="row listProducts">

                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">


                    </div>
                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">
                        <div class="card mouse">
                            <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">Card title</h5>
                                <div class="row">
                                    <div class="col-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>22.99$</span>
                                        </div>
                                    </div>
                                    <div class="col-6 textItems mt-1">
                                        <div class="wasSell">
                                            Đã bán 13,8k
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">
                        <div class="card mouse">
                            <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">Card title</h5>
                                <div class="row">
                                    <div class="col-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>22.99$</span>
                                        </div>
                                    </div>
                                    <div class="col-6 textItems mt-1">
                                        <div class="wasSell">
                                            Đã bán 13,8k
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">
                        <div class="card mouse">
                            <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">Card title</h5>
                                <div class="row">
                                    <div class="col-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>22.99$</span>
                                        </div>
                                    </div>
                                    <div class="col-6 textItems mt-1">
                                        <div class="wasSell">
                                            Đã bán 13,8k
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">
                        <div class="card mouse">
                            <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">Card title</h5>
                                <div class="row">
                                    <div class="col-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>22.99$</span>
                                        </div>
                                    </div>
                                    <div class="col-6 textItems mt-1">
                                        <div class="wasSell">
                                            Đã bán 13,8k
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">
                        <div class="card mouse">
                            <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">Card title</h5>
                                <div class="row">
                                    <div class="col-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>22.99$</span>
                                        </div>
                                    </div>
                                    <div class="col-6 textItems mt-1">
                                        <div class="wasSell">
                                            Đã bán 13,8k
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">
                        <div class="card mouse">
                            <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">Card title</h5>
                                <div class="row">
                                    <div class="col-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>22.99$</span>
                                        </div>
                                    </div>
                                    <div class="col-6 textItems mt-1">
                                        <div class="wasSell">
                                            Đã bán 13,8k
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">
                        <div class="card mouse">
                            <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">Card title</h5>
                                <div class="row">
                                    <div class="col-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>22.99$</span>
                                        </div>
                                    </div>
                                    <div class="col-6 textItems mt-1">
                                        <div class="wasSell">
                                            Đã bán 13,8k
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-xl-auto col-md-4 col-xl-3 mt-3">
                        <div class="card mouse">
                            <img src="https://dummyimage.com/200x200/000/fff888" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">Card title</h5>
                                <div class="row">
                                    <div class="col-6 textItems ">
                                        <div class="price text-md-center">
                                            <span>22.99$</span>
                                        </div>
                                    </div>
                                    <div class="col-6 textItems mt-1">
                                        <div class="wasSell">
                                            Đã bán 13,8k
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> -->
    </div>

</section>
@endsection