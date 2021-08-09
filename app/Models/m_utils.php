<?php

namespace App\Models;

use CodeIgniter\Model;

class m_utils extends Model
{
    private const SALT = 'zP7jU*Aqf7HPkLht*(AdY+ebe*=9Pt/o';

    public static function hashedPassword(string $password)
    {
        return hash('sha3-256', m_utils::SALT . $password);
    }

    public static function cryptPassword(string $password)
    {
        return password_hash(
            m_utils::hashedPassword($password),
            PASSWORD_BCRYPT
        );
    }

    public static function verifyHashedPassword(
        string $hashedPassword,
        string $cryptPassword
    ) {
        return password_verify($hashedPassword, $cryptPassword);
    }

    public static function verifyPassword(
        string $password,
        string $cryptPassword
    ) {
        return password_verify(
            m_utils::hashedPassword($password),
            $cryptPassword
        );
    }
}
