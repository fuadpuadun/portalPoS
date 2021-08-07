<?php

namespace App\Controllers;

use App\Models\m_signin;
use App\Models\m_item;

class c_item extends BaseController
{
	private $signin;
	private $item;
	protected $request;

	function __construct()
	{
		$this->signin = new m_signin();
		$this->item = new m_item();
	}

	public function index()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$data = $this->item->getExistItems();
		return view('v_item', $data);
	}

	public function search()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		$keyword = isset($requestData['keyword']) ?
			$requestData['keyword'] : null;
		$data = $this->item->getExistItems($keyword);
		return view('v_item', $data);
	}

	function __destruct()
	{
	}
}
