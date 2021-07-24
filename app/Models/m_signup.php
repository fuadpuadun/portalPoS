<?php

namespace App\Models;

use App\Models\m_utils;
use CodeIgniter\Model;

class m_signup extends Model {
    private const MIN_RANDOM = 0;
    private const MAX_RANDOM = 0xFFFFFF;

    private $database;

    function __construct() {
        $this->database = db_connect();
	}

    private function emailExist(string $email) {
        $sql = "SELECT email
                FROM umkm
                WHERE email = '$email'";
        $result = $this->database->simpleQuery($sql);
        return $result->num_rows!=0;
    }

    private function genID() {
        do {
            $randomInt = random_int(m_signup::MIN_RANDOM, m_signup::MAX_RANDOM);
            $sql = "SELECT id_umkm
                    FROM umkm
                    WHERE id_umkm = '$randomInt'";
            $result = $this->database->simpleQuery($sql);
        } while( $result->num_rows!=0 );
        return $randomInt;
    }

    public function saveAccount(string $namaUMKM,
        string $alamat, string $noTelp, string $email, string $password) {
        if( $this->emailExist($email) )
            return false;
        $idUMKM = $this->genID();
        $hashedPassword = m_utils::hashedPassword($password);
        $sql = "INSERT INTO umkm(
                    id_umkm,
                    email,
                    password,
                    nama_umkm,
                    notelp, alamat
                )
                VALUES(
                    $idUMKM,
                    '$email',
                    '$hashedPassword',
                    '$namaUMKM',
                    '$noTelp',
                    '$alamat'
                )";
        $this->database->simpleQuery($sql);
        return true;
    }

    function __destruct() {
        $this->database->close();
    }
}