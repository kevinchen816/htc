@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link"><i class="fa fa-step-backward"></i></span></li>
            <li class="page-item disabled"><span class="page-link"><i class="fa fa-chevron-left"></i></span></li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}" rel="prev"><i class="fa fa-step-backward"></i></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-chevron-left"></i></a>
            </li>
        @endif

        <li class="page-item disabled"><span class="page-link">{{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}</span></li>

        {{-- Pagination Elements --}}
@if (0)
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled">
                <span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
@endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-chevron-right"></i></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next"><i class="fa fa-step-forward"></i></a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link"><i class="fa fa-chevron-right"></i></span></li>
            <li class="page-item disabled"><span class="page-link"><i class="fa fa-step-forward"></i></span></li>
        @endif

    </ul>
@endif