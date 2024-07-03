<header id="header">
    <div class="navbar navbar-expand-lg flex-column p-0">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="material-symbols-outlined fs-1">
                        menu
                    </span>
                </div>
                <a class="navbar-brand" href="{{ route('users.home') }}"><img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448805789_999139421656083_7224066356797885216_n.png?stp=dst-png_s526x296&_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeGPSu_lTZpGehTE4LVS7C5qynWPWG2wpj7KdY9YbbCmPjczmzBsIJn8Wj9RQofZUSt39Hh5Arle4n4y7QlkM93E&_nc_ohc=WAQB-2oPj-4Q7kNvgFuz4DE&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QGYAFLnodceFt7AjCFTQ_6El2loL7Xl95lAxFaO66rukA&oe=66AA55F3" width="auto" height="60vh" alt="GreenGroves"></a>
                <div class="d-flex flex-row justify-content-center align-items-center gap-3">
                    <div class="inp-search-container">
                        <form action="" class="d-flex justify-content-center">
                            @csrf
                            <span class="material-symbols-outlined search-icon">
                                search
                            </span>
                            <input type="text" name="search" placeholder="Search for products...">
                        </form>
                    </div>
                    <div class="login-container-user">
                        @guest
                        <a href="{{route('login')}}">
                            LOGIN
                        </a>
                        @endguest
                    </div>
                    <div class="cart-container">
                        <div class="position-relative">
                            <img class="mb-2" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448770774_673202385003930_1883056276195293896_n.png?stp=dst-png_p206x206&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeG0M7Lkn1sUT6wfnmXCjKjKLe3moqlwcw8t7eaiqXBzD-uY45ONHkscJ3xceUwgjS8w-nXZopUzS-8xk6pFGgxB&_nc_ohc=nk9PxJjvkdkQ7kNvgFFY-6a&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QGVGAcFJGBKrTupVPXZqOi9RPSKd67PODE9ZF9kDuEI2g&oe=66AA403B" alt="">
                            <div class="cart-count-wrapper">
                                <div class="cart-count">
                                    0
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="inp-search-mobile">
            <form action="" class="d-flex justify-content-center">
                @csrf
                <span class="material-symbols-outlined search-icon">
                    search
                </span>
                <input type="text" name="search" placeholder="Search for products...">
            </form>
        </div>
        <div class="offcanvas offcanvas-start d-block " tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav align-items-md-center gap-5 justify-content-end align-items-sm-start">
                    <li class="menu-header">
                        MENU
                    </li>
                    <li>
                        <a wire:navigate href="{{route('user.list-product')}}">
                            SHOP
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="{{route('users.about')}}">
                            ABOUT
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="{{route('users.contact')}}">
                            SHOP
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>