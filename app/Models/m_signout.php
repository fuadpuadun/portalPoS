<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class m_signout extends Model {
	private $session;

    function __construct() {
        $this->session = session();
        $this->session->start();
    }

    public function delSession() {
        $this->session->remove('auth');
        $this->session->destroy();
    }

    function __destruct() {}
}