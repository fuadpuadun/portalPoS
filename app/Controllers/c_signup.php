<?php

namespace App\Controllers;

use App\Models\m_signup;
use App\Models\m_signin;

class c_signup extends BaseController
{
	private $signup;
	private $signin;
	protected $request;

	function __construct()
	{
		$this->signup = new m_signup();
		$this->signin = new m_signin();
	}

	public function index()
	{
		if ($this->signin->verifyAuth())
			return redirect()->to(base_url('home'));
		return view('v_signup');
	}

	public function send()
	{
		$request = $this->request->getVar();
		if (isset(
			$request['email'],
			$request['password'],
			$request['umkmName'],
			$request['phoneNumber'],
			$request['address']
		)) {
			$email = $request['email'];
			$password = $request['password'];
			$umkmName = $request['umkmName'];
			$phoneNumber = $request['phoneNumber'];
			$address = $request['address'];
			if ($this->signup->saveAccount(
				$umkmName,
				$address,
				$phoneNumber,
				$email,
				$password
			)) {
				$this->signin->loadAuth($email, $password);
				return redirect()->to(base_url('home'));
			}
		}
		return redirect()->to(base_url('signup'));
	}

	function __destruct()
	{
	}
}
