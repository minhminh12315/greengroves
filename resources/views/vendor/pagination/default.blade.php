@if ($paginator->hasPages())
    <nav>
        <ul class="d-flex flex-wrap pagination justify-content-between">
            
            {{-- Number of Items of Total Items --}}
            <li class="number_items_page_length disabled">
                <span class="length">
                    Showing <span class="number_length">{{ $paginator->count() }}</span> Out Of <span class="number_length">{{ $paginator->total() }}</span>
                </span>
            </li>
            <div>
                {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="previous" aria-hidden="true">Previous</span>
                </li>
            @else
                <li>
                    <a class="previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active current-page" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="next" aria-hidden="true">Next</span>
                </li>
            @endif
            </div>
        </ul>
    </nav>
@endif
