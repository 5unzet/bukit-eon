<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
    \App\Models\Pengguna::factory(10)->create();
    \App\Models\Makanan::factory(10)->create();
    \App\Models\Tiket::factory(10)->create();
    \App\Models\PesananMakanan::factory(5)->create();
    \App\Models\Pembayaran::factory(5)->create();
    \App\Models\Laporan::factory(5)->create();
}
    
}
