@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center space-y-6 py-4">
        {{-- Showing Text --}}
        <div class="text-center">
            <p class="text-sm text-gray-700 leading-6 font-medium">
                {!! __('Showing') !!}
                <span class="font-bold">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-bold">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="font-bold">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        {{-- Pagination Controls --}}
        <div class="relative z-0 inline-flex shadow-sm rounded-md space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="btn btn-disabled" aria-hidden="true">&lt;</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-primary" aria-label="@lang('pagination.previous')">&lt;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="btn btn-disabled">{{ $element }}</span>
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span class="btn btn-active">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $url }}" class="btn btn-primary" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-primary" aria-label="@lang('pagination.next')">&gt;</a>
            @else
                <span aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="btn btn-disabled" aria-hidden="true">&gt;</span>
                </span>
            @endif
        </div>
    </nav>
@endif
