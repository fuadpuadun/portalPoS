<?php

namespace App\Controllers;

use App\Models\m_signin;
use App\Models\m_item;
use App\Models\m_cart;

class c_cart extends BaseController
{
	private $signin;
	private $cart;
	protected $request;

	function __construct()
	{
		$this->signin = new m_signin();
		$this->item = new m_item();
		$this->cart = new m_cart();
	}

	public function index()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['itemName'])) {
			$itemName = $requestData['itemName'];
			$this->cart->addCart($itemName, m_cart::DEFAULT_ITEM_AMOUNT);
		}
		$data = $this->cart->getCart();
		return view('v_cart', $data);
	}

	public function update()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['itemName'], $requestData['itemAmount'])) {
			$itemName = $requestData['itemName'];
			$itemAmount = $requestData['itemAmount'];
			$this->cart->setCart($itemName, $itemAmount);
		}
		return redirect()->to(base_url('cart'));
	}

	public function delete()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['itemName'])) {
			$itemName = $requestData['itemName'];
			$this->cart->delCart($itemName);
			return redirect()->to(base_url('cart'));
		}
		$this->cart->delCart();
		return redirect()->to(base_url('cart'));
	}

	public function checkout()
	{
		if (!$this->signin->verifyAuth())
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if (isset($requestData['paymentStatus'], $requestData['description'])) {
			$paymentStatus = $requestData['paymentStatus'];
			$description = $requestData['description'];
			$txnId = $this->cart->release($paymentStatus, $description);
			if ($txnId != null)
				return redirect()->to(base_url('sale/detail') . "?txnId=$txnId");
		}
		return redirect()->to(base_url('cart'));
	}

	function __destruct()
	{
	}
}
