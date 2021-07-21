<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Products</h3>
    <hr>
    <!--Search bar-->
    <form method="GET" action="" class="form-group">
        <div class="input-group mb-4 border rounded-pill p-1">
            <input name="cari" type="text" placeholder="Mau cari apa..." class="form-control bg-none border-0 font-italic">
            <div class="input-group-append border-0">
                <button type="submit" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <!--List Barang-->
    <table class="table table-responsive-sm">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th style="width:35%">Nama Barang</th>
                <th style="width:25%">Jumlah Barang</th>
                <th style="width:20%">Harga Barang</th>
                <th style="width:20%"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($barang as $key => $data) {
                
                ?>
            <tr>
                <td><h5 class="text-dark"><?php echo $data['namabrg']; ?></h5></td> 
                <td><h5 class="text-dark"><?php echo $data['stok']; ?></h5></td>
                <td><h5 class="text-dark"><?php echo $data['harga']; ?></h5></td>
                <td><a href="<?php echo base_url('addtocart/'.$data['kodebrg']); ?>" class="btn btn-primary" style=" border:none; background-color:#58DD55 !important;">Tambah ke Keranjang <i class="fa fa-angle-right" ></i></a></td>
            </tr>
            <?php
                }
                ?>
        </tbody>
    </table>

    <?= $pager?>
</div>

<?= $this->endSection() ?>