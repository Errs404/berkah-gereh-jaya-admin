document.addEventListener("DOMContentLoaded", () => {
    // contoh: inject recent orders dummy
    const tbody = document.getElementById("recent-orders-table");
    if (tbody) {
        tbody.innerHTML = `
      <tr>
        <td>ORD-20260104-0001</td>
        <td>Squeezy Orange</td>
        <td>Rp 120.000</td>
        <td><span class="badge bg-warning">Pending</span></td>
        <td>2026-01-04</td>
      </tr>
    `;
    }

    // init chart jika kamu sudah punya inisialisasi (Chart.js / vendor)
});
