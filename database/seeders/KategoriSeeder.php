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
            ['id' => 1, 'kategori_kode' => 'BVG', 'kategori_nama' => 'Makanan & Minuman'],
            ['id' => 2, 'kategori_kode' => 'HMC', 'kategori_nama' => 'Perawatan Rumah'],
            ['id' => 3, 'kategori_kode' => 'BEH', 'kategori_nama' => 'Perawatan Kecantikan'],
            ['id' => 4, 'kategori_kode' => 'BYC', 'kategori_nama' => 'Perlengkapan Anak'],
            ['id' => 5, 'kategori_kode' => 'FSN', 'kategori_nama' => 'Fashion'],
            ['id' => 6, 'kategori_kode' => 'KSM', 'kategori_nama' => 'Kosmetik'],
            ['id' => 7, 'kategori_kode' => 'BDN', 'kategori_nama' => 'Bandana'],
        ];

        DB::table('m_kategori')->insert($data);
    }
}
?>
