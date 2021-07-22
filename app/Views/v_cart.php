<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Keranjang Belanja</h3>
    <hr>
    <table class="table table-responsive-sm">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th style="width:10%"></th>
                <th style="width:35%">Nama Barang</th>
                <th style="width:15%">Jumlah</th>
                <th style="width:20%">Harga</th>
                <th style="width:20%">Sub Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subHarga = 0;
            $totalHarga = 0;
            if(isset($barang)) {
            foreach($barang as $key => $data) {
                $subHarga =  $data['harga'] * $data['kuantitas'];
                $totalHarga = $totalHarga + $subHarga;
                ?>
            <tr>
                <td class="align-middle"><a href="<?php echo base_url('removeitemcart/'.$key); ?>" onclick="return confirm('Hapus barang?')" class="btn btn-danger btn-lg my-1"><i class="fa fa-trash"></i></a></td>
                <td class="align-middle"><h5 class="text-dark"><?php echo $data['namabrg']; ?></h5></td>                
                <td>
                    <form method="post" action="<?php echo base_url('updatecart/'.$key); ?>" class="form-group">
                        <div class="input-group">
                            <input type="number" class="form-control" min="1" max="" value="<?php echo $data['kuantitas']; ?>" name="kuantitas">
                            <button class="btn btn-link" type="submit" name="update"><i class="fa fa-sync-alt"></i></button>
                        </div>
                    </form>
                </td>
                <td class="align-middle"><h5 class="text-dark">Rp<?php echo $data['harga']; ?></h5></td>
                <td class="align-middle"> <h5 class="text-dark">Rp<?php echo $subHarga; ?></h5></td>
            </tr>
            <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><a  class="text-danger font-weight-bold" href="<?php echo base_url('clearcart'); ?>" onclick="return confirm('Hapus semua barang dalam keranjang?')" >Hapus Isi Keranjang</a></td>
                <td colspan="2" class="text-right font-weight-bold">Total</td>
                <td> <h5 class="font-weight-bold">Rp<?php echo $totalHarga; ?></h5></td>
            </tr>
            <tr>
                <td colspan="2"><a href="<?php echo base_url('beranda'); ?>" class="btn btn-primary" style=" border:none; background-color:#2D58C7 !important;"><i class="fa fa-angle-left"></i> Tambah produk</a>
                <td colspan="2"></td>
                <td colspan="1"><a href="<?php echo base_url('checkout'); ?>" class="btn btn-primary" style=" border:none; background-color:#58DD55 !important;">Checkout <i class="fa fa-angle-right" ></i></a></td>
        </tfoot>
    </table>
</div>

<?= $this->endSection() ?>