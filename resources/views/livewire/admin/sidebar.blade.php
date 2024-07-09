<aside class="border-end">
    <div class="d-flex flex-column gap-4 p-4">
        <a href="{{route('admin.index')}}">
            <img width="auto" height="30vh" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/448893881_459061516980193_545509641477731501_n.png?stp=dst-png_s1080x2048&_nc_cat=103&ccb=1-7&_nc_sid=0024fc&_nc_ohc=XH4-i-6TQPkQ7kNvgEua9Le&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QH-bwuaiULt2pcdwVngYaGJeZyAG1TCHhqCZydcanmUuA&oe=66AB9914" alt="">
        </a>
        <ul class="d-flex flex-column gap-3 aside-admin-list border-top pt-3">
            <li class="">
                <a wire:navigate href="/admin/addnew">
                    <span class="material-symbols-outlined">
                        add_box
                    </span>

                    ADD NEW
                </a>
            </li>
            <li class="">
                <a wire:navigate href="/admin/list_product">
                    <span class="material-symbols-outlined">
                        deployed_code
                    </span>
                    LIST PRODUCT
                </a>
            </li>
            <li class="">
                <a wire:navigate href="/admin/list_category">
                    <span class="material-symbols-outlined">
                        category
                    </span>
                    LIST CATEGORY
                </a>
            </li>
            <li class="">
                <a wire:navigate href="/admin/order">
                    <span class="material-symbols-outlined">
                        orders
                    </span>
                    LIST ORDER
                </a>
            </li>
            <li class="">
                <a wire:navigate href="/admin/list_image">
                    <span class="material-symbols-outlined">
                        imagesmode
                    </span>
                    LIST IMAGE
                </a>
            </li>
            <li class="">
                <a wire:navigate href="/admin/news">
                    <span class="material-symbols-outlined">
                        news
                    </span>
                    NEWS
                </a>
            </li>
        </ul>
    </div>
</aside>