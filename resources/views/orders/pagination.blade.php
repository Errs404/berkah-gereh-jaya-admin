<div class="d-flex justify-content-between align-items-center p-3">
  <div class="text-muted">
    Showing <span class="fw-medium">{{ $orders->firstItem() ?? 0 }}</span>
    to <span class="fw-medium">{{ $orders->lastItem() ?? 0 }}</span>
    of <span class="fw-medium">{{ $orders->total() }}</span> results
  </div>

  <nav>
    <ul class="pagination pagination-sm mb-0">
      <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $orders->previousPageUrl() ?? '#' }}">Previous</a>
      </li>

      @for ($page = 1; $page <= $orders->lastPage(); $page++)
        <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
          <a class="page-link" href="{{ $orders->url($page) }}">{{ $page }}</a>
        </li>
      @endfor

      <li class="page-item {{ $orders->hasMorePages() ? '' : 'disabled' }}">
        <a class="page-link" href="{{ $orders->nextPageUrl() ?? '#' }}">Next</a>
      </li>
    </ul>
  </nav>
</div>
