<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Barang</h3>
    <hr>
    <!--Search bar-->
    <form method="GET" action="<?php echo base_url('home/item'); ?>" class="form-group">
        <div class="input-group mb-4 border rounded-pill p-1">
            <input name="keyword" type="text" placeholder="Mau cari apa..." class="form-control bg-none border-0 font-italic">
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
                <th style="width:20%">Harga Barang</th>
                <th style="width:25%">Stok Barang</th>
                <th style="width:20%"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
                foreach ($this->data as $barang)
                {
            ?>
            <tr>
                <td><h5 class="text-dark"><?php echo $barang['nama_barang']; ?></h5></td> 
                <td><h5 class="text-dark"><?php echo $formatter->formatCurrency($barang['harga_barang'], 'IDR'); ?></h5></td>
                <td><h5 class="text-dark"><?php echo $barang['stok_barang']; ?></h5></td>
                <td><a href="<?php echo base_url('home/cart'); ?>" class="btn btn-primary" style=" border:none; background-color:#58DD55 !important;">Tambah<i class="fa fa-angle-right" ></i></a></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

    <?php if (false) $pager; ?>
</div>

<?= $this->endSection() ?>