document.addEventListener('alpine:init', () => {
  Alpine.data('orderTable', () => ({
    selectedOrders: [],
    searchQuery: '',
    statusFilter: '',
    dateFilter: '',
    init() {
      // init chart / load stats / dsb
    },
    toggleAll(checked) {
      // implement sesuai kebutuhan kamu (kalau data server-side, biasanya checkbox hanya untuk page ini)
    },
    filterOrders() {
      // kalau filtering mau server-side, sebaiknya pakai querystring dan reload (recommended)
    },
    bulkAction(status) {
      // TODO: call endpoint bulk update
    },
  }));

  Alpine.data('orderForm', () => ({
    // kalau modal masih dummy. kalau sudah server-side submit, ini bisa dihapus.
    form: { /* ... */ },
    saveOrder() { /* ... */ },
  }));
});

document.addEventListener('alpine:init', () => {
  Alpine.data('orderForm', (barangs) => ({
    barangs,
    rows: [{ kode_barang: '', qty: 1 }],

    addRow() {
      this.rows.push({ kode_barang: '', qty: 1 });
    },

    removeRow(index) {
      if (this.rows.length > 1) {
        this.rows.splice(index, 1);
      }
    },

    findHarga(kode) {
      const barang = this.barangs.find(b => b.kode_barang === kode);
      return barang ? Number(barang.harga_jual) : 0;
    },

    calcSubtotal(row) {
      return this.findHarga(row.kode_barang) * (Number(row.qty) || 0);
    },

    calcTotal() {
      return this.rows.reduce((sum, row) => sum + this.calcSubtotal(row), 0);
    },

    formatRupiah(value) {
      return 'Rp ' + (Number(value) || 0).toLocaleString('id-ID');
    },
  }));
});
