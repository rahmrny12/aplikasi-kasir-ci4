<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'               => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    => TRUE
            ],
            'nama_user'             => [
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
            'tgl_ditambahkan TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'terakhir_diubah TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
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
