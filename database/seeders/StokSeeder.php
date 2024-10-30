<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'stok_id' => 1,
                'barang_id' => 1,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-10',
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 2,
                'barang_id' => 2,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 30,
            ],
            [
                'stok_id' => 3,
                'barang_id' => 3,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-12',
                'stok_jumlah' => 40,
            ],
            [
                'stok_id' => 4,
                'barang_id' => 4,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-13',
                'stok_jumlah' => 50,
            ],
            [
                'stok_id' => 5,
                'barang_id' => 5,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-14',
                'stok_jumlah' => 60,
            ],
            [
                'stok_id' => 6,
                'barang_id' => 6,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-15',
                'stok_jumlah' => 70,
            ],
            [
                'stok_id' => 7,
                'barang_id' => 7,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-16',
                'stok_jumlah' => 80,
            ],
            [
                'stok_id' => 8,
                'barang_id' => 8,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-17',
                'stok_jumlah' => 90,
            ],
            [
                'stok_id' => 9,
                'barang_id' => 9,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-18',
                'stok_jumlah' => 100,
            ],
            [
                'stok_id' => 10,
                'barang_id' => 10,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-19',
                'stok_jumlah' => 110,
            ]
        ];

        // Ubah semua user_id ke 3
        foreach ($data as &$item) {
            $item['user_id'] = 3;
        }

        DB::table('t_stok')->insert($data);
    }
}
