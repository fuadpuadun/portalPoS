<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\m_signin;
use App\Models\m_utils;

class m_account extends Model
{
    private $signin;
    private $database;

    function __construct()
    {
        $this->signin = new m_signin();
        $this->database = db_connect();
    }

    private function verify(string $password)
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "SELECT password
                FROM umkm
                WHERE id_umkm = '$umkmId'";
        $result = $this->database->query($sql);
        if ($result->getNumRows() == 0)
            return false;
        $result = $result->getResultArray();
        foreach ($result as $row) {
            $cryptPassword = $row['password'];
            return m_utils::verifyPassword($password, $cryptPassword);
        }
        return false;
    }

    public function getAccount()
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "SELECT id_umkm, email, nama_umkm, notelp, alamat
                FROM umkm
                WHERE id_umkm = '$umkmId'";
        $result = $this->database->query($sql);
        return $result->getResultArray()[0];
    }

    public function deleteAccount(string $password)
    {
        if (!$this->verify($password))
            return false;
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "DELETE FROM umkm
                WHERE id_umkm = '$umkmId'";
        $result = $this->database->simpleQuery($sql);
        return true;
    }

    public function changeProfile(
        string $umkmName,
        string $email,
        string $phoneNumber,
        string $address
    ) {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "UPDATE umkm
                SET nama_umkm = '$umkmName',
                email = '$email',
                notelp = '$phoneNumber',
                alamat = '$address'
                WHERE id_umkm = '$umkmId'";
        $this->database->simpleQuery($sql);
    }

    public function changePassword(string $password, string $newPassword)
    {
        if (!$this->verify($password))
            return false;
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $cryptPassword = m_utils::cryptPassword($newPassword);
        $sql = "UPDATE umkm
                SET password = '$cryptPassword'
                WHERE id_umkm = '$umkmId'";
        $this->database->simpleQuery($sql);
        return true;
    }

    function __destruct()
    {
        $this->database->close();
    }
}
