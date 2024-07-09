<footer id="user-footer">
    <div class="row row-cols-lg-4 row-cols-md-2 row-cols-1 g-md-3 p-3 g-sm-4">
        <div class="col border-top-md-none ">
            <a class="logo-footer-wrapper d-flex justify-content-center align-items-center" href="{{ route('users.home') }}"><img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448893881_459061516980193_545509641477731501_n.png?stp=dst-png_s1080x2048&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_ohc=XH4-i-6TQPkQ7kNvgEua9Le&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QH-bwuaiULt2pcdwVngYaGJeZyAG1TCHhqCZydcanmUuA&oe=66AB9914" alt="GreenGroves"></a>
        </div>
        <div class="col">
            <div class="d-flex flex-column align-items-lg-start align-items-center gap-2 p-2">
                <h5>INFORMATION</h5>
                <ul class="d-flex flex-column align-items-start gap-3">
                    <li><a wire:navigate href="/about">ABOUT</a></li>
                    <li><a wire:navigate href="/contact">CONTACT</a></li>
                    <li><a wire:navigate href="/list-product">SHOP</a></li>
                </ul>
            </div>
        </div>
        <div class="col social-footer">
            <div class="d-flex flex-column align-items-lg-start align-items-center gap-2 p-2">
                <h5>SOCIAL MEDIA</h5>
                <ul class="d-flex flex-column align-items-start gap-3">
                    <li>
                        <a href="#" class="d-flex gap-2 align-items-center"><i class="fa-brands fa-square-facebook fa-xl" style="color: #3b5998;"></i>
                            FACEBOOK
                        </a>
                    </li>
                    <li>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <i class="fa-brands fa-square-x-twitter fa-xl" style="color: #333;"></i>
                            X TWITTER</a>
                    </li>
                    <li>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <i class="fa-brands fa-instagram fa-xl d-flex align-items-center" style="display: block; width: 1em; height: 1em; background-image: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); -webkit-background-clip: text; color: transparent;"></i>
                            INSTAGRAM
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col subcribe-footer">
            <div class="d-flex flex-column align-items-lg-start align-items-center gap-2 p-2">
                <h5>SUBCRIBE TO OUR LATEST INSIGHTS</h5>
                <form wire:submit="subcribe" class="position-relative">
                    <input wire:model="emailNotificationToSend" type="email" placeholder="Enter your email" autocomplete="off" required>
                    <button wire:loading.attr="disabled" type="submit" class="btn btn-submit-footer rounded-circle border d-flex justify-content-center align-items-center"><i class="fa-regular fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-md-start justify-content-sm-center align-items-center ps-5">
        <p>�� 2021 Gethemani. All rights reserved.</p>
    </div>
</footer>