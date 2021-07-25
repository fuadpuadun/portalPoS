<?php

namespace App\Controllers;

use App\Models\m_signup;
use App\Models\m_signin;

class c_signup extends BaseController {
	private $signup;
	private $signin;
	protected $request;

	function __construct() {
		$this->signup = new m_signup();
		$this->signin = new m_signin();
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
				$alamat, $noTelp, $email, $password) ) {
				$this->signin->loadAuth($email);
				return redirect()->to(base_url('home'));
			}
		}
		return redirect()->to(base_url('signup'));
	}

	function __destruct() {}
}