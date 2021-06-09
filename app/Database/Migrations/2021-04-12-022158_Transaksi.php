<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->db->enableForeignKeyChecks();
        $this->forge->addField([
            'id_transaksi'          => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'id_user'                  => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],
            'total_transaksi'       => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
            ],
            'bayar_transaksi'       => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
            ],
            'kembalian_transaksi'   => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
            ],
            'tanggal_transaksi'     => [
                'type'              => 'DATE'
            ],
            'waktu_transaksi'       => [
                'type'              => 'TIME'
            ]
        ]);
        $this->forge->addKey('id_transaksi', TRUE);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaksi');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
