<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatOrderDetail extends Model
{
    protected $table = 'dat_order_detail';

    public function barang()
    {
        return $this->belongsTo(MstBarang::class, 'kode_barang', 'kode_barang');
    }
}
