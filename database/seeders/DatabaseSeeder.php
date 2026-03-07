<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \DB::table('tbl_user')->insert([
            [
                'nama_user' => 'naufal',
                'email_user' => 'mochnaufal2002@gmail.com',
                'pass_user' => 'naufal15',
                'role_user' => 'admin',
                'status_user' => 'VALID',
                'created_user' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_user' => 'ikhsanz',
                'email_user' => 'ikhsanz@gmail.com',
                'pass_user' => 'ikhsanz123',
                'role_user' => 'admin',
                'status_user' => 'VALID',
                'created_user' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        \DB::table('tbl_makan')->insert([
            [
                'nama_makan' => 'Mie Rebus',
                'gambar_makan' => 'assets/makan/makan_69abe7402e05c.avif',
                'deskripsi_makan' => 'Mie rebus hangat dengan kuah gurih dan taburan bawang goreng.',
                'harga_makan' => 10000,
                'ketersediaan_makan' => 'OPEN',
                'status_makan' => 'VALID',
                'picu_makan' => 2,
                'created_at_makan' => '2026-03-01 14:31:48',
                'updated_at_makan' => '2026-03-07 15:52:16',
            ],
            [
                'nama_makan' => 'Nasi Goreng',
                'gambar_makan' => null,
                'deskripsi_makan' => 'Nasi goreng spesial dengan telur, ayam, dan kerupuk.',
                'harga_makan' => 15000,
                'ketersediaan_makan' => 'CLOSE',
                'status_makan' => 'VALID',
                'picu_makan' => 1,
                'created_at_makan' => '2026-03-01 14:31:48',
                'updated_at_makan' => '2026-03-07 15:23:31',
            ],
            [
                'nama_makan' => 'Jagung Bakar',
                'gambar_makan' => null,
                'deskripsi_makan' => 'Jagung bakar manis dengan olesan mentega dan keju.',
                'harga_makan' => 8000,
                'ketersediaan_makan' => 'OPEN',
                'status_makan' => 'VOID',
                'picu_makan' => 2,
                'created_at_makan' => '2026-03-01 14:31:48',
                'updated_at_makan' => '2026-03-07 15:23:31',
            ],
            [
                'nama_makan' => 'Kopi',
                'gambar_makan' => null,
                'deskripsi_makan' => 'Kopi hitam panas, cocok untuk menemani pagi Anda.',
                'harga_makan' => 5000,
                'ketersediaan_makan' => 'OPEN',
                'status_makan' => 'VALID',
                'picu_makan' => 1,
                'created_at_makan' => '2026-03-01 14:31:48',
                'updated_at_makan' => '2026-03-07 15:23:31',
            ],
            [
                'nama_makan' => 'Teh Hangat',
                'gambar_makan' => null,
                'deskripsi_makan' => 'Teh hangat manis, pas untuk segala suasana.',
                'harga_makan' => 5000,
                'ketersediaan_makan' => 'CLOSE',
                'status_makan' => 'VOID',
                'picu_makan' => 2,
                'created_at_makan' => '2026-03-01 14:31:48',
                'updated_at_makan' => '2026-03-07 15:23:31',
            ],
            [
                'nama_makan' => 'Teh Dingin',
                'gambar_makan' => null,
                'deskripsi_makan' => 'Teh dingin segar dengan es batu, pelepas dahaga.',
                'harga_makan' => 7000,
                'ketersediaan_makan' => 'OPEN',
                'status_makan' => 'VALID',
                'picu_makan' => 1,
                'created_at_makan' => '2026-03-01 14:31:48',
                'updated_at_makan' => '2026-03-07 15:23:31',
            ],
            [
                'nama_makan' => 'telur',
                'gambar_makan' => 'assets/makan/makan_69abe7af58292.jpg',
                'deskripsi_makan' => 'telur rebus enak',
                'harga_makan' => 20000,
                'ketersediaan_makan' => 'OPEN',
                'status_makan' => 'VALID',
                'picu_makan' => 2,
                'created_at_makan' => '2026-03-07 08:54:07',
                'updated_at_makan' => '2026-03-07 08:54:07',
            ],
        ]);
    }
}
