<?php

namespace Database\Factories;

use App\Models\PesananMakanan;
use App\Models\Pengguna;
use App\Models\Makanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesananMakananFactory extends Factory
{
    /**
     * Nama model yang terkait dengan factory ini.
     */
    protected $model = PesananMakanan::class;

    /**
     * Definisikan state default model.
     */
    public function definition(): array
    {
        return [
            // Mengambil id dari factory lain secara otomatis
            'pengguna_id' => Pengguna::factory(), 
            'makanan_id' => Makanan::factory(),
            'jumlah' => fake()->numberBetween(1, 5),
        ];
    }
}