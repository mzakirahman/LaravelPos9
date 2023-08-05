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
        Schema::create('rekapans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_media');
            $table->string('jenis_media');
            $table->string('jenis_pesanan');
            $table->string('jumlah_pesanan');
            $table->string('harga');
            $table->string('satuan');
            $table->string('total_transfer');
            $table->string('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapans');
    }
};
