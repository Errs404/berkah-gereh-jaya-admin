<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'dat_order';

    protected $fillable = [
        'kode_order',
        'nama_customer',
        'email_customer',
        'status',
        'total',
    ];

    /**
     * Relasi ke detail order
     */
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
