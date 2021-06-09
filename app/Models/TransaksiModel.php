<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
	protected $table = 'detail_transaksi';
	protected $primaryKey = 'id_detail';
	protected $allowedFields = ['id_produk', 'jumlah_produk', 'status_transaksi', 'waktu_transaksi'];

	public function getPesanan()
	{
		return $this->db->table($this->table)
			->join('produk', 'produk.id_produk = detail_transaksi.id_produk')
			->where('status_transaksi', 'belum diproses')
			->orderBy('id_detail', 'DESC')
			->get()
			->getResultArray();
	}

	public function bayar($data)
	{
		$this->db->table('transaksi')
			->insert($data);

		$id_transaksi = $this->db->table('transaksi')
			->select('id_transaksi')
			->orderBy('id_transaksi', 'DESC')
			->get()
			->getRowArray();

		$this->db->table($this->table)
			->set(['status_transaksi' => 'sudah diproses', 'id_transaksi' => $id_transaksi])
			->where('status_transaksi', 'belum diproses')
			->update();
	}
}
