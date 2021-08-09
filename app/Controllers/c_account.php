<?php

namespace App\Controllers;

use App\Models\m_signin;
use App\Models\m_account;

class c_account extends BaseController
{
	private $signin;
	private $account;
	protected $request;

	function __construct()
	{
		$this->signin = new m_signin();
		$this->account = new m_account();
	}

	public function index()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$data = $this->account->getAccount();
		return view('v_account', $data);
	}

	public function delete()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['password'])) {
			$password = $requestData['password'];
			if ($this->account->deleteAccount($password))
				return redirect()->to(base_url('signout'));
		}
		return redirect()->to(base_url('account'));
	}

	public function changeProfile()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset(
			$requestData['umkmName'],
			$requestData['email'],
			$requestData['phoneNumber'],
			$requestData['address']
		)) {
			$umkmName = $requestData['umkmName'];
			$email = $requestData['email'];
			$phoneNumber = $requestData['phoneNumber'];
			$address = $requestData['address'];
			$this->account->changeProfile(
				$umkmName,
				$email,
				$phoneNumber,
				$address
			);
		}
		return redirect()->to(base_url('account'));
	}

	public function changePassword()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['password'], $requestData['newPassword'])) {
			$password = $requestData['password'];
			$newPassword = $requestData['newPassword'];
			if ($this->account->changePassword($password, $newPassword))
				return redirect()->to(base_url('signout'));
		}
		return redirect()->to(base_url('account'));
	}

	function __destruct()
	{
	}
}
