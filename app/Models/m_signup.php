<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\m_utils;

class m_signup extends Model
{
    private const MIN_RANDOM = 0;
    private const MAX_RANDOM = 0xFFFFFF;

    private $database;

    function __construct()
    {
        $this->database = db_connect();
    }

    private function emailExist(string $email)
    {
        $sql = "SELECT email
                FROM umkm
                WHERE email = '$email'";
        $result = $this->database->simpleQuery($sql);
        return $result->num_rows != 0;
    }

    private function genUmkmId()
    {
        do {
            $randomInt = random_int(m_signup::MIN_RANDOM, m_signup::MAX_RANDOM);
            $sql = "SELECT id_umkm
                    FROM umkm
                    WHERE id_umkm = $randomInt";
            $result = $this->database->simpleQuery($sql);
        } while ($result->num_rows != 0);
        return $randomInt;
    }

    public function saveAccount(
        string $umkmName,
        string $address,
        string $phoneNumber,
        string $email,
        string $password
    ) {
        if ($this->emailExist($email))
            return false;
        $umkmId = $this->genUmkmId();
        $cryptPassword = m_utils::cryptPassword($password);
        $sql = "INSERT INTO umkm(
                    id_umkm,
                    email,
                    password,
                    nama_umkm,
                    notelp,
                    alamat
                )
                VALUES(
                    $umkmId,
                    '$email',
                    '$cryptPassword',
                    '$umkmName',
                    '$phoneNumber',
                    '$address'
                )";
        $this->database->simpleQuery($sql);
        return true;
    }

    function __destruct()
    {
        $this->database->close();
    }
}
