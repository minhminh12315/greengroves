<ul class="subCategories">
    @foreach ($subCategories as $subCate )
    <li class="submenu-category-item">
        <div class="d-flex flex-row align-items-center justify-content-start">
            <a href="" class="mb-1">{{$subCate -> name}}</a>
            @if ($subCate->children->isNotEmpty())
            <span class="material-symbols-outlined arrow-right">
                arrow_right
            </span>
            @endif
        </div>
        @if($subCate->children->isNotEmpty())
        @livewire('user.sub-category',['parentCategoryId' => $subCate->id], key($subCate->id))
        @endif
    </li>
    @endforeach
</ul>