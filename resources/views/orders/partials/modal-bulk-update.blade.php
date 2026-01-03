<div class="modal fade" id="bulkUpdateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('orders.bulkUpdate') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Bulk Update Orders</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Status Baru</label>
            <select class="form-select" name="status" required>
              <option value="">Pilih status</option>
              <option value="processing">Processing</option>
              <option value="shipped">Shipped</option>
              <option value="delivered">Delivered</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>

          {{-- list id dari Alpine --}}
          <input type="hidden" name="ids" :value="selectedOrders.join(',')">
          <small class="text-muted">Akan mengubah status untuk order yang kamu centang.</small>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
