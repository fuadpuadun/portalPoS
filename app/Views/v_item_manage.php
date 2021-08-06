<!DOCTYPE html>
<html lang="en">
<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Kelola Barang</h3>
    <hr>

    <!--List Barang-->
    <table class="table table-responsive-sm">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th style="width:25%">Barang</th>
                <th style="width:15%">Harga</th>
                <th style="width:15%">Stok Minimum</th>
                <th style="width:15%">Stok</th>
                <th style="width:15%"></th>
                <th style="width:15%"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
                foreach($this->data as $barang) {
                    $itemName = $barang['nama_barang'];
                    $itemPrice = $barang['harga_barang'];
                    $itemStock = $barang['stok_barang'];
                    $itemMinStock = $barang['stok_minimal'];
            ?>
            <tr>
                <td><h5 class="<?= $itemStock<=$itemMinStock ? 'text-danger' : 'text-dark' ?>"><?= $itemName ?></h5></td>
                <td><h5 class="<?= $itemStock<=$itemMinStock ? 'text-danger' : 'text-dark' ?>"><?= $formatter->formatCurrency($itemPrice, 'IDR') ?></h5></td>
                <td><h5 class="<?= $itemStock<=$itemMinStock ? 'text-danger' : 'text-dark' ?>"><?= $itemMinStock ?></h5></td>
                <td><h5 class="<?= $itemStock<=$itemMinStock ? 'text-danger' : 'text-dark' ?>"><?= $itemStock ?></h5></td>
                <!-- Trigger Update -->
                <div class="modal fade" id="confirm-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Ubah Data Barang</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <p>Anda akan mengubah data <b><i class="title"></i></b>, Tahap ini tidak bisa dikembalikan</p>
                                <p>Yakin ingin mengupdate ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger btn-ok" style=" border:none; background-color:#FF0000">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <td><button class="btn btn-primary" style=" border:none; background-color:#676767 !important;" data-record-id="54" data-record-title="Something cool" data-toggle="modal" data-target="#confirm-delete">Ubah <i class="far fa-edit" ></i></button></td>
                <!-- Trigger Delete -->
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modalHapus" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHapus">Konfirmasi Hapus Barang</h4>
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
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <!-- Trigger Tambah Barang -->
                <div class="modal fade" id="confirm-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalAdd">Tambah Barang</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <p>Anda akan menambah data <b><i class="title"></i></b>, Tahap ini tidak bisa diulang</p>
                                <p>Yakin ingin menambah data ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger btn-ok" style=" border:none; background-color:#FF0000">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
                <td><button class="btn btn-primary" style=" border:none; background-color:#2D58C7" data-record-id="54" data-record-title="Something cool" data-toggle="modal" data-target="#confirm-delete">Tambah Barang <i class="fas fa-plus" ></i></button></td>
            </tr>
        </tfoot>
    </table>
</div>

<?= $this->endSection() ?>
</html>