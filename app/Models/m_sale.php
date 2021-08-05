<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\m_signin;

class m_sale extends Model {
    private $signin;
    private $database;

    function __construct() {
		$this->signin = new m_signin();
        $this->database = db_connect();
	}

    public function getSale() {
        $auth = $this->signin->getAuth();
        $idUmkm = $auth['idUmkm'];
        $sql = "SELECT *, (SELECT SUM(jumlah_barang)
                FROM penjualan
                WHERE id_transaksi = transaksi.id_transaksi)
                AS jumlah_barang
                FROM transaksi
                WHERE id_umkm = '$idUmkm'
                ORDER BY tanggal_waktu_transaksi DESC";
        $result = $this->database->query($sql);
        return $result->getResultArray();
    }

    public function getTxn(string $txnId) {
        $auth = $this->signin->getAuth();
        $idUmkm = $auth['idUmkm'];
        $sql = "SELECT transaksi.id_transaksi, penjualan.nama_barang,
                penjualan.harga_barang, penjualan.jumlah_barang,
                transaksi.status_pembayaran, transaksi.keterangan,
                transaksi.tanggal_waktu_transaksi
                FROM transaksi
                INNER JOIN penjualan
                ON (transaksi.id_transaksi = penjualan.id_transaksi
                AND transaksi.id_umkm = '$idUmkm'
                AND transaksi.id_transaksi = '$txnId')
                ORDER BY transaksi.tanggal_waktu_transaksi DESC";
        $result = $this->database->query($sql);
        return $result->getResultArray();
    }

    public function payoff(string $txnId) {
        $auth = $this->signin->getAuth();
        $idUmkm = $auth['idUmkm'];
        $sql = "UPDATE transaksi
                SET status_pembayaran = 1
                WHERE id_umkm = '$idUmkm'
                AND id_transaksi = '$txnId'";
        $this->database->simpleQuery($sql);
    }

    function __destruct() {
        $this->database->close();
    }
}