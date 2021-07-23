<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class m_sale extends Model
{
    public const SALE_FAILURE = 1;

    public function get_sale(string $id_umkm)
    {
        $db = db_connect();
        $sql = "SELECT transaksi.id_transaksi, penjualan.nama_barang,
                penjualan.harga_barang, penjualan.jumlah_barang,
                transaksi.status_pembayaran, transaksi.keterangan,
                transaksi.tanggal_waktu_transaksi
                FROM transaksi
                INNER JOIN penjualan
                ON (transaksi.id_umkm = '$id_umkm'
                AND transaksi.id_transaksi = penjualan.id_transaksi)";
        if (($result = $db->query($sql)) === null)
        {
            throw new Exception('Database: Sale terjadi kegagalan.', m_sale::SALE_FAILURE);
        }
        $db->close();
        return $result->getResultArray();
    }
}
