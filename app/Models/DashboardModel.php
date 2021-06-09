<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
	protected $table = 'detail_transaksi';

	public function getJumlahKategori()
	{
		return $this->db->table('kategori')
			->countAll();
	}

	public function getJumlahProduk()
	{
		return $this->db->table('produk')
			->countAll();
	}

	public function getJumlahTransaksi()
	{
		return $this->db->table('transaksi')
			->countAll();
	}

	public function getTransaksi()
	{
		return $this->db->table('transaksi')
			->select('tanggal_transaksi, waktu_transaksi, total_transaksi')
			->orderBy('id_transaksi', 'DESC')
			->limit(3)
			->get()
			->getResultArray();
	}

	public function getGrafik()
	{
		return $this->table($this->table)
			->join('produk', 'produk.id_produk = detail_transaksi.id_produk')
			->select('nama_produk, SUM(jumlah_produk) AS jumlah_produk')
			->groupBy('nama_produk')
			->orderBy('jumlah_produk', 'DESC')
			->findAll();
	}
}
