<?php

namespace App\Controllers;

class c_portal extends BaseController
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
