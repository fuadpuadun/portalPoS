<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\m_signin;

class m_sale extends Model
{
    private $signin;
    private $database;

    function __construct()
    {
        $this->signin = new m_signin();
        $this->database = db_connect();
    }

    public function getYearList()
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "SELECT DISTINCT YEAR(tanggal_waktu_transaksi) AS tahun
                FROM transaksi
                WHERE id_umkm = $umkmId
                AND YEAR(tanggal_waktu_transaksi) = YEAR(tanggal_waktu_transaksi)";
        return $this->database->query($sql)->getResultArray();
    }

    public function getMonthList(int $year = 0)
    {
        if ($year == 0)
            return [];
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "SELECT DISTINCT MONTH(tanggal_waktu_transaksi) AS bulan
                FROM transaksi
                WHERE id_umkm = $umkmId
                AND YEAR(tanggal_waktu_transaksi) = $year";
        $result = $this->database->query($sql)->getResultArray();
        $ret = [];
        foreach ($result as $index => $row) {
            $monthIndex = $row['bulan'];
            switch ($monthIndex) {
                case 1:
                    $month = 'Januari';
                    break;
                case 2:
                    $month = 'Februari';
                    break;
                case 3:
                    $month = 'Maret';
                    break;
                case 4:
                    $month = 'April';
                    break;
                case 5:
                    $month = 'Mei';
                    break;
                case 6:
                    $month = 'Juni';
                    break;
                case 7:
                    $month = 'Juli';
                    break;
                case 8:
                    $month = 'Agustus';
                    break;
                case 9:
                    $month = 'September';
                    break;
                case 10:
                    $month = 'Oktober';
                    break;
                case 11:
                    $month = 'November';
                    break;
                case 12:
                    $month = 'Desember';
                    break;
            }
            $ret[$monthIndex] = $month;
        }
        return $ret;
    }

    public function getCurrentYear()
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "SELECT MAX(YEAR(tanggal_waktu_transaksi)) AS tahun
                FROM transaksi
                WHERE id_umkm = $umkmId";
        $result = $this->database->query($sql);
        if ($result->getNumRows() == 0)
            return null;
        $year = $result->getResultArray()[0]['tahun'];
        return $year == null ? 0 : $year;
    }

    public function getSale(int $year = 0, int $month = 0)
    {
        if ($year == 0)
            return [];
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        if ($month == 0) {
            $sql = "SELECT (SELECT MONTH(MAX(tanggal_waktu_transaksi))
                    FROM transaksi WHERE id_umkm = $umkmId
                    AND YEAR(tanggal_waktu_transaksi) = $year) AS bulan
                    FROM transaksi
                    WHERE id_umkm = $umkmId
                    AND YEAR(tanggal_waktu_transaksi) = $year";
            $result = $this->database->query($sql);
            if ($result->getNumRows() == 0)
                return [];
            $month = $result->getResultArray()[0]['bulan'];
        }
        $sql = "SELECT *, (SELECT SUM(jumlah_barang)
                FROM penjualan
                WHERE id_transaksi = transaksi.id_transaksi) AS jumlah_barang
                FROM transaksi
                WHERE id_umkm = $umkmId
                AND MONTH(tanggal_waktu_transaksi) = $month
                AND YEAR(tanggal_waktu_transaksi) = $year
                ORDER BY tanggal_waktu_transaksi DESC";
        $result = $this->database->query($sql);
        return $result->getResultArray();
    }

    public function getTxn(int $txnId)
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "SELECT transaksi.id_transaksi, penjualan.nama_barang,
                penjualan.harga_barang, penjualan.jumlah_barang,
                transaksi.status_pembayaran, transaksi.keterangan,
                transaksi.tanggal_waktu_transaksi
                FROM transaksi
                INNER JOIN penjualan
                ON (transaksi.id_transaksi = penjualan.id_transaksi
                AND transaksi.id_umkm = $umkmId
                AND transaksi.id_transaksi = $txnId)
                ORDER BY transaksi.tanggal_waktu_transaksi DESC";
        $result = $this->database->query($sql);
        return $result->getResultArray();
    }

    public function payoff(int $txnId)
    {
        $auth = $this->signin->getAuth();
        $umkmId = $auth['umkmId'];
        $sql = "UPDATE transaksi
                SET status_pembayaran = 1
                WHERE id_umkm = $umkmId
                AND id_transaksi = $txnId";
        $this->database->simpleQuery($sql);
    }

    function __destruct()
    {
        $this->database->close();
    }
}
