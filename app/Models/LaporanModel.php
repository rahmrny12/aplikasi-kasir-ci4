<?php 

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
	protected $table = 'transaksi';

	public function laporanTransaksi()
	{
		return $this->table($this->table)
					->orderBy('id_transaksi', 'DESC');
	}

	public function getTotalTransaksi()
	{
		return $this->db->table($this->table)
						->selectSUM('total_transaksi')
						->get()
						->getRowArray();
	}
}