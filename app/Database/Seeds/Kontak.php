<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kontak extends Seeder
{
    public function run()
    {
        // cara 1 deklarasi faker dan localization
        $faker = \Faker\Factory::create('id_ID');
        
        for ($i=1; $i <= 25; $i++) { 
            $data = [
                'nama_kontak' => $faker->name,
                'phone' => $faker->phoneNumber,
                'id_group' => rand(1, 4),
                'created_at' => \CodeIgniter\I18n\Time::now()
            ];
            $this->db->table('kontak')->insert($data);
        }


        // cara 2
        // langsung tanpa deklarasi faker
        // $data = [
        //     [
        //         'nama_kontak' => static::faker()->name,
        //         'phone' => static::faker()->phoneNumber,
        //         'id_group' => 2,
        //         'created_at' => \CodeIgniter\I18n\Time::now()
        //     ],
        //     [
        //         'nama_kontak' => static::faker()->name,
        //         'phone' => static::faker()->phoneNumber,
        //         'id_group' => 3,
        //         'created_at' => \CodeIgniter\I18n\Time::now()
        //     ],
        //     [
        //         'nama_kontak' => static::faker()->name,
        //         'phone' => static::faker()->phoneNumber,
        //         'id_group' => 1,
        //         'created_at' => \CodeIgniter\I18n\Time::now()
        //     ],
        //     [
        //         'nama_kontak' => static::faker()->name,
        //         'phone' => static::faker()->phoneNumber,
        //         'id_group' => 2,
        //         'created_at' => \CodeIgniter\I18n\Time::now()
        //     ],
        //     [
        //         'nama_kontak' => static::faker()->name,
        //         'phone' => static::faker()->phoneNumber,
        //         'id_group' => 3,
        //         'created_at' => \CodeIgniter\I18n\Time::now()
        //     ]
        // ];
        // $this->db->table('kontak')->insertBatch($data);
    }
}
