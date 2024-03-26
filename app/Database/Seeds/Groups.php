<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Groups extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_group' => 'Teman TK',
            ],
            [
                'nama_group' => 'Teman SD',
            ],
            [
                'nama_group' => 'Teman SMP',
            ],
            [
                'nama_group' => 'Teman SMK',
            ]
        ];
        $this->db->table('groups')->insertBatch($data);
    }
}
