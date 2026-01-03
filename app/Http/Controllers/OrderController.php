<?php

namespace App\Http\Controllers;

use App\Models\DatOrder;
use App\Models\MstBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DatOrder::query()
            ->with(['details.barang'])
            ->withCount('details as detail_lines')
            ->latest('created_at')
            ->paginate(10);

        $barangs = MstBarang::query()
            ->select('kode_barang', 'nama_barang', 'harga_jual')
            ->orderBy('nama_barang')
            ->get();

        $kode_order = 'ORD-' . now()->format('Ymd') . '-0001';

        return view('orders.index', compact('orders', 'barangs', 'kode_order'));
    }

    public function store(Request $request)
    {
        // validasi minimal
        $data = $request->validate([
            'kode_order'     => 'required|string',
            'nama_customer'  => 'required|string',
            'items'          => 'required|array',
            'items.*.kode_barang' => 'required|string',
            'items.*.qty'    => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($data) {
            $order = \App\Models\DatOrder::create([
                'kode_order'    => $data['kode_order'],
                'nama_customer' => $data['nama_customer'],
                'status'        => 'pending',
                'total'         => 0, // nanti dihitung
            ]);

            $total = 0;

            foreach ($data['items'] as $row) {
                $barang = \App\Models\MstBarang::where('kode_barang', $row['kode_barang'])->firstOrFail();

                $subtotal = $barang->harga_jual * $row['qty'];
                $total += $subtotal;

                $order->details()->create([
                    'kode_barang' => $barang->kode_barang,
                    'qty'         => $row['qty'],
                    'harga'       => $barang->harga_jual,
                    'subtotal'    => $subtotal,
                ]);
            }

            $order->update(['total' => $total]);
        });

        return redirect()
            ->route('orders')
            ->with('success', 'Order berhasil disimpan');
    }


    public function bulkUpdate(Request $request)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'order_ids' => 'required|array',
            'order_ids.*' => 'integer',
        ]);

        DatOrder::whereIn('id', $data['order_ids'])
            ->update([
                'status' => $data['status'],
            ]);

        return redirect()
            ->route('orders')
            ->with('success', 'Status order berhasil diperbarui');
    }
}
