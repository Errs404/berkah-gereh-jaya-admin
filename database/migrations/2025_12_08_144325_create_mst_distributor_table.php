<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mst_distributor', function (Blueprint $table) {
            $table->id();
            $table->string('kode_distributor')->unique();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('pic')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mst_distributor');
    }
};
