@if ($paginator->hasPages())
    <nav class="btn-actions-pane-right" aria-label="Page navigation example">
        <ul class="pagination mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li> --}}
                <li class="page-item disabled">
                    <a href="" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">«</span><span class="sr-only">Previous</span>
                    </a>
                </li>
            @else
                {{-- <li class="page-item">
                    <a class="page-link p-items-green" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li> --}}
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">«</span><span class="sr-only">Previous</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    {{-- <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li> --}}
                    <li class="page-item">
                        <a href="" class="page-link">{{ $element }}</a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li> --}}
                            <li class="page-item active">
                                <a href="" class="page-link">{{ $page }}</a>
                            </li>
                        @else
                            {{-- <li class="page-item">
                                <a class="page-link p-items-green" href="{{ $url }}">{{ $page }}</a>
                            </li> --}}
                            <li class="page-item">
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">»</span><span class="sr-only">Next</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="" aria-label="Next">
                        <span aria-hidden="true">»</span><span class="sr-only">Next</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif