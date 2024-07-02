<footer id="user-footer">
    <div class="row row-cols-lg-4 row-cols-md-2 row-cols-1 g-md-1 g-4 p-3 m-2">
        <div class="col border-top-md-none">
            <a class="logo-footer-wrapper"  href="{{ route('users.home') }}"><img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448805789_999139421656083_7224066356797885216_n.png?stp=dst-png_s526x296&_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeGPSu_lTZpGehTE4LVS7C5qynWPWG2wpj7KdY9YbbCmPjczmzBsIJn8Wj9RQofZUSt39Hh5Arle4n4y7QlkM93E&_nc_ohc=WAQB-2oPj-4Q7kNvgFuz4DE&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QGYAFLnodceFt7AjCFTQ_6El2loL7Xl95lAxFaO66rukA&oe=66AA55F3"  alt="GreenGroves"></a>
        </div>
        <div class="col">
            <div class="d-flex flex-column gap-3 p-2">
                <h3>INFORMATION</h3>
                <ul class="d-flex flex-column align-items-start gap-3">
                    <li><a wire:navigate href="/about"><span>ABOUT</span></a></li>
                    <li><a wire:navigate href="/contact"><span>CONTACT</span></a></li>
                    <li><a wire:navigate href="/list-product"><span>SHOP</span></a></li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="d-flex flex-column gap-3 p-2">
                <h3>SOCIAL MEDIA</h3>
                <ul class="d-flex flex-column align-items-start gap-3">
                    <li><a href="#" class="d-flex gap-2 align-items-center"><i class="fa-brands fa-facebook fa-2xl" style="color: #3b5998;"></i><span>FACEBOOK</span></a></li>
                    <li><a href="#" class="d-flex gap-2 align-items-center"><i class="fa-brands fa-twitter fa-2xl" style="color: #1da1f2;"></i><span>TWITTER</span></a></li>
                    <li>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <i class="fa-brands fa-instagram fa-2xl d-flex align-items-center" style="display: block; width: 1em; height: 1em; background-image: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); -webkit-background-clip: text; color: transparent;"></i>
                            <span>INSTAGRAM</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="d-flex flex-column gap-3 p-2">
                <h3>NEWSLETTER</h3>
                <form class="d-flex flex-lg-row flex-column gap-1">
                    <input type="email" class="form-control " placeholder="Enter your email">
                    <button type="submit" class="btn btn-light">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-md-start justify-content-sm-center align-items-center gap-3 p-3 mt-3">
        <p>�� 2021 Gethemani. All rights reserved.</p>
    </div>
</footer>