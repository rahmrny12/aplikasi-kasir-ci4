<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
	// instance model
	public function __construct()
	{
		$this->model_user = new UserModel();
	}

	// halaman login
	public function index()
	{
		// apabila ada sesi user berarti user sudah login
		if (session()->get('user')) {
			return redirect()->back();
		}

		$data = [
			'title' 		=> 'Halaman Login',
			'validation'	=> \Config\Services::validation()
		];
		return view('auth/login', $data);
	}

	// proses login
	public function login()
	{
		if (session()->get('user')) {
			return redirect()->back();
		}

		if (!$this->validate([
			'email'			=> [
				'rules'		=> 'required|valid_email',
				'errors'	=> [
					'required'		=> 'Email untuk login wajib diisi.',
					'valid_email'	=> 'Format email tidak sesuai.'
				]
			],
			'password'	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required'		=> 'Password wajib diisi.'
				]
			]
		])) {

			// jika validasi gagal, pindahkan ke halaman index login sampil mengirim input lama dan data validasi berupa error
			return redirect()->to('/auth/index')->withInput();
		} else {
			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');

			// jika validasi berhasil, ambil data user melalui model
			$user = $this->model_user->getUser($email);

			if ($user) {
				if (password_verify($password, $user['password'])) {

					// jika cocok, buat sesi
					session()->set([
						'user' 			=> $user['email'],
						'sudah_login' 	=> TRUE
					]);
					return redirect()->to('/home');
				} else {
					// jika password tidak sesuai, redirect ke index login dengan mengirim input lama
					session()->setFlashdata('warning', 'Password tidak sesuai!');
					return redirect()->to('/auth')->withInput();
				}
			} else {
				// jika user tidak ditemukan, redirect ke index login
				session()->setFlashdata('warning', 'User tidak ditemukan!');
				return redirect()->to('/auth');
			}
		}
	}

	// halaman registrasi
	public function registrasi()
	{
		if (session()->get('user')) {
			return redirect()->back();
		}

		$data = [
			'title' 		=> 'Halaman Registrasi',
			'validation' 	=> \Config\Services::validation()
		];
		return view('auth/registrasi', $data);
	}

	// proses registrasi
	public function prosesRegistrasi()
	{
		if (session()->get('user')) {
			return redirect()->back();
		}

		$validation = \Config\Services::validation();

		$data = [
			'nama' 					=> htmlspecialchars(ucwords(strtolower($this->request->getPost('nama')))),
			'email' 				=> htmlspecialchars($this->request->getPost('email')),
			'password' 				=> $this->request->getPost('password'),
			'konf_password'			=> $this->request->getPost('konf_password'),
			'foto'					=> 'default.jpg',
			'level_user'			=> 'kasir'
		];

		if ($validation->run($data, 'registrasi') == false) {

			return redirect()->to('/auth/registrasi')->withInput();
		} else {
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			unset($data['konf_password']);

			$this->model_user->insert($data);
			session()->setFlashdata('success', 'Akun baru berhasil ditambahkan!');
			return redirect()->to('/auth');
		}
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/auth');
	}
}
