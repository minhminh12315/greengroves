<header id="header">
    <div class="navbar navbar-expand-lg flex-column p-0">
        <div class="container pt-2 pb-2">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="material-symbols-outlined fs-1">
                        menu
                    </span>
                </div>
                <a class="navbar-brand" href="{{ route('users.home') }}"><img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448893881_459061516980193_545509641477731501_n.png?stp=dst-png_s1080x2048&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_ohc=XH4-i-6TQPkQ7kNvgEua9Le&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QH-bwuaiULt2pcdwVngYaGJeZyAG1TCHhqCZydcanmUuA&oe=66AB9914" width="auto" height="40vh" alt="GreenGroves"></a>
                <div class="d-flex flex-row justify-content-center align-items-center gap-3 flex-grow-0">
                    <div class="inp-search-container">
                        <form role="search" class="d-flex justify-content-center">
                            @csrf
                            <span class="material-symbols-outlined search-icon">
                                search
                            </span>
                            <input wire:model.live.debounce.100ms="search" type="search" name="search" placeholder="Search for products...">
                        </form>
                        @if ($search)
                        <ul class="search_result_container">
                            @if (count($results) > 0)

                            @foreach($results as $item)
                            <li class="result_search_item">
                                <a href="{{ route('user.product-detail', $item -> id) }}">
                                    <div class="d-flex flex-row gap-2">
                                        <img width="50" height="50" src="{{ Storage::url($item->productImages->first()->path) }}" alt="">
                                        {{ $item->name }}
                                    </div>
                                    <div>
                                        <b>${{ $item->productVariants->min('price') }}</b>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            @else
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                                <p>Product Not Found !</p>
                            </div>
                            @endif
                        </ul>
                        @endif
                    </div>

                    <div class="login-container-user">
                        @auth
                        <i class="fa-regular fa-user btn-user"></i>
                        <div class="loggedInUser">
                            <div class="w-100 d-flex flex-column align-items-start gap-4 justify-content-center">
                                <div class="user-info-demo">
                                    <div class="user-img">
                                        @if(Auth::user()->avatar)
                                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="img-fluid" alt="{{Auth::user()->name}}">
                                        @else
                                        <img src="https://scontent.fhan17-1.fna.fbcdn.net/v/t1.30497-1/143086968_2856368904622192_1959732218791162458_n.png?stp=cp0_dst-png_p40x40&_nc_cat=1&ccb=1-7&_nc_sid=136b72&_nc_ohc=Xy7AjkPZPq4Q7kNvgGjaJQ_&_nc_ht=scontent.fhan17-1.fna&oh=00_AYA7OIwIVuPvbsa-4EW9hzy1CsM4rHHQaw1wN59wBy3Vtw&oe=66B07778" alt="">
                                        @endif
                                    </div>
                                    <div>
                                        @if(Auth::user()->fullname)
                                        <span>{{ Auth::user()->fullname }}</span>
                                        @else
                                        <span>{{ Auth::user()->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <button wire:click="setting_user" class="loggedInUser-item change-info ">
                                    <div class="info-icon">
                                        <i class="fa-solid fa-gear text-light"></i>
                                    </div>
                                    <span>PROFILE</span>
                                </button>
                                <button wire:click="logout" class="loggedInUser-item .btn-signOut">
                                    <div class="signOutIcon">
                                        <i class="fa-solid fa-right-from-bracket text-light"></i>
                                    </div>
                                    <span>SIGN OUT</span>
                                </button>
                            </div>
                        </div>
                        @endauth
                        @guest
                        <div class="login-user-item">
                            <a href="{{route('login')}}">
                                LOGIN
                            </a>
                        </div>
                        @endguest
                    </div>
                    <div class="d-lg-none">
                        <div class="backdrop-search" wire:click="resetSearchInput" wire:ignore></div>
                        <i class="fa-solid fa-magnifying-glass btn_search_mobile"></i>
                        <div class="search_toggle_mobile d-lg-none" wire:ignore.self>
                            <div class="w-100 p-2">
                                <button class="btn btn-close btn-closeSearchMobile d-flex ms-auto" wire:click="resetSearchInput"></button>
                            </div>
                            <input wire:model.live.debounce.100ms="search" class="search_mobile_input" type="text" name="search_mobile" placeholder="Search for products...">
                            @if ($search)
                            <ul class="search_result_mobile_container">
                                @if (count($results) > 0)
                                @foreach($results as $item)
                                <li class="result_search_mobile_item">
                                    <a href="{{ route('user.product-detail', $item -> id) }}">
                                        <div class="d-flex flex-row gap-2">
                                            <img width="50" height="50" src="{{ Storage::url($item->productImages->first()->path) }}" alt="">
                                            {{ $item->name }}
                                        </div>
                                        <div>
                                            <b>${{ $item->productVariants->min('price') }}</b>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                                @else
                                <div class="w-100 h-100 d-flex justify-content-center align-items-center">

                                    <p>Product Not Found !</p>
                                </div>
                                @endif

                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="cart-container d-none d-sm-block">
                        <div class="position-relative">
                            <a href="{{ route('user.cartShop')}}">
                                <img class="mb-lg-2 mb-1" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448770774_673202385003930_1883056276195293896_n.png?stp=dst-png_p206x206&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeG0M7Lkn1sUT6wfnmXCjKjKLe3moqlwcw8t7eaiqXBzD-uY45ONHkscJ3xceUwgjS8w-nXZopUzS-8xk6pFGgxB&_nc_ohc=nk9PxJjvkdkQ7kNvgFFY-6a&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QGVGAcFJGBKrTupVPXZqOi9RPSKd67PODE9ZF9kDuEI2g&oe=66AA403B" alt="">
                                <div class="cart-count-wrapper">
                                    <div class="cart-count">
                                        {{$this->cartCount}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas offcanvas-start d-block" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav align-items-lg-center gap-5 justify-content-lg-center align-items-sm-start justify-content-sm-center align-items-start justify-content-center w-100 nav-home ">
                    <div class="menu-header d-flex flex-row gap-2 align-items-center justify-content-center">
                        <button class="btn-toggle-menu">
                            <i class="fa-solid fa-bars mb-1 ms-1"></i>
                            MENU
                        </button>
                        <div class="w-100 h-100 menu-lg-screen">
                            MENU
                            <i class="fa-solid menu-header-icon fa-arrow-down fa-sm"></i>
                        </div>
                        <div class="menu-collapse-header">
                            <div class="close-seeAll-container">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <button class="btn-close-menu">
                                        <span class="material-symbols-outlined">
                                            close
                                        </span>
                                    </button>
                                    <div class="d-flex justify-content-center align-items-center gap-2 seeAllMenu">
                                        <span class="material-symbols-outlined">
                                            view_list
                                        </span>
                                        <a href="" class="seeAllMenu">See all products</a>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-category-item-wrapper">
                                @foreach ($categories as $cate)
                                <div class="menu-category-item">
                                    <div class="d-flex flex-row align-items-center justify-content-start">
                                        <a wire:navigate href="{{route('user.list-product-category', $cate -> id)}}" class="mb-1">{{ $cate->name }}</a>
                                        @if ($cate->children->isNotEmpty())
                                        <span class="material-symbols-outlined arrow-right">
                                            arrow_right
                                        </span>
                                        @endif
                                    </div>
                                    @if ($cate->children->isNotEmpty())
                                    @livewire('user.sub-category',['parentCategoryId' => $cate->id], key($cate->id))
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <li>
                        <a class="d-flex align-items-center justify-content-center gap-2" wire:navigate href="{{route('users.home')}}">
                            <span class="material-symbols-outlined ">
                                house
                            </span>
                            HOME
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center justify-content-center gap-2" wire:navigate href="{{route('user.list-product')}}">
                            <span class="material-symbols-outlined ">
                                package_2
                            </span>
                            SHOP
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center justify-content-center gap-2" wire:navigate href="{{route('users.about')}}">
                            <span class="material-symbols-outlined ">
                                groups
                            </span>
                            ABOUT US
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center justify-content-center gap-2" wire:navigate href="{{route('users.contact')}}">
                            <span class="material-symbols-outlined ">
                                contact_page
                            </span>
                            CONTACT US
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
