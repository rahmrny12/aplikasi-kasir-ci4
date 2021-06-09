<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use App\Models\LaporanModel;
use App\Models\UserModel;

class Transaksi extends Controller
{
	protected $helpers = [];

	public function __construct()
	{
		helper(['form']);
		$this->model_produk = new ProdukModel();
		$this->model_transaksi = new TransaksiModel();
		$this->model_user = new UserModel();
		$this->model_laporan = new LaporanModel();
	}

	public function index()
	{
		$jenis_produk = $this->model_produk->getProduk()->get()->getResultArray();

		$data = [
			'title'			=> 'Transaksi',
			'user'			=> $this->model_user->getUser(session()->get('user')),
			'jenis_produk'	=> ['' => 'Pilih produk'] + array_column($jenis_produk, 'nama_produk', 'id_produk'),
			'produk'		=> $this->model_transaksi->getPesanan(),
			'validation'	=> \Config\Services::validation()
		];
		return view('transaksi/index', $data);
	}

	public function simpan()
	{
		$timezone = time() + (60 * 60 * 7);
		$waktu = gmdate('H:i:s', $timezone);

		$jumlah_produk = $this->request->getPost('jumlah_produk');
		if (empty($jumlah_produk)) {
			$jumlah_produk = 1;
		}

		if (!$this->validate([
			'id_produk'		=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required'		=> 'Produk wajib dipilih.'
				]
			]
		])) {

			return redirect()->to('/transaksi')->withInput();
		} else {
			$data = [
				'id_produk'					=> $this->request->getPost('id_produk'),
				'id_transaksi'			=> null,
				'jumlah_produk'			=> $jumlah_produk,
				'status_transaksi'	=> 'belum diproses'
			];

			$this->model_transaksi->save($data);

			return redirect()->to('/transaksi');
		}
	}

	public function hapus($id)
	{
		$this->model_transaksi->delete($id);
		return redirect()->to('/transaksi');
	}

	public function bayar()
	{
		if (!$this->validate([
			'bayar'	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required'	=> 'Pembayaran wajib diisi.'
				]
			]
		])) {
			return redirect()->to('/transaksi')->withInput();
		} else {
			$email = session()->get('user');
			$user = $this->model_user->getUser($email);

			$timezone = time() + (60 * 60 * 7);
			$tanggal = gmdate('Y-m-d', $timezone);
			$waktu = gmdate('H:i:s', $timezone);

			$total = $this->request->getPost('total_bayar');
			$bayar = ltrim($this->request->getPost('bayar'), 0);
			$kembalian = null;

			if (!empty($bayar)) {
				if ($bayar < $total) {
					session()->setFlashdata('bayar', 'Pembayaran tidak mencukupi!');
					return redirect()->to('/transaksi')->withInput();
				} else if ($bayar == $total) {
					$kembalian = 0;
				} else {
					$kembalian = $bayar - $total;
				}
			}

			$data = [
				'total_transaksi' 		=> $total,
				'id_user'				=> $user['id_user'],
				'bayar_transaksi' 		=> $bayar,
				'kembalian_transaksi'	=> $kembalian,
				'tanggal_transaksi'		=> $tanggal,
				'waktu_transaksi'		=> $waktu
			];

			$this->model_transaksi->bayar($data);

			session()->setFlashdata('success', 'Transaksi berhasil dilakukan!');
			return redirect()->to('/transaksi');
		}
	}

	public function laporan()
	{
		$page_counter = $this->request->getVar('page_laporan');
		if (empty($page_counter)) {
			$page_counter = 1;
		}

		$total_transaksi = $this->model_laporan->getTotalTransaksi();

		$paginate = [
			'laporan' 			=> $this->model_laporan->laporanTransaksi()
				->paginate(4, 'laporan'),
			'pager'	  			=> $this->model_laporan->pager,
			'page_counter'		=> $page_counter,
			'laporan_total'		=> $total_transaksi
		];

		$data = [
			'title'		=> 'Laporan Transaksi',
			'user'		=> $this->model_user->getUser(session()->get('user')),
		];

		$data = array_merge($data, $paginate);

		return view('transaksi/laporan', $data);
	}
}
