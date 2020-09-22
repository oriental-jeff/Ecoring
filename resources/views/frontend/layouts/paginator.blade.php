@if ($paginator->hasPages())
  <nav aria-label="Page navigation example" class="py-3">
    <ul class="pagination justify-content-md-center">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true">
          <a class="page-link" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      @else
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      @endif
      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}

        @if (is_string($element))
          <li class="page-item disabled" aria-disabled="true"><a class="page-link">{{ $element }}</a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($paginator->currentPage() > 3 && $page === 2)
              <li class="page-item disabled"><a class="page-link">...</a></li>
            @endif
            @if ($page == $paginator->currentPage())
              <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
            @elseif ($page === $paginator->currentPage() + 1 ||  $page === $paginator->currentPage() - 1 ||  $page === $paginator->lastPage() || $page === 1)
              <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @if ($paginator->currentPage() < $paginator->lastPage() - 2 && $page === $paginator->lastPage() - 1)
              <li class="page-item disabled"><a class="page-link">...</a></li>
            @endif
          @endforeach
        @endif
      @endforeach
      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      @else
        <li class="page-item disabled" aria-disabled="true">
          <a class="page-link" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      @endif
    </ul>
  </nav>
@endif
