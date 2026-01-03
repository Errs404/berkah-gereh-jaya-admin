document.addEventListener('alpine:init', () => {
  Alpine.data('orderTable', () => ({
    init() {},
    selectedOrders: [],
    toggleAll(checked) {
      // checkbox toggle (optional)
    },
  }));

  Alpine.data('orderForm', (barangs = []) => ({
    barangs,
    rows: [{ kode_barang: '', qty: 1 }],
    addRow() { this.rows.push({ kode_barang: '', qty: 1 }); },
    removeRow(i) { if (this.rows.length > 1) this.rows.splice(i, 1); },
    findHarga(kode) {
      const b = this.barangs.find(x => x.kode_barang === kode);
      return b ? Number(b.harga_jual) : 0;
    },
    calcSubtotal(row) { return this.findHarga(row.kode_barang) * (Number(row.qty) || 0); },
    calcTotal() { return this.rows.reduce((s, r) => s + this.calcSubtotal(r), 0); },
    formatRupiah(n) { return 'Rp ' + (Number(n) || 0).toLocaleString('id-ID'); },
  }));
});
