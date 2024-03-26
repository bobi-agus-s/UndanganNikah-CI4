<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Gawe extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_gawe' => 'Gawe01',
                'date_gawe'    => '2022-12-12'  
            ],
            [
                'nama_gawe' => 'Gawe02',
                'date_gawe'    => '2022-12-12'  
            ],
            [
                'nama_gawe' => 'Gawe03',
                'date_gawe'    => '2022-12-12'  
            ],
            [
                'nama_gawe' => 'Gawe04',
                'date_gawe'    => '2022-12-2'  
            ],
            [
                'nama_gawe' => 'Gawe05',
                'date_gawe'    => '2022-12-10'  
            ],
        ];

        $this->db->table('gawe')->insertBatch($data);
    }
}
