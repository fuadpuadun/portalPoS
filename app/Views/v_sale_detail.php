<?= $this->extend('v_template') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Penjualan</h3>
    <hr>
    <!-- Barang -->
    <table class="table table-responsive-sm table-hover">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
            $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
            foreach ($this->data as $txn) {
                $subTotal = 0;
                $txnId = $txn['id_transaksi'];
                $itemName = $txn['nama_barang'];
                $itemPrice = $txn['harga_barang'];
                $itemAmount = $txn['jumlah_barang'];
                $paymentStatus = $txn['status_pembayaran'];
                $itemDescription = $txn['keterangan'];
                $txnDateTime = $txn['tanggal_waktu_transaksi'];
                $subTotal = $itemPrice * $itemAmount;
                $total += $subTotal;
            ?>
                <tr>
                    <td><?= $itemName ?></td>
                    <td><?= $itemAmount ?></td>
                    <td><?= $formatter->formatCurrency($itemPrice, 'IDR') ?></td>
                    <td><?= $formatter->formatCurrency($subTotal, 'IDR') ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot class="font-weight-bold">
            <tr>
                <td colspan="3" class="text-right">Total</td>
                <td><?= $formatter->formatCurrency($total, 'IDR') ?></td>
            </tr>
        </tfoot>
    </table>

    <!-- Atribut Penjualan -->
    <div class="card my-5 border-0 shadow-lg bg-white rounded">
        <div class="card-body">
            <hr>
            <form>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal & Waktu Transaksi</label>
                    <div class="col-sm-9">
                        <?= $txnDateTime ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status Pembayaran</label>
                    <div class="col-sm-9">
                        <?= $paymentStatus == 0 ? 'Belum Lunas' : 'Lunas' ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <?= $itemDescription ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fitur -->
    <div class="d-flex justify-content-sm-between">
        <a href="<?= base_url('sale') ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali</a>
        <!-- logic php kalau status belum bayar muncul tombol / jika sudah lunas tidak ada tombol -->
        <?php if ($paymentStatus == 0) { ?>
            <a href="<?= base_url('sale/payoff') . "?txnId=$txnId" ?>" class="btn btn-primary">Pelunasan <i class="fa fa-angle-right"></i> </a>
        <?php } ?>
    </div>
</div>

<?= $this->endSection() ?>