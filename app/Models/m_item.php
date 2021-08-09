<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\m_signin;

class m_item extends Model
{
    private $signin;
    private $database;

    function __construct()
    {
        $this->signin = new m_signin();
        $this->database = db_connect();
    }

    public function getExistItems(string $keyword = null)
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        if ($keyword == null)
            $sql = "SELECT nama_barang, harga_barang, stok_barang
                    FROM barang
                    WHERE id_umkm = '$umkmId'
                    AND stok_barang > 0
                    ORDER BY nama_barang ASC";
        else
            $sql = "SELECT nama_barang, harga_barang, stok_barang
                    FROM barang
                    WHERE id_umkm = '$umkmId'
                    AND stok_barang > 0
                    AND nama_barang LIKE '%$keyword%'
                    ORDER BY nama_barang ASC";
        $result = $this->database->query($sql);
        return $result->getResultArray();
    }

    public function getItems(string $keyword = null)
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        if ($keyword == null)
            $sql = "SELECT nama_barang, harga_barang, stok_barang, stok_minimal
                    FROM barang
                    WHERE id_umkm = '$umkmId'
                    ORDER BY nama_barang ASC";
        else
            $sql = "SELECT nama_barang, harga_barang, stok_barang, stok_minimal
                    FROM barang
                    WHERE id_umkm = '$umkmId'
                    AND nama_barang LIKE '%$keyword%'
                    ORDER BY nama_barang ASC";
        $result = $this->database->query($sql);
        return $result->getResultArray();
    }

    public function deleteItem(string $itemName)
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "DELETE FROM barang
                WHERE id_umkm = '$umkmId'
                AND nama_barang = '$itemName'";
        $this->database->simpleQuery($sql);
    }

    function __destruct()
    {
        $this->database->close();
    }
}
