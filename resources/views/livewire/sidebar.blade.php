<aside id="aside_setting_container">
    <div class="d-flex flex-column gap-2">
        <div class="d-flex justify-content-between align-items-center">
            <a class="setting-backhome" href="{{route('users.home')}}">
                <img height="auto" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448893881_459061516980193_545509641477731501_n.png?stp=dst-png_s1080x2048&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_ohc=XH4-i-6TQPkQ7kNvgEua9Le&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QH-bwuaiULt2pcdwVngYaGJeZyAG1TCHhqCZydcanmUuA&oe=66AB9914" alt="">
            </a>
            <button class="btn btn-close btn-close-asideSetting d-lg-none d-block"></button>
        </div>
        <ul class="d-flex flex-column aside-setting-list gap-3 pt-2 mt-2 ">
            <li wire:click="displayMainSettingContent">
                <a wire:navigate href="{{ route('setting_user') }}">
                    <span class="material-symbols-outlined ">
                        manage_accounts
                    </span>
                    <span>
                        Personal Infomation
                    </span>
                    <span class="material-symbols-outlined mt-1 d-lg-none d-block">
                        chevron_right
                    </span>
                </a>
            </li>
            <li wire:click="displayMainSettingContent">
                <a wire:navigate href="{{ route('reset_password') }}">
                    <span class="material-symbols-outlined ">
                        shield
                    </span>
                    <span>
                        Password and Security
                    </span>
                    <span class="material-symbols-outlined mt-1 d-lg-none d-block">
                        chevron_right
                    </span>
                </a>

            </li>
            <li wire:click="displayMainSettingContent">
                <a wire:navigate href="{{ route('list_order') }}">
                    <span class="material-symbols-outlined ">
                        orders
                    </span>
                    <span>
                        List of ordered products
                    </span>
                    <span class="material-symbols-outlined mt-1 d-lg-none d-block">
                        chevron_right
                    </span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<script>

</script>