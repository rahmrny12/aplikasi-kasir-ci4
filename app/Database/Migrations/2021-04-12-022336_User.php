<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'               => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'nama'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'email'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'foto'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'password'              => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
            ],
            'level_user'            => [
                'type'              => 'ENUM',
                'constraint'        => ['pengelola', 'kasir'],
            ],
            // 'terakhir_diubah TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'tgl_ditambahkan'       => [
                'type'              => 'TIMESTAMP',
            ],
            'terakhir_diubah'       => [
                'type'              => 'TIMESTAMP',
            ]
        ]);
        $this->forge->addKey('id_user', TRUE);
        $this->forge->createTable('user');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
