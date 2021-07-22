<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class m_penjualan extends Model
{
    protected $table = "penjualan";
    protected $allowedFields = ['idPenjualan','tglTransaksi'.'total','nama','alamat','hp'];

    public function getAllSales()
    {
        $query = $this->db->query("SELECT * FROM penjualan");
        return $query->getResultArray();
    }

    public function insertData($data)
    {
        $totalHarga = $data['totalHarga'];
        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $kecamatanTujuan = $data['kecamatanTujuan'];
        $hp = $data['hp'];
        $tarif = $data['tarif'];
        
        return $this->db->query("INSERT INTO penjualan(total, ongkir, nama, alamat, kecamatanTujuan, hp) VALUES ('$totalHarga','$tarif','$nama','$alamat','$kecamatanTujuan','$hp')");
    }

    public function getSalesBySalesId($idPenjualan)
    {
        $query = $this->db->query("SELECT * FROM penjualan WHERE idPenjualan='$idPenjualan'");
        return $query->getRowArray();
    }
}