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
        Schema::create('tiket', function (Blueprint $table) {
    $table->id();
    // Relasi ke Pengguna
    $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
    $table->string('kodeTiket');
    $table->date('tanggalKunjungan');
    $table->integer('jumlah');
    $table->float('totalHarga');
    $table->enum('status', ['pending', 'dibayar', 'dikirim']);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};
