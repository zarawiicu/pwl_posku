<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Hasna',
                'penjualan_kode' => 'HS',
                'tanggal' => '2024-09-11',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 1,
                'pembeli' => 'Unyil',
                'penjualan_kode' => 'UY',
                'tanggal' => '2024-09-12',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 1,
                'pembeli' => 'Usro',
                'penjualan_kode' => 'US',
                'tanggal' => '2024-09-13',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 1,
                'pembeli' => 'Awi',
                'penjualan_kode' => 'AW',
                'tanggal' => '2024-09-14',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Afif',
                'penjualan_kode' => 'AF',
                'tanggal' => '2024-09-15',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 2,
                'pembeli' => 'Asye',
                'penjualan_kode' => 'AY',
                'tanggal' => '2024-09-16',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 2,
                'pembeli' => 'Adam',
                'penjualan_kode' => 'AD',
                'tanggal' => '2024-09-17',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Omar',
                'penjualan_kode' => 'OR',
                'tanggal' => '2024-09-18',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Aksara',
                'penjualan_kode' => 'AK',
                'tanggal' => '2024-09-19',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Haidar',
                'penjualan_kode' => 'HR',
                'penjualan_tanggal' => now(),
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
?>