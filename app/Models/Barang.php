<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;

    protected $table = 'mst_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'harga_beli',
        'harga_jual',
        'stok_minim',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'harga_beli' => 'integer',
        'harga_jual' => 'integer',
        'stok_minim' => 'integer',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'kode_barang', 'kode_barang');
    }
}
