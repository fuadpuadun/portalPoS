<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Form Pembayaran</h3>
    <hr>
    <!--Form INSERT-->
    <form action="<?php echo base_url('checkout/proses'); ?>" method="post">
        <div class="form-group row">
            <label for="jumlahJual" class="col-sm-3 col-form-label">Jumlah Penjualan</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama..." required autofocus>
        </div>
        <div>
            <!--radio box lunas / tidak lunas-->
        </div>
        <div class="form-group row">
            <label for="uang" class="col-sm-3 col-form-label">Uang Pelanggan</label>
            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Email..." required autofocus>
        </div>
        <div class="form-group row">
            <label for="kembalian" class="col-sm-3 col-form-label">Kembalian</label>
            <input type="number" name="hp" class="form-control" id="hp" placeholder="+62..." required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Proses</button>
    </form>
</div>

<?= $this->endSection() ?>