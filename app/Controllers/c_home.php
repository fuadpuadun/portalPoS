<?php

namespace App\Controllers;

use App\Models\m_signin;
use App\Models\m_item;
use App\Models\m_sale;

class c_home extends BaseController {
	private $signin;
	protected $request;

    function __construct() {
        $this->signin = new m_signin();
	}

	public function index() {
		return redirect()->to(base_url('item'));
	}

	public function sale()
	{
		$model = new m_sale();
		$data = $model->get_txn('00000007');
		return view('v_sale', $data);
	}

	public function sale_detail()
	{
		$request = $this->request->getVar();
		$model = new m_sale();
		$data = $model->get_sale($request['id_transaksi']);
		return view('v_sale_detail', $data);
	}

	public function sale_payoff()
	{
		$request = $this->request->getVar();
		$model = new m_sale();
		$model->payoff($request['id_transaksi']);
		$data = $model->get_sale($request['id_transaksi']);
		return view('v_sale_detail', $data);
	}
}