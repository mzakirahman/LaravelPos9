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
        Schema::create('infotorials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wartawan_id');
            $table->string('nama_media');
            $table->string('jenis_media');
            $table->string('jenis_pesanan');
            $table->string('jumlah_pesanan');
            $table->string('satuan');
            $table->string('harga');
            $table->decimal('pajak', 5, 2)->default(0); // Tambahkan kolom pajak
            $table->string('total_transfer');
            $table->string('jumlah');
            $table->date('bulan'); //Kolom untuk menyimpan bulan dan tahun

            $table->string('lampiran')->nullable();
            $table->timestamps();

            $table->foreign('wartawan_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infotorials');
    }
};
