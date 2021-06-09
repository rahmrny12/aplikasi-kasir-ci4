<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
	protected $table = 'transaksi';
	protected $primaryKey = 'id_transaksi';
	protected $allowedFields = ['id_user', 'total_transaksi', 'bayar_transaksi', 'kembalian_transaksi'];

	protected $useTimeStamp = true;

	public function tambahPesanan($data)
	{
		return $this->db->table('detail_transaksi')
			->insert($data);
	}

	public function getPesanan()
	{
		return $this->db->table('detail_transaksi')
			->join('produk', 'produk.id_produk = detail_transaksi.id_produk')
			->where('status_transaksi', 'belum diproses')
			->orderBy('id_detail', 'DESC')
			->get()
			->getResultArray();
	}

	public function bayar($data)
	{
		$id_transaksi = $this->db->table($this->table)
			->select('id_transaksi')
			->orderBy('id_transaksi', 'DESC')
			->get()
			->getRowArray();

		return $this->db->table('detail_transaksi')
			->set(['status_transaksi' => 'sudah diproses', 'id_transaksi' => $id_transaksi])
			->where('status_transaksi', 'belum diproses')
			->update();
	}

	public function laporanTransaksi()
	{
		return $this->table($this->table)
			->join('user', 'user.id_user = transaksi.id_user')
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
