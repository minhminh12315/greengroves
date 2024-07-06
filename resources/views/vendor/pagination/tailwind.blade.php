@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="pagination-disabled">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <button type="button" wire:click="previousPage" wire:loading.attr="disabled" class="pagination-button">
                    {!! __('pagination.previous') !!}
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage" wire:loading.attr="disabled" class="pagination-button">
                    {!! __('pagination.next') !!}
                </button>
            @else
                <span class="pagination-disabled">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="pagination-info">
                    {!! __('Showing') !!}
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="pagination-links">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span class="pagination-disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span aria-hidden="true">&laquo;</span>
                        </span>
                    @else
                        <button type="button" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="pagination-button" aria-label="{{ __('pagination.previous') }}">
                            &laquo;
                        </button>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span class="pagination-dots">{{ $element }}</span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="pagination-active" aria-current="page">{{ $page }}</span>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }})" class="pagination-button">{{ $page }}</button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="pagination-button" aria-label="{{ __('pagination.next') }}">
                            &raquo;
                        </button>
                    @else
                        <span class="pagination-disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span aria-hidden="true">&raquo;</span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
