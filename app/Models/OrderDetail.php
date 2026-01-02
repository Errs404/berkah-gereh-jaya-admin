<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'dat_order_detail';

    protected $fillable = [
        'order_id',
        'kode_barang',
        'qty',
        'harga',
        'subtotal',
    ];

    /**
     * Relasi ke order (header)
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Relasi ke master barang
     */
    // public function barang()
    // {
    //     return $this->belongsTo(
    //         MstBarang::class,
    //         'kode_barang',
    //         'kode_barang'
    //     );
    // }
}
