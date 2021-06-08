@if ($paginator->hasPages())
    <nav aria-label="Page navigation example" class="text-dark">
        <ul class="pagination justify-content-center text-dark">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item text-dark">
                    <a class="page-link text-dark rounded-circle" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Poprzednia</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled text-dark rounded-circle" aria-disabled="true"><span class="page-link rounded-circle">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active text-dark rounded-circle" aria-current="page"><span class="page-link text-dark rounded-circle">{{ $page }}</span></li>
                        @else
                            <li class="page-item text-dark rounded-circle"><a class="page-link text-dark rounded-circle" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link text-dark rounded-circle" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Następna</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
