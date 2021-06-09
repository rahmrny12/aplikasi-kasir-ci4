<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
	protected $table = 'kategori';
	protected $primaryKey = 'id_kategori';
	protected $allowedFields = ['nama_kategori'];

	public function getKategori($id = false)
	{
		if ($id == false) {
			return $this->table($this->table)
				->findAll();
		} else {
			return $this->table($this->table)
				->find($id);
		}
	}
}
