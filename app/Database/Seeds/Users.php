<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
           [
            'username' => 'admin01',
            'password' => password_hash('12345', PASSWORD_BCRYPT)
           ],
           [
            'username' => 'admin02',
            'password' => password_hash('00000', PASSWORD_BCRYPT)
           ],
           [
            'username' => 'admin03',
            'password' => password_hash('aaaaa', PASSWORD_BCRYPT)
           ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
