<?php

namespace App\Controllers;

use App\Models\m_signin;
use App\Models\m_sale;

class c_sale extends BaseController
{
	private $signin;
	private $sale;
	protected $request;

	function __construct()
	{
		$this->signin = new m_signin();
		$this->sale = new m_sale();
	}

	public function index()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$data = $this->sale->getSale();
		return view('v_sale', $data);
	}

	public function detail()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['txnId'])) {
			$txnId = $requestData['txnId'];
			$data = $this->sale->getTxn($txnId);
			if (empty($data))
				return redirect()->to(base_url('sale'));
			return view('v_sale_detail', $data);
		}
		return redirect()->to(base_url('sale'));
	}

	public function payoff()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['txnId'])) {
			$txnId = $requestData['txnId'];
			$this->sale->payoff($txnId);
		}
		return redirect()->to(base_url('sale/detail') . "?txnId=$txnId");
	}

	function __destruct()
	{
	}
}
