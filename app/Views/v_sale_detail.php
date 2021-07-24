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
                <th>Jumlah Barang</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total = 0;
                $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
                foreach ($this->data as $detail_transaksi)
                {
                    $subtotal = 0;
                    $id_transaksi = $detail_transaksi['id_transaksi'];
                    $nama_barang = $detail_transaksi['nama_barang'];
                    $harga_barang = $detail_transaksi['harga_barang'];
                    $jumlah_barang = $detail_transaksi['jumlah_barang'];
                    $status_pembayaran = $detail_transaksi['status_pembayaran'] == 0 ? 'Belum Lunas' : 'Lunas';
                    $keterangan = $detail_transaksi['keterangan'];
                    $tanggal_waktu_transaksi = $detail_transaksi['tanggal_waktu_transaksi'];
                    $subtotal = $harga_barang * $jumlah_barang;
                    $total += $subtotal;
            ?>
            <tr>
                <td><?= $nama_barang ?></td>                
                <td><?= $jumlah_barang ?></td>
                <td><?= $formatter->formatCurrency($harga_barang, 'IDR') ?></td>
                <td><?= $formatter->formatCurrency($subtotal, 'IDR') ?></td> 
            </tr>
            <?php
                }
            ?>
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
                        :&emsp;<?= $tanggal_waktu_transaksi ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status Pembayaran</label>
                    <div class="col-sm-9">
                        :&emsp;<?= $status_pembayaran ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        :&emsp;<?= $keterangan ?>
                    </div>
                </div>
            </form>
        </div> 
    </div>
    <!-- Fitur -->
    <div class="d-flex justify-content-sm-between">
        <a href="<?= base_url('sale'); ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali</a>
        <!-- logic php kalau status belum bayar muncul tombol / jika sudah lunas tidak ada tombol -->
        <a href="<?= base_url('sale_payoff'), "?id_transaksi=$id_transaksi" ?>" class="btn btn-primary">Pelunasan <i class="fa fa-angle-right"></i> </a>
    </div>
</div>

<?= $this->endSection() ?>