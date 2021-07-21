<?php

namespace App\Controllers;

class Portal extends BaseController
{
	public function index()
	{
		return view('v_login');
	}

	public function register()
	{
		return view('v_register');
	}
}
