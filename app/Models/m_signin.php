<?php

namespace App\Models;

use App\Models\m_utils;
use CodeIgniter\Model;
use Exception;

class m_signin extends Model {
    public const UNKNOWN_EMAIL = 0;
    public const PASSWORD_FAILURE = 1;
    public const SIGNIN_SUCCESS = 2;
    public const ACCOUNT_FAILURE = 3;

	private $session;
    private $database;

    function __construct() {
		$this->session = session();
		$this->session->start();
        $this->database = db_connect();
	}

    public function verify(string $email, string $password) {
        $sql = "SELECT password
                FROM umkm
                WHERE email = '$email'";
        $result = $this->database->query($sql);
        if( $result->getNumRows()==0 )
            return m_signin::UNKNOWN_EMAIL;
        $result = $result->getResultArray();
        foreach($result as $row)
            return m_utils::passwordCompare($password, $row['password']) ?
                m_signin::SIGNIN_SUCCESS : m_signin::PASSWORD_FAILURE;
        return m_signin::ACCOUNT_FAILURE;
    }

    public function loadAuth(string $email) {
        $sql = "SELECT id_umkm, password
                FROM umkm
                WHERE email = '$email'";
        $result = $this->database->query($sql)->getResultArray();
        foreach($result as $row) {
            $idUMKM = $row['id_umkm'];
            $hashedPassword = $row['password'];
        }
        $auth = [
            'idUMKM' => $idUMKM,
            'email' => $email,
            'hashedPassword' => $hashedPassword,
        ];
        $this->session->set('auth', $auth);
    }

    public function verifyAuth() {
        if( !$this->session->has('auth') )
            return false;
        $authSession = $this->session->get('auth');
        $idUMKM = $authSession['idUMKM'];
        $email = $authSession['email'];
        $hashedPassword = $authSession['hashedPassword'];
        $sql = "SELECT id_umkm
                FROM umkm
                WHERE id_umkm = '$idUMKM'
                AND email = '$email'
                AND password = '$hashedPassword'";
        $result = $this->database->simpleQuery($sql);
        return $result->num_rows!=0;
    }

    public function getAuth() {
        return $this->session->get('auth');
    }

    // public function test() {
    //     $sql = "SELECT * FROM umkm";
    //     $result = $this->database->query($sql)->getNumRows();
    //     print_r($result);
    // }

    function __destruct() {
        $this->database->close();
    }
}