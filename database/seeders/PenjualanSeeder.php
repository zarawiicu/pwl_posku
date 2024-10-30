<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
    $data = [
        [
            'penjualan_id' => 1,
            'user_id' => 3,
            'pembeli' => 'Rido',
            'penjualan_kode' => '0201',
            'tanggal' => '2024-09-11',
        ],
        [
            'penjualan_id' => 2,
            'user_id' => 2,
            'pembeli' => 'Aryo',
            'penjualan_kode' => '0202',
            'tanggal' => '2024-09-12',
        ],
        [
            'penjualan_id' => 3,
            'user_id' => 1,
            'pembeli' => 'Dwi',
            'penjualan_kode' => '0203',
            'tanggal' => '2024-09-13',
        ],
        [
            'penjualan_id' => 4,
            'user_id' => 3,
            'pembeli' => 'Eko',
            'penjualan_kode' => '0204',
            'tanggal' => '2024-09-14',
        ],
        [
            'penjualan_id' => 5,
            'user_id' => 2,
            'pembeli' => 'Fajar',
            'penjualan_kode' => '0205',
            'tanggal' => '2024-09-15',
        ],
        [
            'penjualan_id' => 6,
            'user_id' => 1,
            'pembeli' => 'Gusti',
            'penjualan_kode' => '0206',
            'tanggal' => '2024-09-16',
        ],
        [
            'penjualan_id' => 7,
            'user_id' => 3,
            'pembeli' => 'Hari',
            'penjualan_kode' => '0207',
            'tanggal' => '2024-09-17',
        ],
        [
            'penjualan_id' => 8,
            'user_id' => 2,
            'pembeli' => 'Iwan',
            'penjualan_kode' => '0208',
            'tanggal' => '2024-09-18',
        ],
        [
            'penjualan_id' => 9,
            'user_id' => 1,
            'pembeli' => 'Joko',
            'penjualan_kode' => '0209',
            'tanggal' => '2024-09-19',
        ],
        [
            'penjualan_id' => 10,
            'user_id' => 3,
            'pembeli' => 'Kurniawan',
            'penjualan_kode' => '0210',
            'tanggal' => '2024-09-20',
        ],
    ];
    DB::table('t_penjualan')->insert($data);
    }
}
