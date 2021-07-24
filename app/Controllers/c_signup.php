<?php

namespace App\Controllers;

use App\Models\m_signup;

class c_signup extends BaseController {
	private $session;
	private $signup;
	protected $request;

	function __construct() {
		$this->session = session();
		$this->session->start();
		$this->signup = new m_signup();
	}

	public function index() {
		return view('v_signup');
	}

	public function send() {
		$request = $this->request->getVar();
		if( isset($request['email'], $request['password'],
			$request['namaUMKM'], $request['noTelp'], $request['alamat']) ) {
			$email = $request['email'];
			$password = $request['password'];
			$namaUMKM = $request['namaUMKM'];
			$noTelp = $request['noTelp'];
			$alamat = $request['alamat'];
			if( $this->signup->saveAccount($namaUMKM,
				$alamat, $noTelp, $email, $password) ) {
				return 'BERHASIL';
			}
		}
		return 'GAGAL';
	}

	function __destruct() {}
}