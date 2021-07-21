<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Account;

class Home extends BaseController
{
	public function index()
	{
		print_r($this->request->getVar());
		$model = new Account();
		if ($model->checkAccount('a@google.com', 'hello') == Account::SUCCESS)
			return view('v_home');
		else
			return 'GAGAL';
	}

	public function acc()
	{
		return view('v_acc_management');
	}

	public function add()
	{
		return view('v_add_item');
	}

	public function cart()
	{
		return view('v_cart');
	}

	public function checkout()
	{
		return view('v_checkout');
	}
}
