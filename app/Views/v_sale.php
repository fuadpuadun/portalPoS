<?= $this->extend('v_template') ?>
<?= $this->section('content') ?>

<style>
    .btn-group {
        padding-bottom: 10px;
    }
</style>

<div class="container my-5">
    <h3>Laporan Penjualan</h3>
    <hr>
    <!--Tagihan-->
    <div class="table-responsive">
        <div class="btn-group" role="group">
            <div class="btn-group" role="group">
                <button id="dateButton" type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bulan
                </button>
                <div class="dropdown-menu">
                    <?php
                    $year = $this->data['year'];
                    foreach ($this->data['monthList'] as $monthIndex => $month) {
                    ?>
                        <a class="dropdown-item" href="<?= base_url('sale') . "?month=$monthIndex&year=$year" ?>"><?= $month ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="btn-group" role="group">
                <button id="yearButton" type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tahun
                </button>
                <div class="dropdown-menu">
                    <?php
                    foreach ($this->data['yearList'] as $time) {
                        $year = $time['tahun'];
                    ?>
                        <a class="dropdown-item" href="<?= base_url('sale') . "?year=$year" ?>"><?= $year ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        // $timeList = $this->data['timeList'];
        // foreach ($this->data['timeList'] as $year) {
        //     echo '<pre>';
        //     var_export($this->data['timeList']);
        //     echo '</pre>';
        ?>
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
                $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
                foreach ($this->data['sale'] as $txn) {
                    $txnId = $txn['id_transaksi'];
                    $paymentStatus = $txn['status_pembayaran'];
                    $txnDescription = $txn['keterangan'];
                    $txnDateTime = $txn['tanggal_waktu_transaksi'];
                    $itemAmount = $txn['jumlah_barang'];
                ?>
                    <tr>
                        <td id="dateTime<?= $txnId ?>"></td>
                        <script>
                            var dateTime = new Date('<?= $txnDateTime ?> UTC');
                            var options = {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                second: 'numeric',
                                timeZoneName: 'short'
                            };
                            document.getElementById('dateTime<?= $txnId ?>').innerHTML = dateTime.toLocaleString('id-ID', options);
                        </script>
                        <td><?= $itemAmount ?>
                        <td><?= $paymentStatus == 0 ? 'Belum Lunas' : 'Lunas' ?></td>
                        <td><?= $txnDescription ?></td>
                        <td><a href="<?= base_url('sale/detail') . "?txnId=$txnId" ?>" class="btn btn-link"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>