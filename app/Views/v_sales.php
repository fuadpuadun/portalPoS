<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Sales</h3>
    <hr>
    <!--Tagihan-->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-danger text-white">
                <th>ID</th>
                <th>TANGGAL</th>
                <th>NAMA</th>
                <th>Email</th>
                <th>HP</th>
                <th>HARGA PESANAN</th>
                <th>STATUS PESANAN</th>
                <th>DETAIL PESANAN</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                if(isset($penjualan)){
                foreach($penjualan as $key => $data) { ?>
                <tr>
                    <td><?php echo $data['idPenjualan']; ?></td>
                    <td><?php echo $data['tglTransaksi']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php echo $data['hp']; ?></td>
                    <td>Rp<?php echo format_rupiah($data['total']); ?>
                    <td><?php if($data['status_pemesanan'] == 1)
                    {
                        echo 'Sudah Bayar';
                    }
                    else{echo 'Belum Bayar';}
                    ?></td>
                    <td><a href="<?php echo base_url('invoice/'.$data['idPenjualan']); ?>" class="btn btn-link"><i class="fas fa-eye"></i></a></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>