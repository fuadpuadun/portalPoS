<?php

namespace App\Models;

use App\Models\m_signin;
use CodeIgniter\Model;
use Exception;

class m_item extends Model {
    private $signin;
    private $database;

    function __construct() {
		$this->signin = new m_signin();
        $this->database = db_connect();
	}

    public function getItems(string $keyword = null) {
        $auth = $this->signin->getAuth();
        $idUMKM = $auth['idUMKM'];
        if( $keyword==null )
            $sql = "SELECT nama_barang, harga_barang, stok_barang
                    FROM barang
                    WHERE id_umkm = '$idUMKM'
                    ORDER BY nama_barang ASC";
        else
            $sql = "SELECT nama_barang, harga_barang, stok_barang
                    FROM barang
                    WHERE id_umkm = '$idUMKM'
                    AND nama_barang LIKE '%$keyword%'
                    ORDER BY nama_barang ASC";
        $result = $this->database->query($sql);
        return $result->getResultArray();
    }

    function __destruct() {
        $this->database->close();
    }
}
