@if ($paginator->hasPages())
        <div class="container" style="text-align: center;">
             @if ($paginator->onFirstPage())
        <span class="paginate-btn">@lang('pagination.previous')</span>
        @else
        <a class="paginate-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a class="paginate-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
        @else
        <span class="paginate-btn">@lang('pagination.next')</span>
        @endif
        </div>
        {{-- Previous Page Link --}}
       

@endif
