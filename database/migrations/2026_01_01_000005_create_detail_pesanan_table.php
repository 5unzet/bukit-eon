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
                Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pesanan_id');
            $table->unsignedBigInteger('makanan_id');

            $table->integer('jumlah');
            $table->integer('subtotal');

            $table->timestamps();

            $table->foreign('pesanan_id')
                ->references('id')
                ->on('pesanan_makanan')
                ->onDelete('cascade');

            $table->foreign('makanan_id')
                ->references('id')
                ->on('makanan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
