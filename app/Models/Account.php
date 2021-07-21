<?php

namespace App\Models;

use CodeIgniter\Model;

class Account extends Model
{
    public const UNKNOWN_EMAIL = 0;
    public const WRONG_PASSWORD = 1;
    public const SUCCESS = 2;
    
	public function __construct()
	{
		parent::__construct();
	}

    public function checkAccount(string $email, string $password)
    {
        $db = db_connect();
        $sql = "SELECT password FROM umkm WHERE email = '$email'";
        if (!$result = $db->query($sql))
            print_r($db->error());
        $ret = Account::UNKNOWN_EMAIL;
        foreach ($result->getResultArray() as $row)
            $isValid = $row['password'] == $password ?
                Account::SUCCESS : Account::WRONG_PASSWORD;
        $db->close();
        return $isValid;
    }
}
