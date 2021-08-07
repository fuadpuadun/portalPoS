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
                <td><button class="btn btn-primary" style=" border:none; background-color:#676767 !important;" data-record-id="54" data-record-title="Something cool" data-toggle="modal" data-target="#confirm-delete">Ubah <i class="far fa-edit" ></i></button>
                </td>
                <!-- Trigger Delete -->
                <td>
                    <a href="#" class="btn btn-primary btn-delete" style=" border:none; background-color:#FF0000 !important;" data-id="<?= $barang['nama_barang'];?>">Hapus <i class="fas fa-trash"></i></button></a>
                </td>
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
                <td colspan="2"><button class="btn btn-primary" style=" border:none; background-color:#2D58C7" data-record-id="54" data-record-title="Something cool" data-toggle="modal" data-target="#confirm-delete">Tambah Barang <i class="fas fa-plus" ></i></button></td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Modal Update -->

<!-- modal delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLongTitle">Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('manage/delete') ?>" method="post" id="delete">
                                    Anda akan menghapus data barang. Tindakan ini tidak dapat dikembalikan.

                                    Lanjutkan ?
                    <input type="hidden" name="nama_barang" class="nama_barang">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#FF0000;">Batalkan</button>
                <button form="delete" type="submit" class="btn btn-primary" >Lanjutkan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.nama_barang').val(id);
            // Call Modal Delete
            $('#deleteModal').modal('show');
        });
        
    });
</script>

<?= $this->endSection() ?>
</html>