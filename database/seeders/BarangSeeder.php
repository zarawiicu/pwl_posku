<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'SBLK',
                'barang_nama' => 'Seblak',
                'harga_beli' => 10000,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'EST',
                'barang_nama' => 'Es Teler',
                'harga_beli' => 10000,
                'harga_jual' => 13000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'SKL',
                'barang_nama' => 'So klin Lantai',
                'harga_beli' => 10000,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'GTG',
                'barang_nama' => 'Gentle Gen',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'SCR',
                'barang_nama' => 'Sunscreen',
                'harga_beli' => 30000,
                'harga_jual' => 35000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'MOS',
                'barang_nama' => 'Moisturaizer',
                'harga_beli' => 40000,
                'harga_jual' => 42000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'MYBY',
                'barang_nama' => 'My Baby',
                'harga_beli' => 10000,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'ZWTSL',
                'barang_nama' => 'Zwitsal',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'BLS',
                'barang_nama' => 'Blush Korean',
                'harga_beli' => 35000,
                'harga_jual' => 40000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'DRS',
                'barang_nama' => 'Dress',
                'harga_beli' => 45000,
                'harga_jual' => 50000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
