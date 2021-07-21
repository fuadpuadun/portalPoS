<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Sales Detail</h3>
    <hr>
    <!-- Barang -->
    <table class="table table-responsive-sm table-hover">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Sub Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subHarga = 0;
            $subBerat = 0;
            $totalHarga = 0;
            $totalBerat = 0;
            if(isset($jual)){
            foreach($jual as $key => $data) {
                $subHarga =  $data['harga'] * $data['jumlah'];
                $subBerat =  $data['berat'] * $data['jumlah'];
                $totalHarga = $totalHarga + $subHarga;
                $totalBerat = $totalBerat + $subBerat;
                ?>
            <tr>
                <td><?php echo $data['namabrg']; ?></td>                
                <td><?php echo $data['jumlah']; ?> pcs</td>
                <td>Rp<?php echo format_rupiah($data['harga']); ?></td>
                <td>Rp<?php echo format_rupiah($subHarga); ?></td> 
            </tr>
            <?php }} ?>
        </tbody>
        <tfoot class="font-weight-bold">
            <tr>
                <td colspan="3" class="text-right">Total Harga Barang</td>
                <td>Rp<?php echo format_rupiah($totalHarga); ?></td>
                <!--<td><?php echo $totalBerat; ?> kg</td>-->
            </tr>
        </tfoot>
    </table>
    <!-- Atribut Penjualan -->
    <div class="card my-5 border-0 shadow-lg bg-white rounded">
        <div class="card-body">
            <hr>
            <form>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal & Waktu Penjualan</label>
                    <div class="col-sm-9">
                        :&emsp;<?php echo $penjualan['tglTransaksi']?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status Penjualan</label>
                    <div class="col-sm-9">
                        :&emsp;<?php if($penjualan['status_pemesanan'] == 1)
                    {
                        echo 'Sudah Lunas';
                    }
                    else{echo 'Belum Lunas';}
                    ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        :&emsp;<?php echo $penjualan['alamat']?>
                    </div>
                </div>
            </form>
        </div> 
    </div>
    <!-- Fitur -->
    <div class="d-flex justify-content-sm-between">
        <a href="<?php echo base_url('invoice'); ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali</a>
        <!-- logic php kalau status belum bayar muncul tombol / jika sudah lunas tidak ada tombol -->
        <a href="<?php echo base_url('invoice'); ?>" class="btn btn-primary">Pelunasan <i class="fa fa-angle-right"></i> </a>
    </div>
</div>

<?= $this->endSection() ?>