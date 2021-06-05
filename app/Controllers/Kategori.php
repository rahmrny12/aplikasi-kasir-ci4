<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KategoriModel;
use App\Models\UserModel;

class Kategori extends Controller
{
	public function __construct()
	{
		$this->model_kategori = new KategoriModel();
		$this->model_user = new UserModel();
	}

	public function index()
	{
		$email = session()->get('user');
		$user = $this->model_user->getUser($email);

		if ($user['level_user'] == 'kasir') {
			return redirect()->back();
		}

		$data = [
			'title'			=> 'Kategori Produk',
			'user' 			=> $user,
			'kategori'	=> $this->model_kategori->getKategori()
		];
		return view('kategori/index', $data);
	}

	public function tambah()
	{
		$email = session()->get('user');
		$user = $this->model_user->getUser($email);

		if ($user['level_user'] == 'kasir') {
			return redirect()->back();
		}

		$data = [
			'title'			=> 'Tambah Kategori',
			'user' 			=> $user,
			'validation'	=> \Config\Services::validation()
		];
		return view('kategori/tambah', $data);
	}

	public function prosesTambah()
	{
		if (!$this->validate([
			'nama_kategori'	=> [
				'rules'				=> 'required|is_unique[kategori.nama_kategori]',
				'errors'			=> [
					'required' 		=> 'Nama kategori wajib diisi.',
					'is_unique'		=> 'Nama kategori sudah pernah digunakan.'
				]
			]
		])) {

			return redirect()->to('/kategori/tambah')->withInput();

		} else {
			$data = [
				'nama_kategori' 	=> ucwords(strtolower($this->request->getPost('nama_kategori')))
			];

			$this->model_kategori->save($data);
			session()->setFlashdata('success', 'Kategori baru berhasil ditambahkan!');
			return redirect()->to('/kategori');
		}
	}

	public function edit($id)
	{
		$email = session()->get('user');
		$user = $this->model_user->getUser($email);

		if ($user['level_user'] == 'kasir') {
			return redirect()->back();
		}

		$data = [
			'title'			=> 'Ubah Kategori',
			'user' 			=> $user,
			'kategori'		=> $this->model_kategori->getKategori($id),
			'validation'	=> \Config\Services::validation()
		];
		return view('kategori/edit', $data);
	}

	public function prosesEdit($id)
	{
		if (!$this->validate([
			'nama_kategori'	=> [
				'rules'				=> 'required|is_unique[kategori.nama_kategori]',
				'errors'			=> [
					'required' 		=> 'Nama kategori wajib diisi.',
					'is_unique'		=> 'Nama kategori sudah pernah digunakan.'
				]
			]
		])) {

			return redirect()->to('/kategori/edit/' . $id)->withInput();

		} else {
			$data = [
				'id_kategori'		=> $id,
				'nama_kategori' => $this->request->getPost('nama_kategori'),
			];

			$this->model_kategori->save($data);
			session()->setFlashdata('success', 'Kategori berhasil diubah!');
			return redirect()->to(base_url('kategori'));
		}
	}

	public function hapus($id)
	{
		$email = session()->get('user');
		$user = $this->model_user->getUser($email);

		if ($user['level_user'] == 'kasir') {
			return redirect()->back();
		}
		
		$this->model_kategori->delete($id);
		session()->setFlashdata('warning', 'Kategori berhasil dihapus');
		return redirect()->to(base_url('kategori'));
	}
}

