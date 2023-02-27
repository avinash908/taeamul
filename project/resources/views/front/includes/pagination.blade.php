<div class="woocommerce-pagination">
<ul class="page-numbers">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <li><a><i class="fa fa-angle-left"></i></a></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}" class="prev page-numbers" rel="prev"></a></li>
    @endif

    <!-- Pagination Elements -->
    @foreach ($elements as $element)
        <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <li><a>{{ $element }}</a></li>
        @endif

        <!-- Array Of Links -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li><span class="active page-numbers current">{{ $page }}</span></li>
                @else
                    <li><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" class="next page-numbers" rel="next"><i class="fa fa-angle-right"></i></a></li>
    @else
        <li><a class="next page-numbers"><i class="fa fa-angle-right"></i></a></li>
    @endif
</ul>
</div>