<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class m_item extends Model
{
    public const ITEM_FAILURE = 1;
    
    public function get_barang(string $id_umkm, string $keyword = null)
    {
        $db = db_connect();
        if ($keyword === null)
        {
            $sql = "SELECT nama_barang, harga_barang, stok_barang FROM barang WHERE id_umkm = '$id_umkm' ORDER BY nama_barang ASC";
        }
        else
        {
            $sql = "SELECT nama_barang, harga_barang, stok_barang FROM barang WHERE id_umkm = '$id_umkm' AND nama_barang LIKE '%$keyword%' ORDER BY nama_barang ASC";
        }
        if (($result = $db->query($sql)) === null)
        {
            throw new Exception('Database: Query terjadi kegagalan.', m_item::ITEM_FAILURE);
        }
        $db->close();
        return $result->getResultArray();
    }
}
