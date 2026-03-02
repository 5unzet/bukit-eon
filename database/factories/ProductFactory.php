<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
    'nama' => fake()->randomElement(['Nasi Goreng', 'Mie Rebus', 'Jagung Bakar', 'Kopi']),
    'harga' => fake()->numberBetween(10000, 50000),
    'stok' => fake()->numberBetween(10, 100),
    ];

    return [
    'pengguna_id' => \App\Models\Pengguna::factory(), // Relasi otomatis
    'kodeTiket' => 'TKT-' . strtoupper(fake()->bothify('??###')),
    'tanggalKunjungan' => fake()->dateTimeBetween('now', '+1 month'),
    'jumlah' => fake()->numberBetween(1, 5),
    'totalHarga' => fake()->numberBetween(50000, 250000),
    'status' => fake()->randomElement(['pending', 'dibayar', 'dikirim']),
    ];

    return [
    'pengguna_id' => \App\Models\Pengguna::factory(),
    'makanan_id' => \App\Models\Makanan::factory(),
    'jumlah' => fake()->numberBetween(1, 10),
    ];

    return [
    'tiket_id' => \App\Models\Tiket::factory(),
    'metode' => fake()->randomElement(['Transfer Bank', 'E-Wallet', 'Tunai']),
    'status' => fake()->randomElement(['sukses', 'gagal']),
    'tanggalBayar' => now(),
    ];

    return [
    'tanggal' => fake()->date(),
    'jumlahKunjungan' => fake()->numberBetween(50, 200),
    'jumlahTiket' => fake()->numberBetween(30, 150),
    'jumlahMakanan' => fake()->numberBetween(20, 100),
    ];

    
}
}
