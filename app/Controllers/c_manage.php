<?php

namespace App\Controllers;

use App\Models\m_signin;
use App\Models\m_item;

class c_manage extends BaseController {
	private $signin;
	private $item;
	protected $request;

    function __construct() {
        $this->signin = new m_signin();
		$this->item = new m_item();
	}

	public function manage() {
		if( !$this->signin->verifyAuth() )
			return redirect()->to(base_url('signin'));
		$data = $this->item->getItems();
		return view('v_item_manage', $data);
	}

	function __destruct() {}
}