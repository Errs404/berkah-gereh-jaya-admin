<div class="table-responsive">
  <table class="table table-hover mb-0">
    <thead class="table-light">
      <tr>
        <th style="width: 40px;">
          <input type="checkbox" class="form-check-input" @change="toggleAll($event.target.checked)">
        </th>
        <th>Order #</th>
        <th>Distributor</th>
        <th>Items</th>
        <th>Count</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th style="width: 120px;">Actions</th>
      </tr>
    </thead>

    <tbody>
      @forelse($orders as $order)
        @php
          $firstDetail = $order->details->first();
          $firstItemName = optional(optional($firstDetail)->barang)->nama_barang;
          $moreCount = max(($order->detail_lines ?? 0) - 1, 0);
          $qtyTotal = (int) ($order->item_qty_total ?? 0);
          $status = strtolower($order->status ?? 'pending');
        @endphp

        <tr>
          <td>
            <input type="checkbox" class="form-check-input" value="{{ $order->id }}" x-model="selectedOrders">
          </td>

          <td>
            <div class="fw-medium">{{ $order->kode_order }}</div>
            <small class="text-muted">ID: {{ $order->id }}</small>
          </td>

          <td>
            <div class="order-distributor d-flex align-items-center gap-2">
              <img
                src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_distributor) }}&background=2d3748&color=fff"
                alt="{{ $order->nama_distributor }}"
                style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
              <div>
                <div class="fw-medium">{{ $order->nama_distributor }}</div>
                <small class="text-muted">{{ $order->pic_distributor }}</small>
              </div>
            </div>
          </td>

          <td>
            <div class="order-items">
              <div>{{ $order->detail_lines }} item{{ $order->detail_lines > 1 ? 's' : '' }}</div>
              <small class="text-muted">
                {{ $firstItemName ?? '-' }}
                @if($moreCount > 0) +{{ $moreCount }} more @endif
              </small>
            </div>
          </td>

          <td><span class="badge bg-secondary">{{ $qtyTotal }}</span></td>

          <td class="fw-medium">Rp {{ number_format((float)$order->total, 0, ',', '.') }}</td>

          <td>
            <span class="order-status
              {{ $status === 'pending' ? 'status-pending' : '' }}
              {{ $status === 'processing' ? 'status-processing' : '' }}
              {{ $status === 'shipped' ? 'status-shipped' : '' }}
              {{ $status === 'delivered' ? 'status-delivered' : '' }}
              {{ $status === 'cancelled' ? 'status-cancelled' : '' }}">
              {{ ucfirst($status) }}
            </span>
          </td>

          <td>{{ optional($order->created_at)->format('Y-m-d') }}</td>

          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots"></i>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="{{ route('orders.show', $order) }}">
                    <i class="bi bi-eye me-2"></i>View Details
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('orders.destroy', $order) }}">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item text-danger" type="submit"
                      onclick="return confirm('Yakin hapus order ini?')">
                      <i class="bi bi-x-circle me-2"></i>Delete
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="9" class="text-center text-muted py-4">Belum ada order.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
