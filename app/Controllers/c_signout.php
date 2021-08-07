<?php

namespace App\Controllers;

use App\Models\m_signout;

class c_signout extends BaseController
{
	private $signout;

	function __construct()
	{
		$this->signout = new m_signout();
	}

	public function index()
	{
		$this->signout->delSession();
		return redirect()->to(base_url('signin'));
	}

	function __destruct()
	{
	}
}
