<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\UserModel;

class Home extends BaseController
{
	public function __construct()
	{
		helper(['form']);
		$this->model_dashboard = new DashboardModel();
		$this->model_user = new UserModel();
	}

	public function index()
	{
		$email = session()->get('user');
		$grafik = $this->model_dashboard->getGrafik();

		$nama_grafik = null;
		$jumlah_grafik = null;

		foreach ($grafik as $row) {
			$nama_grafik .= "'" . addslashes($row['nama_produk']) . "'" . ", ";
			$jumlah_grafik .= "'{$row['jumlah_produk']}'" . ", ";
		}

		$data = [
			'jumlah_kategori' 	=> $this->model_dashboard->getJumlahKategori(),
			'jumlah_produk'		=> $this->model_dashboard->getJumlahProduk(),
			'jumlah_transaksi'	=> $this->model_dashboard->getJumlahTransaksi(),
			'transaksi'			=> $this->model_dashboard->getTransaksi(),
			'nama_grafik'		=> $nama_grafik,
			'jumlah_grafik'		=> $jumlah_grafik
		];

		$data['title'] = 'Aplikasi Kasir';
		$data['user'] = $this->model_user->getUser($email);
		return view('dashboard', $data);
	}

	public function profile()
	{
		$email = session()->get('user');

		$data = [
			'title'	=> 'User Profile',
			'user' 	=> $this->model_user->getUser($email)
		];
		return view('user/index', $data);
	}

	public function editProfile()
	{
		$email = session()->get('user');

		$data = [
			'title'			=> 'Edit Profile',
			'user' 			=> $this->model_user->getUser($email),
			'validation'	=> \Config\Services::validation()
		];
		return view('user/edit_profile', $data);
	}

	public function prosesEdit()
	{
		if (!$this->validate([
			'nama_user'			=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required'	=> 'Nama lengkap wajib diisi.'
				]
			],
			'foto'			=> [
				'rules' 	=> 'max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
				'errors'	=> [
					'mime_in' 	=> 'Ekstensi file foto harus berupa jpg, jpeg, png.',
					'max_size' 	=> 'Ukuran file foto maksimal 2 MB.'
				]
			]
		])) {

			return redirect()->to('/home/editProfile')->withInput();
		} else {
			$data = [
				'id_user'	=> $this->request->getPost('id_user'),
				'email'		=> $this->request->getPost('email'),
				'nama_user'	=> $this->request->getPost('nama_user'),
				'foto'		=> $this->request->getFile('foto')
			];

			$foto_lama = $this->request->getPost('foto_lama');

			// jika foto tidak berubah
			if ($data['foto']->getError() == 4) {
				$data['foto'] = $foto_lama;
			} else {
				$data['foto']->move('assets/img/profile');
				$data['foto'] = $data['foto']->getName();

				if ($foto_lama != 'default.jpg') {
					unlink('assets/img/profile/' . $foto_lama);
				}
			}

			$this->model_user->save($data);

			return redirect()->to('/home/profile');
		}
	}
}
