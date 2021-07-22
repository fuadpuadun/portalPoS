<?php

namespace App\Controllers;

use Codeigniter\Controller;
use App\Models\m_item;


Class c_sales extends Controller
{
    protected $item;

    public function __construct() {

        helper('my_helper');
        $this->item = new m_barang();
    }
}