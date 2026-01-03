<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="{{ route('orders.store') }}" x-data="orderForm(@js($barangs))">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add New Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Kode Order</label>
              <input type="text" class="form-control" name="kode_order" value="{{ $kode_order }}" readonly>
            </div>

            <div class="col-md-6">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal_order" value="{{ now()->toDateString() }}" required>
            </div>

            <div class="col-md-6">
  <label class="form-label">Distributor</label>

  <input
    type="text"
    class="form-control"
    list="distributor-list"
    name="nama_distributor"
    placeholder="Cari distributor..."
    onchange="setDistributor(this.value)"
    required
  >

  <!-- hidden value untuk backend -->
  <input type="hidden" name="distributor_id" id="distributor_id">

  <datalist id="distributor-list">
    @foreach ($distributors as $d)
      <option
        value="{{ $d->nama }}"
        data-id="{{ $d->id }}"
      >
        {{ $d->pic }}
      </option>
    @endforeach
  </datalist>
</div>


            <div class="col-md-6">
              <label class="form-label">PIC Distributor</label>
              <input type="email" class="form-control" name="pic_distributor">
            </div>

            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select class="form-select" name="status" required>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>

            <div class="col-12">
              <hr class="my-2">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Detail Barang</h6>
                <button type="button" class="btn btn-sm btn-outline-primary" @click="addRow()">
                  <i class="bi bi-plus-lg me-1"></i>Tambah
                </button>
              </div>

              <template x-for="(row, i) in rows" :key="i">
                <div class="row g-2 align-items-end mb-2">
                  <div class="col-md-7">
                    <label class="form-label mb-1">Barang</label>
                    <select class="form-select" :name="`items[${i}][kode_barang]`" x-model="row.kode_barang" required>
                      <option value="">Pilih barang</option>
                      <template x-for="b in barangs" :key="b.kode_barang">
                        <option :value="b.kode_barang" x-text="`${b.kode_barang} — ${b.nama_barang}`"></option>
                      </template>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label mb-1">Qty</label>
                    <input type="number" min="1" class="form-control"
                      :name="`items[${i}][qty]`" x-model.number="row.qty" required>
                  </div>

                  <div class="col-md-2 d-flex gap-2">
                    <button type="button" class="btn btn-outline-danger w-100" @click="removeRow(i)" :disabled="rows.length === 1">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>

                  <div class="col-12">
                    <small class="text-muted">
                      Subtotal: <span x-text="formatRupiah(calcSubtotal(row))"></span>
                    </small>
                  </div>
                </div>
              </template>

              <div class="d-flex justify-content-end">
                <div class="fw-semibold">
                  Total: <span x-text="formatRupiah(calcTotal())"></span>
                </div>
              </div>

              {{-- total dikirim ke backend --}}
              <input type="hidden" name="total" :value="calcTotal()">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Order</button>
        </div>
      </form>
    </div>
  </div>
</div>
