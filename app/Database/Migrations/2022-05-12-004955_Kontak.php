<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kontak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kontak'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kontak'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true
            ],
            'id_group' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true
            ],
            'created_at'       => [
                'type'       => 'DATETIME',
                'null'       => true
            ],
            'updated_at'    => [
                'type'      => "DATETIME",
                'null'      => true
            ],
            'deleted_at'    => [
                'type'      => "DATETIME",
                'null'      => true
            ]
        ]);
        $this->forge->addKey('id_kontak', true);
        $this->forge->addForeignKey('id_group', 'groups', 'id_group');
        $this->forge->createTable('kontak');
    }

    public function down()
    {
        $this->forge->dropForeignKey('kontak', 'kontak_id_group_foreign');
        $this->forge->dropTable('kontak');
    }
}
