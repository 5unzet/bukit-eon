<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    for($i=1;$i<=10;$i++){
        DB::table('tiket')->insert([
            'tanggal' => now()->addDays($i),
            'harga' => 25000,
            'kuota' => 100,
            'kuota_tersedia' => 100,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
}
