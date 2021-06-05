<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTransaksi extends Migration
{
	public function up()
	{
		$this->forge->addColumn('transaksi', [
			'bayar_transaksi'       => [
                'type'              => 'INT',
                'constraint'        => '11',
            ],
            'kembalian_transaksi'   => [
                'type'              => 'INT',
                'constraint'        => '11',
            ],
            'tanggal_transaksi'     => [
                'type'              => 'DATE'
            ],
            'waktu_transaksi'       => [
                'type'              => 'TIME'
            ],
		]);
	}

	public function down()
	{
		$this->forge->dropColumn('transaksi', ['bayar_transaksi', 'kembalian_transaksi', 'tanggal_transaksi', 'waktu_transaksi']);
	}
}
