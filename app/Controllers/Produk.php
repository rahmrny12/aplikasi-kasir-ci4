<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\UserModel;

class Produk extends Controller
{
	protected $helpers = [];

	public function __construct()
	{
		helper(['form']);
		$this->model_kategori = new KategoriModel();
		$this->model_produk = new ProdukModel();
		$this->model_user = new UserModel();
	}

	public function index()
	{
		$page_counter = $this->request->getVar('page_produk');
		if (empty($page_counter)) {
			$page_counter = 1;
		}

		$keyword = $this->request->getPost('keyword');
		if ($keyword) {
			$this->model_produk->cari($keyword);
		} else {
			redirect()->to('/produk');
		}

		$paginate = [
			'produk'		=> $this->model_produk->getProduk()->paginate(4, 'produk'),
			'pager'			=> $this->model_produk->getProduk()->pager,
			'page_counter'	=> $page_counter
		];

		$kategori = $this->model_kategori->getKategori();

		$data = [
			'title'			=> 'Data Produk',
			'user'			=> $this->model_user->getUser(session()->get('user')),
			'kategori'		=> ['' => 'Pilih Keyword Kategori'] + array_column($kategori, 'nama_kategori', 'nama_kategori'),
			'validation'	=> \Config\Services::validation()
		];

		$data = array_merge($paginate, $data);

		return view('produk/index', $data);
	}

	public function tambah()
	{
		$email = session()->get('user');
		$user = $this->model_user->getUser($email);

		if ($user['level_user'] == 'kasir') {
			return redirect()->back();
		}

		$kategori = $this->model_kategori->getKategori();

		$data = [
			'title'			=> 'Tambah Produk',
			'user'			=> $user,
			'kategori'		=> ['' => 'Pilih Kategori'] + array_column($kategori, 'nama_kategori', 'id_kategori'),
			'validation'	=> \Config\Services::validation()
		];
		return view('produk/tambah', $data);
	}

	public function prosesTambah()
	{
		if (!$this->validate([
			'id_kategori'	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required'		=> 'Nama kategori wajib dipilih.'
				]
			],
			'nama_produk'	=> [
				'rules'   	=> 'required|is_unique[produk.nama_produk]',
				'errors'  	=> [
					'required'		=> 'Nama produk wajib diisi.',
					'is_unique'		=> 'Nama produk sudah pernah digunakan.'
				]
			],
			'harga_produk'	=> [
				'rules'		=> 'required|integer|min_length[4]',
				'errors'	=> [
					'required'	 	=> 'Harga produk wajib diisi.',
					'integer'	 		=> 'Harga produk harus bernilai angka.',
					'min_length' 	=> 'Harga produk minimal berisi 4 digit',
				]
			]
		])) {

			return redirect()->to('/produk/tambah')->withInput();
		} else {
			$data = [
				'id_kategori' 	=> $this->request->getPost('id_kategori'),
				'nama_produk' 	=> ucwords($this->request->getPost('nama_produk')),
				'harga_produk' 	=> $this->request->getPost('harga_produk')
			];

			$this->model_produk->save($data);

			session()->setFlashdata('success', 'Produk baru berhasil dibuat!');
			return redirect()->to('/produk');
		}
	}

	public function edit($id)
	{
		$email = session()->get('user');
		$user = $this->model_user->getUser($email);

		if ($user['level_user'] == 'kasir') {
			return redirect()->back();
		}

		$kategori = $this->model_kategori->getKategori();

		$data = [
			'title'			=> 'Ubah Produk',
			'user'			=> $user,
			'produk'		=> $this->model_produk->getProduk($id),
			'kategori'		=> ['' => 'Pilih Kategori'] + array_column($kategori, 'nama_kategori', 'id_kategori'),
			'validation'	=> \Config\Services::validation()
		];
		return view('produk/edit', $data);
	}

	public function prosesEdit($id)
	{
		if (!$this->validate([
			'id_kategori'	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required'		=> 'Nama kategori wajib dipilih.'
				]
			],
			'nama_produk'	=> [
				'rules'   	=> 'required|is_unique[produk.nama_produk,id_produk,' . $id . ']',
				'errors'  	=> [
					'required'		=> 'Nama produk wajib diisi.',
					'is_unique'		=> 'Nama produk sudah pernah digunakan.'
				]
			],
			'harga_produk'	=> [
				'rules'		=> 'required|integer|min_length[4]',
				'errors'	=> [
					'required'	 	=> 'Harga produk wajib diisi.',
					'integer'	 		=> 'Harga produk harus bernilai angka.',
					'min_length' 	=> 'Harga produk minimal berisi 4 digit',
				]
			]
		])) {
			return redirect()->to('/produk/edit/' . $id)->withInput();
		} else {
			$data = [
				'id_produk'		=> $id,
				'id_kategori' 	=> $this->request->getPost('id_kategori'),
				'nama_produk' 	=> ucwords($this->request->getPost('nama_produk')),
				'harga_produk' 	=> $this->request->getPost('harga_produk')
			];

			$this->model_produk->save($data);

			session()->setFlashdata('success', 'Produk berhasil diubah!');
			return redirect()->to('/produk');
		}
	}

	public function hapus($id)
	{
		$email = session()->get('user');
		$user = $this->model_user->getUser($email);

		if ($user['level_user'] == 'kasir') {
			return redirect()->back();
		}

		$this->model_produk->delete($id);

		session()->setFlashdata('warning', 'Produk berhasil dihapus');
		return redirect()->to('/produk');
	}
}
