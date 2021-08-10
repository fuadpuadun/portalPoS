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

    public function changeItem(
        string $itemName,
        string $itemPrice,
        string $itemStock,
        string $itemMinStock
    ) {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "UPDATE barang
                SET harga_barang = $itemPrice,
                stok_barang = $itemStock,
                stok_minimal = $itemMinStock
                WHERE id_umkm = '$umkmId'
                AND nama_barang = '$itemName'";
        $this->database->simpleQuery($sql);
    }

    public function addItem(
        string $itemName,
        string $itemPrice,
        string $itemStock,
        string $itemMinStock
    ) {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "SELECT nama_barang
                FROM barang
                WHERE id_umkm = '$umkmId'
                AND nama_barang = '$itemName'";
        $result = $this->database->simpleQuery($sql);
        if ($result->num_rows != 0)
            return false;
        $sql = "INSERT INTO barang(
                    id_umkm,
                    nama_barang,
                    harga_barang,
                    stok_barang,
                    stok_minimal
                )
                VALUES(
                    $umkmId,
                    '$itemName',
                    $itemPrice,
                    $itemStock,
                    $itemMinStock
                )";
        $this->database->simpleQuery($sql);
        return true;
    }

    function __destruct()
    {
        $this->database->close();
    }
}
