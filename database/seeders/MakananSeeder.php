<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $data = [
        ['nama'=>'Nasi Goreng','harga'=>20000],
        ['nama'=>'Mie Goreng','harga'=>18000],
        ['nama'=>'Kopi Hitam','harga'=>10000],
        ['nama'=>'Teh Manis','harga'=>8000],
    ];

    foreach($data as $d){
        DB::table('makanan')->insert([
            'nama'=>$d['nama'],
            'harga'=>$d['harga'],
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
}
