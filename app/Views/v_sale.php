<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Penjualan</h3>
    <hr>
    <!--Tagihan-->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="text-white" style="background-color:#2D58C7;">
                <th>Tanggal & Waktu Transaksi</th>
                <th>Jumlah Penjualan</th>
                <th>Status Penjualan</th>
                <th>Keterangan</th>
                <th>Detail</th>
            </thead>
            <tbody>
                <?php
                if(isset($penjualan)){
                foreach($penjualan as $key => $data) { ?>
                <tr>
                    <td><?php echo 'HELLO'; ?></td>
                    <td>Rp<?php echo 'HELLO'; ?>
                    <td><?php if(1 == 1)
                    {
                        echo 'Sudah Bayar';
                    }
                    else{echo 'Belum Bayar';}
                    ?></td>
                    <td>Borongan Tetangga</td>
                    <td><a href="<?php echo base_url('invoice/'); ?>" class="btn btn-link"><i class="fas fa-eye"></i></a></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>