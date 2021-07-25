<?php

namespace App\Controllers;

use App\Models\m_signin;
use App\Models\m_item;
use App\Models\m_cart;

class c_cart extends BaseController {
	private $signin;
	private $cart;
	protected $request;

    function __construct() {
        $this->signin = new m_signin();
		$this->item = new m_item();
		$this->cart = new m_cart();
	}

	public function index() {
		if( !$this->signin->verifyAuth() )
			return redirect()->to(base_url('signin'));
		$requestData = $this->request->getVar();
		if( isset($requestData['itemName']) ) {
			$itemName = $requestData['itemName'];
			$this->cart->addCart($itemName, m_cart::DEFAULT_ITEM_AMOUNT);
		}
		$this->cart->getCart();
		return 'HELLO';
	}
}