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
        Schema::create('mst_nama_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();     // contoh: BRG001
            $table->string('nama_barang');               // nama item
            $table->string('satuan')->nullable();        // Kg, Pcs, Bungkus, dll.
            $table->integer('harga_beli')->default(0);   // modal
            $table->integer('harga_jual')->default(0);   // harga jual
            $table->integer('stok_minimum')->default(0); // untuk notifikasi stok menipis
            $table->boolean('is_active')->default(true); // masih dijual atau tidak
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_nama_barang');
    }
};
