<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['details.barang'])
            // total item = SUM(qty)
            ->withSum('details as item_qty_total', 'qty')
            // jumlah baris detail = count row detail
            ->withCount('details as detail_lines')
            ->latest('created_at')
            ->paginate(10);

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }
}
