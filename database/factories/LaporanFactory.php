<?php

namespace Database\Factories;

use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanFactory extends Factory
{
    protected $model = Laporan::class;

    public function definition(): array
    {
        return [
            'tanggal' => fake()->date(),
            'jumlahKunjungan' => fake()->numberBetween(50, 200),
            'jumlahTiket' => fake()->numberBetween(30, 150),
            'jumlahMakanan' => fake()->numberBetween(20, 100),
        ];
    }
}