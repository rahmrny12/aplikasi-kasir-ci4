<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
	protected $table = 'produk';
	protected $primaryKey = 'id_produk';
	protected $allowedFields = ['id_kategori', 'nama_produk', 'harga_produk'];

	public function getProduk($id = false)
	{
		if ($id == false) {
			return $this->table($this->table)
						->join('kategori', 'kategori.id_kategori = produk.id_kategori')
						->orderBy('id_produk', 'DESC');
		} else {
			return $this->table($this->table)
						->join('kategori', 'kategori.id_kategori = produk.id_kategori')
						->find($id);
		}
	}

	public function cari($keyword)
	{
		return $this->table($this->table)
					->like('nama_produk', $keyword)
					->orLike('nama_kategori', $keyword);
	}
}