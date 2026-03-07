<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tbl_cust', function (Blueprint $table) {
            $table->increments('id_cust');
            $table->string('email_cust', 255)->nullable();
            $table->string('pass_cust', 255)->nullable();
            $table->string('nama_cust', 255)->nullable();
            $table->string('no_hp_cust', 20)->unique();
            $table->enum('status_cust', ['VALID', 'VOID'])->default('VALID');
            $table->dateTime('created_cust')->nullable();
            $table->integer('picc_cust')->nullable();
            $table->dateTime('updated_cust')->nullable();
            $table->integer('picu_cust')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('tbl_cust');
    }
};
