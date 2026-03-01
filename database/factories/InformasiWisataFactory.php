<?php

namespace Database\Factories;

use App\Models\InformasiWisata;
use Illuminate\Database\Eloquent\Factories\Factory;

class InformasiWisataFactory extends Factory
{
    protected $model = InformasiWisata::class;

    public function definition(): array
    {
        return [
            'judul' => 'Spot Foto ' . fake()->city(),
            'deskripsi' => fake()->paragraph(),
            'jamBuka' => '08:00 - 17:00',
            'foto' => 'wisata.jpg',
        ];
    }
}