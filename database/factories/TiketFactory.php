<?php

namespace Database\Factories;

use App\Models\Tiket;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;

class TiketFactory extends Factory
{
    protected $model = Tiket::class;

    public function definition(): array
    {
        return [
            'pengguna_id' => Pengguna::factory(),
            'kodeTiket' => 'TKT-' . strtoupper(fake()->bothify('??###')),
            'tanggalKunjungan' => fake()->dateTimeBetween('now', '+1 month'),
            'jumlah' => fake()->numberBetween(1, 5),
            'totalHarga' => fake()->numberBetween(50000, 200000),
            'status' => fake()->randomElement(['pending', 'dibayar', 'dikirim']),
        ];
    }
}