<?php

namespace App\Models;

use CodeIgniter\Model;

class m_utils extends Model
{
    private const SALT = 'zP7jU*Aqf7HPkLht*(AdY+ebe*=9Pt/o';

    public static function hashedPassword(string $password)
    {
        $fixed = hash('sha3-256', m_utils::SALT . $password);
        return password_hash($fixed, PASSWORD_BCRYPT);
    }

    public static function passwordCompare(
        string $password,
        string $hashedPassword
    ) {
        $fixed = hash('sha3-256', m_utils::SALT . $password);
        return password_verify($fixed, $hashedPassword);
    }
}
