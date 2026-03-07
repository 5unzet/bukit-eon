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

        // Seeder untuk tbl_iw (wisata)
        \DB::table('tbl_iw')->insert([
            [
                'judul_iw' => 'Camp',
                'deskripsi_iw' => 'Nikmati sensasi berkemah di atas awan dengan pemandangan city light yang memukau. Area camp luas dan aman.',
                'buka_iw' => '09:00:00',
                'tutup_iw' => '24:00:00',
                'tiket_iw' => 20000,
                'foto_iw' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80',
                'status_iw' => 'VALID',
                'picu_iw' => 1,
                'created_at_iw' => '2026-03-01 14:31:48',
                'updated_at_iw' => '2026-03-01 14:31:48',
            ],
            [
                'judul_iw' => 'Café',
                'deskripsi_iw' => 'Tempat nongkrong asik dengan pilihan kopi lokal dan camilan hangat sambil menikmati udara sejuk perbukitan.',
                'buka_iw' => '09:00:00',
                'tutup_iw' => '21:00:00',
                'tiket_iw' => 0,
                'foto_iw' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=600&q=80',
                'status_iw' => 'VALID',
                'picu_iw' => 1,
                'created_at_iw' => '2026-03-01 14:31:48',
                'updated_at_iw' => '2026-03-01 14:31:48',
            ],
            [
                'judul_iw' => 'Resto',
                'deskripsi_iw' => 'Menyajikan hidangan khas pedesaan dan menu nusantara yang cocok untuk makan bersama keluarga besar.',
                'buka_iw' => '10:00:00',
                'tutup_iw' => '20:00:00',
                'tiket_iw' => 0,
                'foto_iw' => 'https://images.unsplash.com/photo-1504674900247-ec6b0b1b6e6b?auto=format&fit=crop&w=600&q=80',
                'status_iw' => 'VALID',
                'picu_iw' => 2,
                'created_at_iw' => '2026-03-01 14:31:48',
                'updated_at_iw' => '2026-03-01 14:31:48',
            ],
            [
                'judul_iw' => 'Hunting',
                'deskripsi_iw' => 'Spot foto Instagramable mulai dari dek observasi, ayunan langit, hingga jalur trekking yang estetik.',
                'buka_iw' => '07:00:00',
                'tutup_iw' => '19:00:00',
                'tiket_iw' => 10000,
                'foto_iw' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80',
                'status_iw' => 'VALID',
                'picu_iw' => 1,
                'created_at_iw' => '2026-03-01 14:31:48',
                'updated_at_iw' => '2026-03-01 14:31:48',
            ],
        ]);
    }
}
