<?php

namespace App\Controllers;

use App\Models\m_signup;

class c_signup extends BaseController {
	private $signup;
	protected $request;

	function __construct() {
		$this->signup = new m_signup();
	}

	public function index() {
		return view('v_signup');
	}

	public function send() {
		$request = $this->request->getVar();
		if( isset($request['email'], $request['password'],
			$request['namaUmkm'], $request['noTelp'], $request['alamat']) ) {
			$email = $request['email'];
			$password = $request['password'];
			$namaUmkm = $request['namaUmkm'];
			$noTelp = $request['noTelp'];
			$alamat = $request['alamat'];
			if( $this->signup->saveAccount($namaUmkm,
				$alamat, $noTelp, $email, $password) )
				return redirect()->to(base_url('home'));
		}
		return redirect()->to(base_url('signup'));
	}

	function __destruct() {}
}