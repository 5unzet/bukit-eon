<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_makan', function (Blueprint $table) {
            $table->id('id_makan');
            $table->string('nama_makan');
            $table->integer('harga_makan');
            $table->text('deskripsi_makan')->nullable();
            $table->string('gambar_makan')->nullable();
            $table->string('ketersediaan_makan')->default('OPEN');
            $table->string('status_makan')->default('VALID');
            $table->unsignedBigInteger('picu_makan')->nullable();
            $table->timestamp('created_at_makan')->nullable();
            $table->timestamp('updated_at_makan')->nullable();
            $table->foreign('picu_makan')->references('id_user')->on('tbl_user')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_makan');
    }
};
