<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'id_user';
	protected $allowedFields = ['nama_user', 'email', 'foto', 'password', 'level_user'];

	protected $useTimestamp = true;
	protected $createdField = 'tgl_ditambahkan';
	protected $updatedField = 'terakhir_diubah';

	public function getUser($email)
	{
		return $this->db->table($this->table)
			->where('email', $email)
			->get()
			->getRowArray();
	}
}
