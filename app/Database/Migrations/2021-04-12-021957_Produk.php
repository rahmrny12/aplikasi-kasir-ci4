<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->db->enableForeignKeyChecks();
        $this->forge->addField([
            'id_produk'             => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    => TRUE
            ],
            'id_kategori'           => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => TRUE
            ],
            'nama_produk'           => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'harga_produk'          => [
                'type'              => 'BIGINT',
                'constraint'        => '20',
            ],
        ]);
        $this->forge->addKey('id_produk', TRUE);
        $this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori', 'CASCADE', 'CASCADE');
        $this->forge->createTable('produk');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
