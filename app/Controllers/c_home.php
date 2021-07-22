<?php

namespace App\Controllers;

use App\Models\m_account;
use App\Models\m_item;

class c_home extends BaseController
{
	public function index()
	{
		// print_r($this->request->getVar());
		// $model = new Account();
		// if ($model->checkAccount('a@google.com', 'hello') == Account::SUCCESS)
		$model = new m_item();
		$data = $model->get_barang('00000007');
		return view('v_item', $data);
	}

	public function item()
	{
		$model = new m_item();
		$data = $model->get_barang('00000007', $this->request->getGet('keyword'));
		return view('v_item', $data);
	}

	public function cart()
	{
		$session = session();
		$session->start();
		$cart = $session->get('cart');
		$request = $this->request->getGet();
		if (isset($request['nama_barang'], $request['harga_barang'], $request['stok_barang']))
		{
			$nama_barang = $request['nama_barang'];
			$cart[$nama_barang] = [
				'harga_barang' => $request['harga_barang'],
				'stok_barang' => $request['stok_barang'],
				'jumlah_barang' => (isset($cart[$nama_barang]['jumlah_barang']) ? $cart[$nama_barang]['jumlah_barang'] : 0) + 1
			];
			$session->set('cart', $cart);
		}
		$data = $session->get('cart');
		// print_r($data);
		// $session->destroy();
		return view('v_cart', $data ? $data : []);
	}
}
