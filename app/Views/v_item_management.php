<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Kelola Produk</h3>
    <hr>

    <!--List Barang-->
    <table class="table table-responsive-sm">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th style="width:30%">Nama Barang</th>
                <th style="width:20%">Jumlah Barang</th>
                <th style="width:15%">Harga Barang</th>
                <th style="width:15%"></th>
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
                <td><a href="<?php echo base_url('addtocart/'.$data['kodebrg']); ?>" class="btn btn-primary" style=" border:none; background-color:#676767 !important;">Ubah <i class="far fa-edit" ></i></a></td>
                <td><a href="<?php echo base_url('addtocart/'.$data['kodebrg']); ?>" class="btn btn-primary" style=" border:none; background-color:#FF0000 !important;">Hapus <i class="far fa-trash-alt" ></i></a></td>
            </tr>
            <?php
                }
                ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td colspan="1"><a href="<?php echo base_url('additem'); ?>" class="btn btn-primary" style=" border:none; background-color:#2D58C7 !important;">Tambah Barang <i class="fas fa-plus" ></i></a></td></td>
            </tr>
        </tfoot>
    </table>
</div>

<?= $this->endSection() ?>