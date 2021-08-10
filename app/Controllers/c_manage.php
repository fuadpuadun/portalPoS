<?php

namespace App\Controllers;

use App\Models\m_signin;
use App\Models\m_item;

class c_manage extends BaseController
{
	private $signin;
	private $item;
	protected $request;

	function __construct()
	{
		$this->signin = new m_signin();
		$this->item = new m_item();
	}

	public function manage()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$data = $this->item->getItems();
		return view('v_manage', $data);
	}

	public function delete()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['itemName'])) {
			$itemName = $requestData['itemName'];
			$this->item->deleteItem($itemName);
		}
		return redirect()->to(base_url('manage'));
	}

	public function change()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset(
			$requestData['itemName'],
			$requestData['itemPrice'],
			$requestData['itemStock'],
			$requestData['itemMinStock']
		)) {
			$itemName = $requestData['itemName'];
			$itemPrice = $requestData['itemPrice'];
			$itemStock = $requestData['itemStock'];
			$itemMinStock = $requestData['itemMinStock'];
			$this->item->changeItem(
				$itemName,
				$itemPrice,
				$itemStock,
				$itemMinStock
			);
		}
		return redirect()->to(base_url('manage'));
	}

	public function add()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset(
			$requestData['itemName'],
			$requestData['itemPrice'],
			$requestData['itemStock'],
			$requestData['itemMinStock']
		)) {
			$itemName = $requestData['itemName'];
			$itemPrice = $requestData['itemPrice'];
			$itemStock = $requestData['itemStock'];
			$itemMinStock = $requestData['itemMinStock'];
			$this->item->addItem(
				$itemName,
				$itemPrice,
				$itemStock,
				$itemMinStock
			);
		}
		return redirect()->to(base_url('manage'));
	}


	function __destruct()
	{
	}
}
