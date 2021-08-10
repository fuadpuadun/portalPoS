<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\m_utils;

class m_signin extends Model
{
    public const UNKNOWN_EMAIL = 0;
    public const PASSWORD_FAILURE = 1;
    public const SIGNIN_SUCCESS = 2;
    public const ACCOUNT_FAILURE = 3;

    private $session;
    private $database;

    function __construct()
    {
        $this->session = session();
        $this->session->start();
        $this->database = db_connect();
    }

    public function verify(string $email, string $password)
    {
        $sql = "SELECT password
                FROM umkm
                WHERE email = '$email'";
        $result = $this->database->query($sql);
        if ($result->getNumRows() == 0)
            return m_signin::UNKNOWN_EMAIL;
        $result = $result->getResultArray();
        foreach ($result as $row) {
            $cryptPassword = $row['password'];
            return m_utils::verifyPassword($password, $cryptPassword) ?
                m_signin::SIGNIN_SUCCESS : m_signin::PASSWORD_FAILURE;
        }
        return m_signin::ACCOUNT_FAILURE;
    }

    public function loadAuth(string $email, string $password)
    {
        $sql = "SELECT id_umkm
                FROM umkm
                WHERE email = '$email'";
        $result = $this->database->query($sql)->getResultArray();
        foreach ($result as $row)
            $umkmId = $row['id_umkm'];
        $auth = [
            'umkmId' => $umkmId,
            'hashedPassword' => m_utils::hashedPassword($password),
            'appSession' => []
        ];
        $this->session->set('auth', $auth);
    }

    public function verifyAuth()
    {
        if (!$this->session->has('auth'))
            return false;
        $authSession = $this->session->get('auth');
        $umkmId = $authSession['umkmId'];
        $hashedPassword = $authSession['hashedPassword'];
        $sql = "SELECT password
                FROM umkm
                WHERE id_umkm = $umkmId";
        $result = $this->database->query($sql);
        if ($result->getNumRows() == 0)
            return false;
        $result = $result->getResultArray();
        foreach ($result as $row) {
            $cryptPassword = $row['password'];
            if (m_utils::verifyHashedPassword($hashedPassword, $cryptPassword))
                return true;
        }
        return false;
    }

    public function setAuth($auth)
    {
        $this->session->set('auth', $auth);
    }

    public function getAuth()
    {
        return $this->session->get('auth');
    }

    public function setAppSession(string $key, $value)
    {
        $auth = $this->getAuth();
        $auth['appSession'] = [$key => $value];
        $this->setAuth($auth);
    }

    public function getAppSession(string $key)
    {
        $auth = $this->getAuth();
        if (!isset($auth['appSession'][$key]))
            $auth['appSession'][$key] = null;
        $appSession = $auth['appSession'][$key];
        if (!isset($appSession))
            $appSession = [];
        return $appSession;
    }

    function __destruct()
    {
        $this->database->close();
    }
}
