<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatOrder extends Model
{
    protected $table = 'dat_order';
    // kalau PK kamu bukan "id", set juga protected $primaryKey = '...';

    public function details()
    {
        // SESUAIKAN foreign key di dat_order_detail
        return $this->hasMany(DatOrderDetail::class, 'order_id');
    }
}
