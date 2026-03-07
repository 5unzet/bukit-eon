<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tbl_tiket', function (Blueprint $table) {
            $table->increments('id_tiket');
            $table->date('tanggal_tiket');
            $table->integer('id_user_tiket')->nullable();
            $table->integer('id_iw_tiket')->nullable();
            $table->string('resi_tiket', 50)->unique();
            $table->bigInteger('harga_tiket')->nullable();
            $table->integer('qty_tiket')->nullable();
            $table->bigInteger('total_tiket')->nullable();
            $table->enum('status_tiket', ['VALID', 'VOID', 'PAID'])->default('VALID');
            $table->dateTime('created_tiket')->nullable();
            $table->integer('picc_tiket')->nullable();
            $table->dateTime('updated_tiket')->nullable();
            $table->integer('picu_tiket')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('tbl_tiket');
    }
};
