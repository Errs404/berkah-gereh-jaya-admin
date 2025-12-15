<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dat_stock', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang'); // relasi ke mst_nama_barang.kode_barang

            $table->integer('stok_masuk')->default(0);   // stok masuk
            $table->integer('stok_keluar')->default(0);  // stok keluar
            $table->integer('stok_saldo')->default(0);   // stok setelah update

            $table->string('ref_type')->nullable();      // pembelian, retur, opname dll
            $table->string('ref_id')->nullable();        // id referensi transaksi
            $table->string('keterangan')->nullable();    // catatan bebas
            
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dat_stock');
    }
};
