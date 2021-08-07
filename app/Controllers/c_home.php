<?php

namespace App\Controllers;

use App\Models\m_signin;

class c_home extends BaseController
{
	private $signin;
	protected $request;

	function __construct()
	{
		$this->signin = new m_signin();
	}

	public function index()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		return redirect()->to(base_url('item'));
	}

	function __destruct()
	{
	}
}
