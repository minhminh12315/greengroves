@extends('livewire.user.index')
@section('content')
<section id="ContactPage">
    <div class="containerContact">
        <div class="row title">
            <div class="col-12 ">
                <h2 class="text-center p-4">CONTACT US IF U WANNA MAKE UR DREAM HOUSE</h2>
            </div>
        </div>
        <div class="row detalsContainer ">
            <div class="col-12 col-md-6 ">
                <div class="row">
                    <div class="col-12 m-3 fontSize">
                        <div class="d-flex justify-content-center align-content-center justify-content-md-start align-content-md-center" >Phone Number: +123 456 7890</div>
                   </div>
                   <div class="col-12 m-3 fontSize">
                    <div class="d-flex justify-content-center align-content-center justify-content-md-start align-content-md-center">Address : 123 Street, City, Country</div>
                </div>
                <div class="col-12 m-3 fontSize">
                    <div class="d-flex justify-content-center align-content-center justify-content-md-start align-content-md-center">Email : +123 456 7890</div>
               </div>
            </div>

            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 m-3">
                        <div class="d-flex justify-content-center align-content-center fontSize">NHẬN THÔNG BÁO KHI CÓ CẬP NHẬT MỚI:</div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-success ">Nhận nội dung mới</button>
                    </div>
                    <div class="col-12 m-3">
                        <form action="">

                            <div class="m-3">
                                <label for="name" class="form-label">NHẬP EMAIL CỦA BẠN:</label>
                                <input type="text" class="form-control" placeholder="PLEASE SIGN IN FOR MAIL US" id="name" required>
                            </div>
                            <div class="m-3">
                                <label for="name" class="form-label">PHẢN ÁNH VỚI CHÚNG TÔI</label>
                                <input type="text" class="form-control" placeholder="Your Feedback" id="name" required>
                            </div>

                            <div class="m-3 d-flex justify-content-center align-content-center">
                                <button type="submit" class="btn btn-success">Gửi</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="mapContainer">
        <div class="mapDisplay">
            <div class="wrapper-container p-3">
                <div class="wrapper-item">
                        <div class="row justify-content-center">
                            <!--The div element for the map -->
                            <div class="mapouter">
                                <div class="gmap_canvas"><iframe class="mapGoogle" id="gmap_canvas"
                                        src="https://maps.google.com/maps?ll=21.037811,105.809581&q=285 Đội Cấn&t=&z=14&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                            </div>

                        </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
