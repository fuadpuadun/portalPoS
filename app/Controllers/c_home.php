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

	public function cartref()
	{
		$session = session();
		$session->start();
		$cart = $session->get('cart');
		$request = $this->request->getVar();
		if (isset($request['nama_barang'], $request['harga_barang'], $request['jumlah_barang']))
		{
			$nama_barang = $request['nama_barang'];
			$cart[$nama_barang] = [
				'harga_barang' => $request['harga_barang'],
				'stok_barang' => $cart[$nama_barang]['stok_barang'],
				'jumlah_barang' => $request['jumlah_barang']
			];
			$session->set('cart', $cart);
		}
		$data = $session->get('cart');
		// print_r($data);
		// $session->destroy();
		return view('v_cart', $data ? $data : []);
	}

	public function removeItemCart($nama_barang)
	{
		$session = session();

		$cart = $session->get('cart');

		if(isset($cart[$nama_barang])) {
			unset($cart[$nama_barang]);
			$session->set('cart', $cart);
		}
		return redirect()->to(base_url('cart'));
	}

	public function clearCart()
	{
		$session = session();
		$session->remove('cart');
        return redirect()->to(base_url('cart'));
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