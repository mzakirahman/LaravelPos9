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
        Schema::create('penyerahans', function (Blueprint $table) {
            $table->id();
            $table->string('judul_surat');
            $table->string('link');
            $table->date('tanggal');
            $table->unsignedBigInteger('wartawan_id');
            $table->string('lampiran')->nullable();
            $table->timestamps();

            $table->foreign('wartawan_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyerahans');
    }
};
