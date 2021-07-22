<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class m_account extends Model
{
    public const UNKNOWN_EMAIL = 0;
    public const WRONG_PASSWORD = 1;
    public const LOGIN_SUCCESS = 2;
    public const ACCOUNT_FAILURE = 3;

    public function check_account(string $email, string $password)
    {
        $db = db_connect();
        $sql = "SELECT password FROM umkm WHERE email = '$email'";
        if (($result = $db->query($sql)) === null)
        {
            throw new Exception('Database: Query terjadi kegagalan.', m_account::ACCOUNT_FAILURE);
        }
        $ret = m_account::UNKNOWN_EMAIL;
        foreach ($result->getResultArray() as $row)
            $ret = $row['password'] == $password ?
                m_account::LOGIN_SUCCESS : m_account::WRONG_PASSWORD;
        $db->close();
        return $ret;
    }
}
