<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_order_header', function (Blueprint $table) {
            $table->id('id_order_header');
            $table->string('resi_order_header', 50)->unique();
            $table->date('tanggal_order_header');
            $table->time('waktu_order_header');
            $table->string('nama_order_header', 100);
            $table->string('meja_order_header', 20);
            $table->enum('status_order_header', ['INPUT', 'VALID', 'FINISH', 'PAID', 'VOID'])->default('INPUT');
            $table->bigInteger('total_order_header')->default(0);
            $table->bigInteger('bayar_order_header')->default(0);
            $table->bigInteger('kembali_order_header')->default(0);
            $table->dateTime('created_order_header');
            $table->dateTime('updated_order_header')->useCurrent()->useCurrentOnUpdate();
            $table->integer('picc_order_header')->nullable();
            $table->integer('picu_order_header')->nullable();
        });

        Schema::create('tbl_order_detail', function (Blueprint $table) {
            $table->id('id_order_detail');
            $table->unsignedBigInteger('id_resi_order_detail');
            $table->string('resi_order_detail', 50);
            $table->unsignedBigInteger('id_makan_order_detail');
            $table->string('nama_makan_order_detail', 100);
            $table->integer('qty_order_detail');
            $table->bigInteger('harga_order_detail');
            $table->text('catatan_order_detail')->nullable();
            $table->enum('status_order_detail', ['INPUT', 'VALID', 'FINISH', 'VOID'])->default('INPUT');
            $table->dateTime('created_order_detail');
            $table->dateTime('updated_order_detail')->useCurrent()->useCurrentOnUpdate();
            $table->integer('picc_order_detail')->nullable();
            $table->integer('picu_order_detail')->nullable();
            $table->foreign('id_resi_order_detail')->references('id_order_header')->on('tbl_order_header');
            $table->foreign('id_makan_order_detail')->references('id_makan')->on('tbl_makan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_order_detail');
        Schema::dropIfExists('tbl_order_header');
    }
};
