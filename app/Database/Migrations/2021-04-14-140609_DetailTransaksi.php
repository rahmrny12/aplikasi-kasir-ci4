<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailTransaksi extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'id_detail'				=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 20,
				'unsigned'			=> TRUE,
				'auto_increment'	=> TRUE,
			],
            'id_produk'            	=> [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'null'              => TRUE,
            ],
            'jumlah_produk'			=> [
            	'type'				=> 'INT',
            	'constraint'		=> 11,
            ],
            'status_transaksi'      => [
                'type'              => 'ENUM',
                'constraint'        => ['sudah diproses', 'belum diproses'],
            ],
            'waktu_transaksi'		=> [
            	'type'				=> 'TIME'
            ]
		]);
		$this->forge->addKey('id_detail', TRUE);
		$this->forge->addForeignKey('id_produk','produk','id_produk','CASCADE','CASCADE');
		$this->forge->createTable('detail_transaksi');
	}

	public function down()
	{
		$this->forge->dropTable('detail_transaksi');
	}
}
