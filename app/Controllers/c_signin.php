<?php

namespace App\Controllers;

use App\Models\m_signin;

class c_signin extends BaseController {
	private $signin;
	protected $request;

	function __construct() {
		$this->signin = new m_signin();
	}

	public function index() {
		// $this->signin->test();
		return view('v_signin');
	}

	public function send() {
		$request = $this->request->getVar();
		if( isset($request['email'], $request['password']) ) {
			$email = $request['email'];
			$password = $request['password'];
			switch( $this->signin->verify($email, $password) ) {
				case m_signin::UNKNOWN_EMAIL:
					# Email tidak diketahui
					return redirect()->to(base_url('signin'));
				case m_signin::PASSWORD_FAILURE:
					# Password salah
					return redirect()->to(base_url('signin'));
				case m_signin::PASSWORD_FAILURE:
					# Akun gagal
					return redirect()->to(base_url('signin'));
			}
			# Berhasil
			$this->signin->loadAuth($email);
			return redirect()->to(base_url('home'));
		}
		# Gagal
		return redirect()->to(base_url('signin'));
	}

	function __destruct() {}
}