<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tbl_laporan_wisata', function (Blueprint $table) {
            $table->increments('id_laporan');
            $table->string('judul_laporan', 200);
            $table->longText('keterangan_laporan')->nullable();
            $table->string('foto_laporan', 255)->nullable();
            $table->enum('status_laporan', ['VALID', 'VOID'])->default('VALID');
            $table->integer('picu_laporan')->nullable();
            $table->dateTime('created_at_laporan')->nullable();
            $table->dateTime('updated_at_laporan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_laporan_wisata');
    }
};
