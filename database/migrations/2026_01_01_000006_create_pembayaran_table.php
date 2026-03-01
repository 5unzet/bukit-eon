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
                Schema::create('pembayaran', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('reservasi_id');
    $table->string('bukti_transfer')->nullable();
    $table->enum('status',['pending','valid','invalid'])->default('pending');

    $table->timestamps();

    $table->foreign('reservasi_id')
          ->references('id')
          ->on('reservasi')
          ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
