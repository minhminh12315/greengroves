<header id="header">
    <div class="navbar navbar-expand-lg flex-column p-0">
        <div class="container p-3">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="material-symbols-outlined fs-1">
                        menu
                    </span>
                </div>
                <a class="navbar-brand" href="{{ route('users.home') }}"><img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448893881_459061516980193_545509641477731501_n.png?stp=dst-png_s1080x2048&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_ohc=XH4-i-6TQPkQ7kNvgEua9Le&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QH-bwuaiULt2pcdwVngYaGJeZyAG1TCHhqCZydcanmUuA&oe=66AB9914" width="auto" height="40vh" alt="GreenGroves"></a>
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
        <div class="offcanvas offcanvas-start d-block" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav align-items-lg-center gap-5 justify-content-lg-center align-items-sm-start justify-content-sm-center vw-100 nav-home ">
                    <div class="menu-header d-flex flex-row gap-2 align-items-center justify-content-center" wire:mouseleave="clearMenu">
                        MENU
                        <i class="fa-solid menu-header-icon fa-arrow-down fa-sm"></i>
                        <div class="menu-collapse-header">
                            <div class="w-100 h-100 row">
                                <div class="category-menu-header col-2">
                                    <ul class="d-flex flex-column gap-5">
                                        <li>{{count($subcategories)}}</li>
                                        @foreach ($categories as $category)
                                        <li wire:click="selectCategory({{ $category->id }}, 0)" class="{{ isset($selectedCategories[0]) && $selectedCategories[0] == $category->id ? 'active' : '' }}">
                                            {{ $category->name }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-10 subcategory-menu-header">
                                    @foreach ($subcategories as $level => $subs)
                                    <ul class="d-flex justify-content-start align-items-center flex-wrap gap-4" >
                                        @foreach ($subs as $subcategory)
                                        <li wire:click="selectCategory({{ $subcategory->id }}, {{ $level + 1 }})" class="subcategory-item {{ isset($selectedCategories[$level + 1]) && $selectedCategories[$level + 1] == $subcategory->id ? 'active' : '' }}" style="cursor: pointer;">
                                            {{ $subcategory->name }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <li>
                        <a wire:navigate href="{{route('user.list-product')}}">
                            SHOP
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="{{route('users.about')}}">
                            ABOUT US
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="{{route('users.contact')}}">
                            CONTACT US
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

</header>