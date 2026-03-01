<?php

namespace Database\Factories;

use App\Models\RiwayatPembelian;
use App\Models\Pengguna;
use App\Models\Tiket;
use Illuminate\Database\Eloquent\Factories\Factory;

class RiwayatPembelianFactory extends Factory
{
    protected $model = RiwayatPembelian::class;

    public function definition(): array
    {
        return [
            'pengguna_id' => Pengguna::factory(),
            'tiket_id' => Tiket::factory(),
            'tanggal' => fake()->date(),
        ];
    }
}