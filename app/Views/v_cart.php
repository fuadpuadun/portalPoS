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
                <th style="width:20%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total = 0;
                $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
                foreach ($this->data as $nama_barang => $item)
                {
                    $sub_total = 0;
                    $harga_barang = $item['harga_barang'];
                    $stok_barang = $item['stok_barang'];
                    $jumlah_barang = $item['jumlah_barang'];
                    $sub_total = $item['harga_barang'] * $item['jumlah_barang'];
                    $total += $sub_total;
            ?>
            <tr>
                <td class="align-middle"><a href="<?php echo base_url('removeitemcart/'.$nama_barang); ?>" onclick="return confirm('Hapus barang?')" class="btn btn-danger btn-lg my-1"><i class="fa fa-trash"></i></a></td>
                <td class="align-middle"><h5 class="text-dark"><?php echo $nama_barang; ?></h5></td>                
                <td>
                    <form method="POST" action="<?php echo base_url('cartref'), "?nama_barang=$nama_barang&harga_barang=$harga_barang&stok_barang=$stok_barang"; ?>" class="form-group">
                        <div class="input-group">
                            <input name="jumlah_barang" type="number" class="form-control" min="1" max="<?php echo $stok_barang ?>" value="<?php echo $jumlah_barang; ?>">
                            <button class="btn btn-link" type="submit" name="update"><i class="fa fa-sync-alt"></i></button>
                        </div>
                    </form>
                </td>
                <td class="align-middle"><h5 class="text-dark"><?php echo $formatter->formatCurrency($harga_barang, 'IDR'); ?></h5></td>
                <td class="align-middle"> <h5 class="text-dark"><?php echo $formatter->formatCurrency($sub_total, 'IDR'); ?></h5></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><a class="text-danger font-weight-bold" href="<?php echo base_url('clearcart'); ?>">Hapus Keranjang</a></td>
                <td colspan="2" class="text-right font-weight-bold">Total</td>
                <td> <h5 class="font-weight-bold"><?php echo $formatter->formatCurrency($total, 'IDR'); ?></h5></td>
            </tr>
            <tr>
                <td colspan="2"><a href="<?php echo base_url('item'); ?>" class="btn btn-primary" style=" border:none; background-color:#2D58C7 !important;"><i class="fa fa-angle-left"></i> Tambah produk</a>
                <td colspan="2"></td>
                <td colspan="1"><a href="<?php echo base_url('checkout'); ?>" class="btn btn-primary" style=" border:none; background-color:#58DD55 !important;">Checkout <i class="fa fa-angle-right" ></i></a></td>
        </tfoot>
    </table>
</div>

<?= $this->endSection() ?>