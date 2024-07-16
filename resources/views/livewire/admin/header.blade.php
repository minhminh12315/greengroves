<header id="admin-header" class="sticky-top p-lg-4 p-2 border-bottom">
    <div class="backdrops"></div>
    <button type="button" class="btn-collapse-haederAdmin d-lg-none d-block">
        <span class="material-symbols-outlined">
            menu
        </span>
    </button>
    <a href="{{route('admin.list_product')}}" class="d-lg-none d-block">
        <img width="auto" height="30vh" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448893881_459061516980193_545509641477731501_n.png?stp=dst-png_s1080x2048&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_ohc=XH4-i-6TQPkQ7kNvgEua9Le&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QH-bwuaiULt2pcdwVngYaGJeZyAG1TCHhqCZydcanmUuA&oe=66AB9914" alt="">
    </a>
    <div class=" d-none d-lg-block opacity-75">
        manage your website here
    </div>
    <div class="d-flex flex-row justify-content-center align-items-center gap-1 admin-acc-collapse">
        <img src="https://scontent.fhan17-1.fna.fbcdn.net/v/t1.30497-1/143086968_2856368904622192_1959732218791162458_n.png?stp=cp0_dst-png_p40x40&_nc_cat=1&ccb=1-7&_nc_sid=136b72&_nc_ohc=Xy7AjkPZPq4Q7kNvgGjaJQ_&_nc_ht=scontent.fhan17-1.fna&oh=00_AYA7OIwIVuPvbsa-4EW9hzy1CsM4rHHQaw1wN59wBy3Vtw&oe=66B07778" alt="">
        <div class="d-flex flex-column justify-content-center align-items- ms-1 d-lg-block d-none">
            <h6>{{ Auth()->user()->name }}</h6>
            <small class="p-0 m-0 opacity-75">{{ Auth()->user()->role }}</small>
        </div>
        <span class="material-symbols-outlined d-lg-block d-none">
            keyboard_arrow_down
        </span>
        <div class="loggedInAdmin">
            <div class="w-100 d-flex flex-column align-items-start gap-4 justify-content-center">
                <div class="admin-info-demo d-lg-none">
                    <div class="d-flex flex-column gap-1">
                        <p>{{ Auth()->user()->name }}</p>
                        <p class="opacity-75">{{ Auth()->user()->role }}</p>
                    </div>
                </div>
                <button wire:click="setting_user" class="loggedInAdmin-item change-info ">
                    <div class="info-icon">
                        <i class="fa-solid fa-gear text-light"></i>
                    </div>
                    <span>PROFILE</span>
                </button>
                <button wire:click.stop="logout" class="loggedInAdmin-item .btn-logOut">
                    <div class="logOutIcon">
                        <i class="fa-solid fa-right-from-bracket text-light"></i>
                    </div>
                    <span>LOG OUT</span>
                </button>
            </div>
        </div>
    </div>
</header>
<script>
    $(document).ready(function() {
        $('.btn-collapse-haederAdmin').click(function() {
            $('#aside-collapse-admin').toggleClass('show');
            $('.backdrops').toggleClass('active');
        });

        $('.backdrops').click(function() {
            $('#aside-collapse-admin').removeClass('show');
            $('.backdrops').removeClass('active');
        });

        $('.btn-close-aside').click(function() {
            $('#aside-collapse-admin').removeClass('show');
            $('.backdrops').removeClass('active');
        });
        $('.admin-acc-collapse').click(function() {
            $('.loggedInAdmin').toggleClass('show');
        });
       
    });
</script>