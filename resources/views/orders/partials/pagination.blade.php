<div class="d-flex justify-content-between align-items-center p-3">
  <div class="text-muted">
    Showing <span class="fw-medium">{{ $orders->firstItem() ?? 0 }}</span>
    to <span class="fw-medium">{{ $orders->lastItem() ?? 0 }}</span>
    of <span class="fw-medium">{{ $orders->total() }}</span> results
  </div>

  <div>
    {{ $orders->withQueryString()->links() }}
  </div>
</div>
