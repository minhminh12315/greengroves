@extends('livewire.user.index')
@section('content')
    <div id="AboutPage">
        <div class="pt-3" id="section_1">
            <div class="aboutUsContainer ">

                <div class="row p-3">
                    <div class="col-12">
                        <h5 class="text-center">Chúng tôi là
                            Gethsemani!</h5>
                    </div>
                    <div class="col-12">
                        <div class="text-center">Chúng tôi có sứ mệnh mang
                            đến những tiện ích</div>
                    </div>
                    <div class="col-12">
                        <div class="text-center">
                            cho người đam mê làm vườn
                        </div>
                    </div>
                </div>
                <div class="row p-3" id="imgAboutUsContainer">
                    <div class="col-1 hidden"></div>

                    <div class="col-xl-2 col-4 col-md-4 d-flex justify-content-center align-items-center">
                        <div class="card imgBorder" style="width: 13rem;">
                            <img src="{{ asset('storage/' . $section_1[0]) }}" class="card-img-section-1" alt="...">
                        </div>
                    </div>

                    <div class="col-xl-2  d-flex justify-content-center align-items-center d-none d-xl-block">
                        <div class="card imgBorder" style="width: 13rem;">
                            <img src="{{ asset('storage/' . $section_1[1]) }}" class="card-img-section-1" alt="...">
                        </div>
                    </div>

                    <div class="col-xl-2 d-flex justify-content-center align-items-center d-none d-xl-block">
                        <div class="card imgBorder" style="width: 13rem;">
                            <img src="{{ asset('storage/' . $section_1[2]) }}" class="card-img-section-1" alt="...">
                        </div>
                    </div>

                    <div class="col-xl-2 col-4 col-md-4 d-flex justify-content-center align-items-center ">
                        <div class="card imgBorder" style="width: 13rem;">
                            <img src="{{ asset('storage/' . $section_1[3]) }}" class="card-img-section-1" alt="...">
                        </div>
                    </div>

                    <div class="col-xl-2 col-4 col-md-4 d-flex justify-content-center align-items-center">
                        <div class="card imgBorder" style="width: 13rem;">
                            <img src="{{ asset('storage/' . $section_1[4]) }}" class="card-img-section-1" alt="...">
                        </div>
                    </div>

                    <div class="col-1 hidden"></div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="text-center">Thiết kế độc nhất, Mỗi nhà
                            là một kiệt tác, tận tâm từng chi tiết nhỏ trong
                            khu vườn nhà bạn</div>
                    </div>
                    <div class="col-12 m-3">
                        <div class="text-center">Let accessories be the
                            final highlight for your House!</div>
                    </div>
                </div>

            </div>
        </div>
        <div id="section_2">
            <div class="p-4" class="section_2">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-12 mt-3 d-flex justify-content-md-end align-items-center justify-content-center">
                        <div class="card imgBorder" style="width: 20rem;">
                            <img src="{{ asset('storage/' . $section_2[0]) }}" class="card-img-section-2" alt="...">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mt-3 d-flex justify-content-md-center align-items-md-center justify-content-center">
                        <div class="card imgBorder" style="width: 20rem;">
                            <img src="{{ asset('storage/' . $section_2[1]) }}" class="card-img-section-2" alt="...">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mt-3 d-flex justify-content-md-start   align-items-md-center justify-content-center">
                        <div class="card imgBorder" style="width: 20rem;">
                            <img src="{{ asset('storage/' . $section_2[2]) }}" class="card-img-section-2" alt="...">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="section_3" id="section_3">
            <div class="row p-3">
                <div class="col-12">
                    <h3 class="text-center">GETHSEMANI - CHÚNG TÔI LÀ
                        AI?</h3>
                </div>
                <div class="col-12">
                    <div class="row p-3">
                        <div class="col-md-6 col-12 mt-md-3 d-flex justify-content-center align-items-center">
                            <div class="card imgBorder" style="width:45rem;height: 25rem;">
                                <img src="{{ asset('storage/' . $section_3[0]) }}" class="card-img-section-3" alt="...">
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mt-3">
                            <div class="row detailsSection_3">
                                <div class="col-12 p-1 text" style="text-indent: 2em;">
                                    Gethsemani là một cộng đồng đam mê làm vườn và phát triển không gian xanh quy mô nhỏ. Từ
                                    những khu vườn trên ban công đến những vườn hoa trong sân sau, Gethsemani luôn nỗ lực mang
                                    đến những kiến thức, tài nguyên và cảm hứng để biến mọi không gian thành những ốc đảo xanh
                                    mát. Chúng tôi tập trung vào việc cung cấp những thông tin hữu ích và sáng tạo để giúp bạn
                                    tận dụng tối đa không gian xanh của mình, dù lớn hay nhỏ
                                </div>
                                <div class="col-12 p-1 text" style="text-indent: 2em;">
                                    <strong>Sáng tạo! Đam mê! Bền vững! </strong>
                                </div>

                                <div class="col-12 p-1 text" style="text-indent: 2em;">
                                    Lấy cảm hứng từ những câu chuyện về cuộc sống gần gũi với thiên nhiên, chúng tôi tạo nên các
                                    bài viết, video hướng dẫn và diễn đàn cộng đồng đầy bổ ích và ý nghĩa. Gethsemani không chỉ
                                    là nơi bạn tìm kiếm thông tin mà còn là nơi bạn có thể chia sẻ kinh nghiệm, kết nối với
                                    những người có cùng đam mê và học hỏi từ nhau.
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="row p-3">
                <div class="col-12">
                    <h3 class="text-center">ĐIỀU GÌ TẠO NÊN GETHSEMANI?</h3>
                </div>
                <div class="col-12">
                    <div class="row p-3">
                        <div class="col-md-6 col-12 mt-3">
                            <div class="row detailsSection_3">
                                <div class="col-12 p-1 text" style="text-indent: 2em;">
                                    <strong>Chill</strong>
                                </div>
                                <div class="col-12 p-1 text">
                                    Mang trong mình niềm đam mê với làm vườn, Gethsemani không ngừng lắng nghe và hoàn thiện
                                    mình qua từng ngày, từ đó đem tới cho khách hàng những kiến thức, dịch vụ và trải nghiệm làm
                                    vườn chuẩn cam kết. Chúng tôi tập trung vào việc cung cấp thông tin hữu ích, dễ hiểu, giúp
                                    mọi người có thể tự tin bắt đầu hoặc phát triển không gian xanh của mình.
                                </div>
                                <div class="col-12 p-1 text" style="text-indent: 2em;">
                                    <strong>Relax</strong>
                                </div>

                                <div class="col-12 p-1 text">
                                    Khác so với nhiều nền tảng khác, chúng tôi lấy cảm hứng từ mọi khía cạnh trong cuộc sống,
                                    kết hợp chúng với tư duy sáng tạo và bền vững để tạo nên những nội dung và dịch vụ độc đáo,
                                    mang phong cách thân thiện và gần gũi. Gethsemani không chỉ cung cấp kiến thức về làm vườn
                                    mà còn tạo ra một cộng đồng nơi mọi người có thể chia sẻ, học hỏi và kết nối với nhau.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mt-3 d-flex justify-content-center align-items-center">
                            <div class="card imgBorder" style="width:45rem;height: 25rem;">
                                <img src="{{ asset('storage/' . $section_3[1]) }}" class="card-img-section-3_5 " alt="...">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="section_4" id="section_4">
            <h1 class="text-center p-5">DESIGN</h1>
        </div>
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mt-3 d-flex justify-content-center align-items-start">
                            <div class="card borderAbout" style="width: 20rem;">
                                <img  src="{{ asset('storage/' . $section_4[0]) }}" alt="..."
                                class="card-img-section-4">
                            </div>
                        </div>
                        <div class="row p-3 detailsContainer d-flex justify-content-center">
                            <div class="col-12 firstText">
                                <h4>BACONY</h4>
                            </div>
                            <div class="col-12 detailsDesign firstText">
                                <div class="row">
                                    <div class="col-12">
                                        <div>NGUỒN CẢM HỨNG</div>
                                    </div>
                                    <div class="col-12">
                                        Trong sứ mệnh của Gethsemani, chúng tôi tìm kiếm cảm hứng từ không gian ban công
                                        trong khu vườn để tạo ra những sản phẩm độc đáo và mang tính biểu tượng.
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12">
                                        <div>PHÁC THẢO</div>
                                    </div>
                                    <div class="col-12">
                                        Bắt đầu từ những ý tưởng cốt lõi, đội ngũ thiết kế của Gethsemani phác thảo các hình
                                        ảnh đầu tiên trên bản vẽ giấy. Đường nét phác họa phải chính xác và thể hiện rõ ràng
                                        tinh thần và dấu ấn đặc trưng chỉ có của Gethsemani.
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12">
                                        <div>MÔ HÌNH 3D</div>
                                    </div>
                                    <div class="col-12">
                                        Từ bản phác thảo ban đầu, chúng tôi chuyển sang mô hình 3D với sự hỗ trợ mạnh mẽ từ
                                        phần mềm đồ họa. Mỗi mô hình 3D được in bằng phôi sáp và vật liệu lỏng, đáp ứng mọi
                                        yêu cầu nghiêm ngặt của sản xuất và đúc kim loại.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mt-3 d-flex justify-content-center align-items-start">
                            <div class="card borderAbout" style="width: 20rem;">
                                <img src="{{ asset('storage/' . $section_4[1]) }}" alt="..."
                                class="card-img-section-4">
                            </div>
                        </div>
                        <div class="row p-3 detailsContainer centerText">
                            <div class="col-12">
                                <h4>GARDEN</h4>
                            </div>
                            <div class="col-12 detailsDesign">
                                <div class="row">
                                    <div class="col-12">
                                        <div>NGUỒN CẢM HỨNG</div>
                                    </div>
                                    <div class="col-12">
                                        Với tư cách là người đi đầu trong lĩnh vực làm vườn, Gethsemani lấy cảm hứng từ sự
                                        đa dạng của các loại vườn, từ những khu vườn sân sau nhỏ đến các khu vườn rộng lớn,
                                        để tạo ra những sản phẩm mang tính biểu tượng và phù hợp với mọi không gian xanh.
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12">
                                        <div>PHÁC THẢO</div>
                                    </div>
                                    <div class="col-12">
                                        Bắt đầu từ các ý tưởng cơ bản, đội ngũ thiết kế của Gethsemani phác thảo các bản vẽ
                                        sơ bộ trên giấy. Mỗi đường nét cần được điều chỉnh một cách tỉ mỉ để phản ánh chính
                                        xác tinh thần và sự độc đáo của từng sản phẩm.
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12">
                                        <div>MÔ HÌNH 3D</div>
                                    </div>
                                    <div class="col-12">
                                        Từ các phác thảo ban đầu, chúng tôi chuyển sang mô hình 3D, sử dụng công nghệ đồ họa
                                        tiên tiến để tạo ra các mẫu thử nghiệm. Các mô hình này sau đó được in 3D với vật
                                        liệu chuyên dụng, đảm bảo chất lượng và tính thẩm mỹ của từng sản phẩm Gethsemani.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mt-3 d-flex justify-content-center align-items-start">
                            <div class="card borderAbout" style="width: 20rem;">
                                <img src="{{ asset('storage/' . $section_4[2]) }}" alt="..."
                                class="card-img-section-4">
                            </div>
                        </div>
                        <div class="row p-3 detailsContainer d-flex justify-content-center">
                            <div class="col-12 endText">
                                <h4>ROOFTOP</h4>
                            </div>
                            <div class="col-12 detailsDesign endText">
                                <div class="row">
                                    <div class="col-12">
                                        <div>NGUỒN CẢM HỨNG</div>
                                    </div>
                                    <div class="col-12">
                                        Gethsemani lấy cảm hứng từ những không gian sân thượng, nơi mà việc tận dụng mỗi mét
                                        vuông đất để tạo ra những không gian xanh là một thử thách đầy sáng tạo và độc đáo.
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12">
                                        <div>PHÁC THẢO</div>
                                    </div>
                                    <div class="col-12">
                                        Với mỗi ý tưởng mới, đội ngũ thiết kế của Gethsemani bắt đầu vẽ các phác thảo sơ bộ
                                        trên giấy. Mỗi chi tiết được cân nhắc kỹ lưỡng để đảm bảo rằng tinh thần và tính
                                        chất đặc biệt của từng sản phẩm được thể hiện một cách chân thực và tinh tế.
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12">
                                        <div>MÔ HÌNH 3D</div>
                                    </div>
                                    <div class="col-12">
                                        Từ các bản vẽ phác thảo ban đầu, chúng tôi chuyển sang mô hình 3D bằng cách sử dụng
                                        công nghệ đồ họa tiên tiến. Mỗi mô hình được tạo ra với các phôi 3D và vật liệu
                                        lỏng, mang đến sự chính xác và tinh tế cho từng chi tiết thiết kế của Gethsemani.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


