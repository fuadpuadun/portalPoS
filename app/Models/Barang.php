<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model
{
    
	public function __construct()
	{
		parent::__construct();
	}

    public function getBarang(string $idUmkm, string $keyword = null)
    {
        $db = db_connect();
        if ($keyword == null)
            $sql = "SELECT nama_barang, harga_barang, stok_barang FROM barang WHERE id_umkm = '$idUmkm'";
        else
            $sql = "SELECT nama_barang, harga_barang, stok_barang FROM barang WHERE id_umkm = '$idUmkm' AND nama_barang LIKE '%$keyword%'";
        if (!$result = $db->query($sql))
            print_r($db->error());
        $db->close();
        return $result->getResultArray();
    }
}
