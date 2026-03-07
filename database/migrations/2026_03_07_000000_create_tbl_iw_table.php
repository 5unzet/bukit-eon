<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tbl_iw', function (Blueprint $table) {
            $table->increments('id_iw');
            $table->string('judul_iw', 100);
            $table->text('deskripsi_iw')->nullable();
            $table->time('buka_iw')->nullable();
            $table->time('tutup_iw')->nullable();
            $table->integer('tiket_iw')->nullable();
            $table->string('foto_iw', 255)->nullable();
            $table->enum('status_iw', ['VALID', 'VOID'])->default('VALID');
            $table->integer('picu_iw')->nullable();
            $table->dateTime('created_at_iw')->nullable();
            $table->dateTime('updated_at_iw')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('tbl_iw');
    }
};
