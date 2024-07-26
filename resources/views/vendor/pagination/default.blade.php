@if ($paginator->hasPages())
<nav>
    <ul class="d-flex flex-lg-row flex-column gap-3 pagination justify-content-between mt-3 mb-3">

        {{-- Number of Items of Total Items --}}
        <li class="number_items_page_length disabled">
            <span class="length">
                Showing <span class="number_length">{{ $paginator->count() }}</span> Out Of <span class="number_length">{{ $paginator->total() }}</span>
            </span>
        </li>
        <div class="d-flex justify-content-around gap-4">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="disabled btn_paginate_previous" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <button class="previous" aria-hidden="true">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </li>
            @else
            <li class="btn_paginate_previous">
                <button type="button" class="previous" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="disabled " aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="active current-page paginate_active" aria-current="page"><button>{{ $page }}</button></li>
            @else
            <li class="paginate_inactive"><button type="button" wire:click="gotoPage({{ $page }})" class="page-number">{{ $page }}</button></li>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="btn_paginate_next">
                <button type="button" class="next" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </li>
            @else
            <li class="disabled btn_paginate_next" aria-disabled="true" aria-label="@lang('pagination.next')">
                <button class="next" aria-hidden="true">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </li>
            @endif
        </div>
    </ul>
</nav>
@endif