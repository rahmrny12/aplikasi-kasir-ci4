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
            'total_transaksi'       => [
                'type'              => 'INT',
                'constraint'        => '11',
            ],
            'user'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',  
            ],
        ]);
        $this->forge->addKey('id_transaksi', TRUE);
        $this->forge->createTable('transaksi');
    }
 
    //--------------------------------------------------------------------
 
    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}