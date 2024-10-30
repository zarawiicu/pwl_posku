<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class DetailSeeder extends Seeder
{
    
    public function run(): void
    {
        $data = [
            [
                'detail_id' => 1,
                'penjualan_id' => 1,
                'barang_id' => 1,
                'harga' => 4000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 2,
                'penjualan_id' => 2,
                'barang_id' => 2,
                'harga' => 6000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 3,
                'penjualan_id' => 3,
                'barang_id' => 3,
                'harga' => 8000, 
                'jumlah' => 2,
            ],
            [
                'detail_id' => 4,
                'penjualan_id' => 4,
                'barang_id' => 4,
                'harga' => 10000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 5,
                'penjualan_id' => 5,
                'barang_id' => 5,
                'harga' => 12000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 6,
                'penjualan_id' => 6,
                'barang_id' => 6,
                'harga' => 14000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 7,
                'penjualan_id' => 7,
                'barang_id' => 7,
                'harga' => 16000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 8,
                'penjualan_id' => 8,
                'barang_id' => 8,
                'harga' => 18000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 9,
                'penjualan_id' => 9,
                'barang_id' => 9,
                'harga' => 20000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10,
                'penjualan_id' => 10,
                'barang_id' => 10,
                'harga' => 22000,
                'jumlah' => 2,
            ],
        ];
        DB::table('t_penjualan_detail')->insert($data);
    }
}
