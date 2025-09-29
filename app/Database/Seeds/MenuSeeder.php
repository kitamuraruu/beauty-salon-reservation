<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'カット',
                'price' => 3000,
            ],
            [
                'name' => 'カット+カラー',
                'price' => 5000,
            ],
            [
                'name' => 'パーマ',
                'price' => 4000,
            ],
            [
                'name' => 'ヘッドスパ',
                'price' => 2000,
            ],
        ];

        $this->db->table('menus')->insertBatch($data);
    }
}
