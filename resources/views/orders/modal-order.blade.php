<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add New Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST"
            action="{{ route('orders.store') }}"
            x-data="orderForm(@js($barangs))">
        @csrf

        <div class="modal-body">
          <div class="row g-3">

            {{-- Kode Order (AUTO) --}}
            <div class="col-md-6">
              <label class="form-label">Kode Order</label>
              <input type="text"
                     class="form-control"
                     value="Auto generated (setelah disimpan)"
                     disabled>
              <small class="text-muted">
                Format: ORD-YYYYMMDD-0001 (reset tiap hari)
              </small>
            </div>

            {{-- Order Date --}}
            <div class="col-md-6">
              <label class="form-label">Order Date</label>
              <input type="date"
                     class="form-control"
                     name="order_date"
                     value="{{ now()->toDateString() }}"
                     required>
            </div>

            {{-- Customer Name --}}
            <div class="col-md-6">
              <label class="form-label">Customer Name</label>
              <input type="text"
                     class="form-control"
                     name="nama_customer"
                     required>
            </div>

            {{-- Customer Email --}}
            <div class="col-md-6">
              <label class="form-label">Customer Email <small class="text-muted">(optional)</small></label>
              <input type="email"
                     class="form-control"
                     name="email_customer">
            </div>

            {{-- Status --}}
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select class="form-select"
                      name="status"
                      required>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>

            {{-- Items --}}
            <div class="col-12">
              <label class="form-label d-flex justify-content-between align-items-center">
                <span>Order Items</span>
                <button type="button"
                        class="btn btn-sm btn-outline-primary"
                        @click="addRow">
                  <i class="bi bi-plus"></i> Add Item
                </button>
              </label>

              <!-- Item Rows -->
              <template x-for="(row, index) in rows" :key="index">
                <div class="row g-2 align-items-end mb-2">

                  {{-- Barang --}}
                  <div class="col-md-7">
                    <label class="form-label small mb-1">Barang</label>
                    <select class="form-select"
                            :name="`items[${index}][kode_barang]`"
                            x-model="row.kode_barang"
                            required>
                      <option value="">-- Pilih Barang --</option>
                      <template x-for="b in barangs" :key="b.kode_barang">
                        <option :value="b.kode_barang"
                                x-text="`${b.kode_barang} - ${b.nama_barang}`">
                        </option>
                      </template>
                    </select>
                  </div>

                  {{-- Qty --}}
                  <div class="col-md-2">
                    <label class="form-label small mb-1">Qty</label>
                    <input type="number"
                           min="1"
                           class="form-control"
                           :name="`items[${index}][qty]`"
                           x-model.number="row.qty"
                           required>
                  </div>

                  {{-- Subtotal --}}
                  <div class="col-md-2">
                    <label class="form-label small mb-1">Subtotal</label>
                    <input type="text"
                           class="form-control"
                           :value="formatRupiah(calcSubtotal(row))"
                           disabled>
                  </div>

                  {{-- Remove --}}
                  <div class="col-md-1 d-grid">
                    <button type="button"
                            class="btn btn-outline-danger"
                            @click="removeRow(index)"
                            :disabled="rows.length === 1">
                      <i class="bi bi-x"></i>
                    </button>
                  </div>

                </div>
              </template>

              {{-- Total Estimation --}}
              <div class="text-end mt-2">
                <small class="text-muted">Total Estimasi:</small>
                <span class="fw-semibold"
                      x-text="formatRupiah(calcTotal())"></span>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal">
            Cancel
          </button>
          <button type="submit"
                  class="btn btn-primary">
            Save Order
          </button>
        </div>

      </form>

    </div>
  </div>
</div>
