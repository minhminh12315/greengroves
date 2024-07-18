@if ($paginator->hasPages())
    <nav>
        <ul class="d-flex pagination justify-content-between mt-3 mb-3">
            
            {{-- Number of Items of Total Items --}}
            <li class="number_items_page_length disabled">
                <span class="length">
                    Showing <span class="number_length">{{ $paginator->count() }}</span> Out Of <span class="number_length">{{ $paginator->total() }}</span>
                </span>
            </li>
            <div class="d-flex justify-content-around gap-4">
                
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="previous" aria-hidden="true">Previous</span>
                </li>
            @else
                <li>
                    <button type="button" class="previous" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">Previous</button>
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
                                <li class="active current-page paginate_active" aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li><button type="button" wire:click="gotoPage({{ $page }})" class="page-number">{{ $page }}</button></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button type="button" class="next" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">Next</button>
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
