<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\Tiket;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    public function definition(): array
    {
        return [
            'tiket_id' => Tiket::factory(),
            'metode' => fake()->randomElement(['Transfer Bank', 'E-Wallet', 'Tunai']),
            'status' => fake()->randomElement(['sukses', 'gagal']),
            'tanggalBayar' => now(),
        ];
    }
}