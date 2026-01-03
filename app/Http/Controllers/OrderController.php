<?php

namespace App\Http\Controllers;

use App\Models\DatOrder;
use App\Models\MstBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MstDistributor;

class OrderController extends Controller
{
    public function index()
    {
        // 1) orders
        $orders = DatOrder::query()
            ->with(['details.barang'])
            ->withCount('details as detail_lines')
            ->latest('created_at')
            ->paginate(10);

        // 2) barang untuk dropdown item di modal
        $barangs = MstBarang::query()
            ->select('kode_barang', 'nama_barang', 'harga_jual')
            ->orderBy('nama_barang')
            ->get();

        // 3) distributor untuk searchable dropdown distributor
        $distributors = MstDistributor::query()
            ->select('id', 'nama', 'pic') // sesuai kolom kamu
            ->orderBy('nama')
            ->get();

        // 4) generate kode order (sementara dulu)
        $kode_order = 'ORD-' . now()->format('Ymd') . '-0001';

        // 5) return view paling bawah
        return view('orders.index', compact(
            'orders',
            'barangs',
            'kode_order',
            'distributors'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'distributor_id' => 'required|exists:mst_distributor,id',
            // field lain…
        ]);

        $distributor = MstDistributor::findOrFail($request->distributor_id);

        $order = DatOrder::create([
            'kode_order'      => $request->kode_order,
            'distributor_id'  => $distributor->id,
            'nama_distributor'   => $distributor->nama,
            'pic_distributor'  => $distributor->pic,
            'status'          => $request->status,
            'total'           => $request->total,
        ]);

        // validasi minimal
        $data = $request->validate([
            'kode_order'     => 'required|string',
            'nama_distributor'  => 'required|string',
            'items'          => 'required|array',
            'items.*.kode_barang' => 'required|string',
            'items.*.qty'    => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($data) {
            $order = \App\Models\DatOrder::create([
                'kode_order'    => $data['kode_order'],
                'nama_distributor' => $data['nama_distributor'],
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
