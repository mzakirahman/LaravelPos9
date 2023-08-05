<?php

// database/migrations/2023_07_19_120000_create_konfirmasis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfirmasisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('konfirmasis', function (Blueprint $table) {
            $table->id();
            $table->text('pesan');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('wartawan_id');
            $table->date('tanggal');
            $table->time('jam');
            $table->timestamps();

            // Definisi kunci asing untuk menghubungkan kolom admin_id dengan tabel users
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');

            // Definisi kunci asing untuk menghubungkan kolom wartawan_id dengan tabel users
            $table->foreign('wartawan_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfirmasis');
    }
}
