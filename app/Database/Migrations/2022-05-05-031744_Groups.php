<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Groups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_group'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_group'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'info'       => [
                'type'       => 'Text',
                'null'       => true
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
        $this->forge->addKey('id_group', true);
        $this->forge->createTable('groups');
    }

    public function down()
    {
        $this->forge->dropTable('groups');
    }
}
