<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'level_id' => 1, // Assuming 1 is admin
                'username' => 'admin',
                'nama' => 'Administrator',
                'password' => bcrypt('12345')
            ],

            [
                'user_id' => 2,
                'level_id' => 2, // Assuming 2 is kasir
                'username' => 'kasir1',
                'nama' => 'Kasir 1',
                'password' => bcrypt('12345')
            ],

            [
                    'user_id' => 3,
                    'level_id' => 2, // Another kasir
                    'username' => 'kasir2',
                    'nama' => 'Kasir 2',
                    'password' => bcrypt('12345'),
            ]
        ];
        DB::table('m_user')->insert($data);
    }
}
?>