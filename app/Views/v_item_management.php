<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Kelola Barang</h3>
    <hr>

    <!--List Barang-->
    <table class="table table-responsive-sm">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th style="width:30%">Nama Barang</th>
                <th style="width:15%">Harga Barang</th>
                <th style="width:20%">Jumlah Barang</th>
                <th style="width:15%"></th>
                <th style="width:20%"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
                foreach ($this->data as $barang)
                {
                    $nama_barang = $barang['nama_barang'];
                    $harga_barang = $barang['harga_barang'];
                    $stok_barang = $barang['stok_barang'];
            ?>
            <tr>
                <td><h5 class="text-dark"><?php echo $nama_barang; ?></h5></td>
                <td><h5 class="text-dark"><?php echo $harga_barang; ?></h5></td>
                <td><h5 class="text-dark"><?php echo $stok_barang; ?></h5></td>
                <!-- Trigger button modal -->
                <td><a href="<?php echo base_url('addtocart/'); ?>" class="btn btn-primary" style=" border:none; background-color:#676767 !important;">Ubah <i class="far fa-edit" ></i></a></td>
                <!-- Trigger Delete -->
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Barang</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <p>Anda akan menghapus data <b><i class="title"></i></b>, Tahap ini tidak bisa dikembalikan</p>
                                <p>Yakin ingin menghapus ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger btn-ok" style=" border:none; background-color:#FF0000">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <td><button class="btn btn-primary" style=" border:none; background-color:#FF0000" data-record-id="54" data-record-title="Something cool" data-toggle="modal" data-target="#confirm-delete">Hapus <i class="far fa-trash-alt" ></i></button></td>
            </tr>
            <?php
                }
                ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td colspan="1"><a href="<?php echo base_url('additem'); ?>" class="btn btn-primary" style=" border:none; background-color:#2D58C7">Tambah Barang <i class="fas fa-plus" ></i></a></td></td>
            </tr>
        </tfoot>
    </table>
</div>

<?= $this->endSection() ?>