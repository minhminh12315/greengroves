<div>
    <div class="d-flex flex-column gap-2 p-4 ">
    <a href="{{route('users.home')}}" class="d-none d-lg-block">
            <img width="100%" height="auto" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448893881_459061516980193_545509641477731501_n.png?stp=dst-png_s1080x2048&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_ohc=XH4-i-6TQPkQ7kNvgEua9Le&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QH-bwuaiULt2pcdwVngYaGJeZyAG1TCHhqCZydcanmUuA&oe=66AB9914" alt="">
        </a>
        <ul class="d-flex flex-column gap-3 aside-admin-list pt-2 mt-2 ">
            <li class="">
                <a wire:navigate href="{{ route('setting_user') }}">
                    <span class="material-symbols-outlined">
                        add_box
                    </span>
                    Setting Account
                </a>
                <a wire:navigate href="{{ route('reset_password') }}">
                    <span class="material-symbols-outlined">
                        add_box
                    </span>
                    Reset Password
                </a>
                <a wire:navigate href="{{ route('list_order') }}">
                    <span class="material-symbols-outlined">
                        add_box
                    </span>
                    List Order
                </a>
            </li>
        </ul>
    </div>
</div>