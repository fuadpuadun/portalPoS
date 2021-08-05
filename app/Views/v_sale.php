<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Laporan Penjualan</h3>
    <hr>
    <!--Tagihan-->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="text-white" style="background-color:#2D58C7;">
                <th>Waktu</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Detail</th>
            </thead>
            <tbody>
                <?php
                    $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
                    foreach($this->data as $txn) {
                        $txnId = $txn['id_transaksi'];
                        $paymentStatus = $txn['status_pembayaran'];
                        $txnDescription = $txn['keterangan'];
                        $txnDateTime = $txn['tanggal_waktu_transaksi'];
                        $itemAmount = $txn['jumlah_barang'];
                ?>
                <tr>
                    <td><?= $txnDateTime ?></td>
                    <td><?= $itemAmount ?>
                    <td><?= $paymentStatus==0 ? 'Belum Lunas' : 'Lunas' ?></td>
                    <td><?= $txnDescription ?></td>
                    <td><a href="<?= base_url('sale/detail')."?txnId=$txnId" ?>" class="btn btn-link"><i class="fas fa-eye"></i></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>