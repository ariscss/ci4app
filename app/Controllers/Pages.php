<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Halaman Utama',
		];

		return view('pages/home', $data);
	}

	public function about()
	{
		$data = [
			'title' => 'About Me'
		];

		return view('pages/about', $data);
	}

	public function contact()
	{
		$data = [
			'title' => 'Contact Me',
			'alamat' => [
				[
					'tipe' => 'Rumah',
					'alamat' => 'Jl. Suka Cinta No. 165',
					'kota' => 'Bandung'
				],
				[
					'tipe' => 'Kantor',
					'alamat' => 'Jl. Marga Cinta No. 178',
					'kota' => 'Bandung'
				]
			]
		];

		return view('pages/contact', $data);
	}

	//--------------------------------------------------------------------

}
