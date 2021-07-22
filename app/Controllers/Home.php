<?php

namespace App\Controllers;

use App\Models\Account;
use App\Models\Barang;

class Home extends BaseController
{
	public function index()
	{
		print_r($this->request->getVar());
		$model = new Account();
		if ($model->checkAccount('a@google.com', 'hello') == Account::SUCCESS)
			return view('v_template');
		else
			return 'GAGAL';
	}

	public function item()
	{
		$model = new Barang();
		$data = $model->getBarang('00000007', $this->request->getVar('keyword'));
		return view('v_item', $data);
	}

	public function cart()
	{
		$session = session();
		return view('v_cart');
	}
}
