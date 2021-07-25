<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Laporan Penjualan</h3>
    <hr>
    <!--Tagihan-->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="text-white" style="background-color:#2D58C7;">
                <th>Tanggal & Waktu Transaksi</th>
                <th>Jumlah Barang</th>
                <th>Status Pembayaran</th>
                <th>Keterangan</th>
                <th>Detail</th>
            </thead>
            <tbody>
                <?php
                    $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
                    foreach ($this->data as $penjualan)
                    {
                        $id_transaksi = $penjualan['id_transaksi'];
                        $status_pembayaran = $penjualan['status_pembayaran'] == 0 ? 'Belum Lunas' : 'Lunas';
                        $keterangan = $penjualan['keterangan'];
                        $tanggal_waktu_transaksi = $penjualan['tanggal_waktu_transaksi'];
                        $jumlah_barang = $penjualan['jumlah_barang'];
                ?>
                <tr>
                    <td><?php echo $tanggal_waktu_transaksi; ?></td>
                    <td><?php echo $jumlah_barang; ?>
                    <td><?php echo $status_pembayaran ?></td>
                    <td><?php echo $keterangan ?></td>
                    <td><a href="<?php echo base_url('sale_detail'), "?id_transaksi=$id_transaksi"; ?>" class="btn btn-link"><i class="fas fa-eye"></i></a></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>