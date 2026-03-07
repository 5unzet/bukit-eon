<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderTablesSeeder extends Seeder
{
    public function run(): void
    {
        // Seed tbl_order_header
        DB::table('tbl_order_header')->insert([
            [
                'resi_order_header' => 'RESI001',
                'tanggal_order_header' => '2026-03-07',
                'waktu_order_header' => '10:00:00',
                'nama_order_header' => 'Andi',
                'meja_order_header' => 'A1',
                'status_order_header' => 'INPUT',
                'total_order_header' => 25000,
                'bayar_order_header' => 30000,
                'kembali_order_header' => 5000,
                'created_order_header' => '2026-03-07 10:00:00',
                'updated_order_header' => '2026-03-07 23:43:14',
                'picc_order_header' => 1,
                'picu_order_header' => 1,
            ],
            [
                'resi_order_header' => 'RESI002',
                'tanggal_order_header' => '2026-03-07',
                'waktu_order_header' => '11:15:00',
                'nama_order_header' => 'Budi',
                'meja_order_header' => 'A2',
                'status_order_header' => 'VALID',
                'total_order_header' => 20000,
                'bayar_order_header' => 20000,
                'kembali_order_header' => 0,
                'created_order_header' => '2026-03-07 11:15:00',
                'updated_order_header' => '2026-03-07 23:54:37',
                'picc_order_header' => 2,
                'picu_order_header' => 1,
            ],
            [
                'resi_order_header' => 'RESI003',
                'tanggal_order_header' => '2026-03-07',
                'waktu_order_header' => '12:30:00',
                'nama_order_header' => 'Citra',
                'meja_order_header' => 'B1',
                'status_order_header' => 'FINISH',
                'total_order_header' => 35000,
                'bayar_order_header' => 40000,
                'kembali_order_header' => 5000,
                'created_order_header' => '2026-03-07 12:30:00',
                'updated_order_header' => '2026-03-07 23:43:14',
                'picc_order_header' => 1,
                'picu_order_header' => 2,
            ],
            [
                'resi_order_header' => 'RESI004',
                'tanggal_order_header' => '2026-03-07',
                'waktu_order_header' => '13:45:00',
                'nama_order_header' => 'Dewi',
                'meja_order_header' => 'B2',
                'status_order_header' => 'PAID',
                'total_order_header' => 15000,
                'bayar_order_header' => 20000,
                'kembali_order_header' => 5000,
                'created_order_header' => '2026-03-07 13:45:00',
                'updated_order_header' => '2026-03-07 23:43:14',
                'picc_order_header' => 2,
                'picu_order_header' => 2,
            ],
            [
                'resi_order_header' => 'RESI005',
                'tanggal_order_header' => '2026-03-07',
                'waktu_order_header' => '15:00:00',
                'nama_order_header' => 'Eka',
                'meja_order_header' => 'C1',
                'status_order_header' => 'VOID',
                'total_order_header' => 10000,
                'bayar_order_header' => 10000,
                'kembali_order_header' => 0,
                'created_order_header' => '2026-03-07 15:00:00',
                'updated_order_header' => '2026-03-07 23:43:14',
                'picc_order_header' => 1,
                'picu_order_header' => 1,
            ],
            [
                'resi_order_header' => 'RESI006',
                'tanggal_order_header' => '2026-03-07',
                'waktu_order_header' => '16:15:00',
                'nama_order_header' => 'Fajar',
                'meja_order_header' => 'C2',
                'status_order_header' => 'INPUT',
                'total_order_header' => 22000,
                'bayar_order_header' => 25000,
                'kembali_order_header' => 3000,
                'created_order_header' => '2026-03-07 16:15:00',
                'updated_order_header' => '2026-03-07 23:43:14',
                'picc_order_header' => 2,
                'picu_order_header' => 1,
            ],
        ]);

        // Seed tbl_order_detail
        DB::table('tbl_order_detail')->insert([
            [1, 'RESI001', 1, 'Mie Rebus', 1, 10000, 'Pedas', 'INPUT', '2026-03-07 10:00:00', '2026-03-07 23:48:07', 1, 1],
            [1, 'RESI001', 4, 'Kopi', 2, 5000, 'Manis', 'INPUT', '2026-03-07 10:01:00', '2026-03-07 23:48:07', 1, 1],
            [1, 'RESI001', 6, 'Teh Dingin', 1, 7000, '', 'INPUT', '2026-03-07 10:02:00', '2026-03-07 23:48:07', 1, 1],
            [2, 'RESI002', 2, 'Nasi Goreng', 1, 15000, '', 'VALID', '2026-03-07 11:15:00', '2026-03-07 23:55:39', 2, 1],
            [2, 'RESI002', 4, 'Kopi', 1, 5000, '', 'VALID', '2026-03-07 11:16:00', '2026-03-07 23:55:39', 2, 1],
            [3, 'RESI003', 3, 'Jagung Bakar', 2, 8000, '', 'FINISH', '2026-03-07 12:30:00', '2026-03-07 23:48:07', 1, 2],
            [3, 'RESI003', 1, 'Mie Rebus', 1, 10000, '', 'FINISH', '2026-03-07 12:31:00', '2026-03-07 23:48:07', 1, 2],
            [3, 'RESI003', 6, 'Teh Dingin', 2, 7000, '', 'FINISH', '2026-03-07 12:32:00', '2026-03-07 23:48:07', 1, 2],
            [3, 'RESI003', 5, 'Teh Hangat', 1, 5000, '', 'FINISH', '2026-03-07 12:33:00', '2026-03-07 23:48:07', 1, 2],
            [4, 'RESI004', 2, 'Nasi Goreng', 1, 15000, '', 'FINISH', '2026-03-07 13:45:00', '2026-03-07 23:48:07', 2, 2],
            [4, 'RESI004', 4, 'Kopi', 1, 5000, '', 'FINISH', '2026-03-07 13:46:00', '2026-03-07 23:48:07', 2, 2],
            [4, 'RESI004', 3, 'Jagung Bakar', 1, 8000, '', 'FINISH', '2026-03-07 13:47:00', '2026-03-07 23:48:07', 2, 2],
            [5, 'RESI005', 1, 'Mie Rebus', 1, 10000, '', 'VOID', '2026-03-07 15:00:00', '2026-03-07 23:48:07', 1, 1],
            [5, 'RESI005', 5, 'Teh Hangat', 1, 5000, '', 'VOID', '2026-03-07 15:01:00', '2026-03-07 23:48:07', 1, 1],
            [5, 'RESI005', 4, 'Kopi', 1, 5000, '', 'VOID', '2026-03-07 15:02:00', '2026-03-07 23:48:07', 1, 1],
            [6, 'RESI006', 6, 'Teh Dingin', 2, 7000, '', 'INPUT', '2026-03-07 16:15:00', '2026-03-07 23:48:07', 2, 1],
            [6, 'RESI006', 3, 'Jagung Bakar', 1, 8000, '', 'INPUT', '2026-03-07 16:16:00', '2026-03-07 23:48:07', 2, 1],
            [6, 'RESI006', 2, 'Nasi Goreng', 1, 15000, '', 'INPUT', '2026-03-07 16:17:00', '2026-03-07 23:48:07', 2, 1],
            [6, 'RESI006', 4, 'Kopi', 1, 5000, '', 'INPUT', '2026-03-07 16:18:00', '2026-03-07 23:48:07', 2, 1],
        ], [
            'id_resi_order_detail',
            'resi_order_detail',
            'id_makan_order_detail',
            'nama_makan_order_detail',
            'qty_order_detail',
            'harga_order_detail',
            'catatan_order_detail',
            'status_order_detail',
            'created_order_detail',
            'updated_order_detail',
            'picc_order_detail',
            'picu_order_detail',
        ]);
    }
}
