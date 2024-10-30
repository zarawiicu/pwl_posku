<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'BVG', 'kategori_nama' => 'Makanan & Minuman'],
            ['kategori_id' => 2, 'kategori_kode' => 'HMC', 'kategori_nama' => 'Perawatan Rumah'],
            ['kategori_id' => 3, 'kategori_kode' => 'BEH', 'kategori_nama' => 'Perawatan Kecantikan'],
            ['kategori_id' => 4, 'kategori_kode' => 'BYC', 'kategori_nama' => 'Perlengkapan Anak'],
            ['kategori_id' => 5, 'kategori_kode' => 'FSN', 'kategori_nama' => 'Fashion'],
            ['kategori_id' => 6, 'kategori_kode' => 'KSM', 'kategori_nama' => 'Kosmetik'],
            ['kategori_id' => 7, 'kategori_kode' => 'BDN', 'kategori_nama' => 'Bandana'],
        ];

        DB::table('m_kategori')->insert($data);
    }
}
