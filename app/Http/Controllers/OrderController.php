<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tampilkan list order
     */
    public function index()
    {
        $orders = Order::with(['details.barang'])
            ->latest()
            ->get()
            ->map(function ($o) {
                return [
                    'id' => $o->id,
                    'orderNumber' => $o->kode_order,
                    'customer' => [
                        'name' => $o->nama_customer,
                        'email' => $o->email_customer,
                        'avatar' =>
                            'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' .
                            urlencode($o->nama_customer)
                    ],
                    'items' => $o->details->map(fn ($d) => [
                        'name' => $d->barang->nama_barang,
                        'qty' => $d->qty,
                        'price' => $d->harga
                    ])->values(),
                    'itemCount' => $o->details->sum('qty'),
                    'total' => number_format($o->total, 2),
                    'status' => $o->status,
                    'orderDate' => $o->created_at->format('Y-m-d')
                ];
            });

        return view('orders.orders', compact('orders'));
    }

    /**
     * Detail 1 order (optional)
     */
    public function show($id)
    {
        $order = Order::with(['details.barang'])->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Cancel order (optional)
     */
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'cancelled']);

        // TODO: stok balik (kalau mau)
        return back()->with('success', 'Order berhasil dibatalkan');
    }
}
