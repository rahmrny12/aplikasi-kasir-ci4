<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $registrasi = [
		'nama'				=> 'required',
		'email'				=> 'required|valid_email|is_unique[user.email]',
		'password'			=> 'required|min_length[8]',
		'konf_password'		=> 'required|matches[password]'
	];

	public $registrasi_errors = [
		'nama'				=> [
			'required'		=> 'Nama lengkap wajib diisi.',	
		],
		'email'				=> [
			'required'		=> 'Email wajib diisi.',
			'valid_email'	=> 'Format email tidak sesuai.',
			'is_unique'		=> 'Email sudah pernah dipakai.'
		],
		'password'			=> [
			'required'		=> 'Password wajib diisi.',
			'min_length'	=> 'Password minimal harus 8 karakter.'
		],
		'konf_password'		=> [
			'required'		=> 'Konfirmasi password wajib diisi.',
			'matches'		=> 'Konfirmasi password tidak sesuai.'
		]
	];
	
}