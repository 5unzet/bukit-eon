<?php 

namespace Database\Factories;

use App\Models\Makanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class MakananFactory extends Factory 
{
    protected $model = Makanan::class;

    public function definition(): array 
    {
        return [
            'nama' => fake()->randomElement(['Nasi Goreng', 'Mie Rebus', 'Jagung Bakar']),
            'harga' => fake()->numberBetween(10000, 30000),
            'stok' => fake()->numberBetween(10, 100),
        ];
    }
}