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
            foreach ($this->data as $item) {
                $itemName = $item['nama_barang'];
                $itemPrice = $item['harga_barang'];
                $itemStock = $item['stok_barang'];
                $itemMinStock = $item['stok_minimal'];
            ?>
                <tr>
                    <td>
                        <h5 class="<?= $itemStock <= $itemMinStock ? 'text-danger' : 'text-dark' ?>"><?= $itemName ?></h5>
                    </td>
                    <td>
                        <h5 class="<?= $itemStock <= $itemMinStock ? 'text-danger' : 'text-dark' ?>"><?= $formatter->formatCurrency($itemPrice, 'IDR') ?></h5>
                    </td>
                    <td>
                        <h5 class="<?= $itemStock <= $itemMinStock ? 'text-danger' : 'text-dark' ?>"><?= $itemMinStock ?></h5>
                    </td>
                    <td>
                        <h5 class="<?= $itemStock <= $itemMinStock ? 'text-danger' : 'text-dark' ?>"><?= $itemStock ?></h5>
                    </td>
                    <!-- Trigger Change -->
                    <td>
                        <button id="change" type="button" class="btn btn-primary" data-item-name="<?= $itemName ?>" data-toggle="modal" style=" border:none; background-color:#676767 !important;" data-target="#changeModal">
                            Ubah <i class="far fa-edit"></i>
                        </button>
                    </td>
                    <!-- Trigger Delete -->
                    <td>
                        <button id="delete" type="button" class="btn btn-primary" data-item-name="<?= $itemName ?>" data-toggle="modal" style=" border:none; background-color:#FF0000 !important;" data-target="#deleteModal">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <!-- Modal Change -->
                <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changeModalLongTitle">Ubah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Mengubah sedang dikembangkan...</p>
                            </div>
                            </script>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#FF0000;">Batalkan</button>
                                <button form="change" type="submit" class="btn btn-primary">Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            <tr>
                <!-- Modal delete -->
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
                                    <p>Anda akan menghapus data barang. Tindakan ini tidak dapat dikembalikan. Lanjutkan ?</p>
                                    <input type="hidden" name="itemName" id="itemName">
                                </form>
                            </div>
                            <script>
                                $(document).on("click", "#delete", function() {
                                    const itemName = $(this).data('item-name');
                                    $('#itemName').val(itemName);
                                });
                            </script>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#FF0000;">Batalkan</button>
                                <button form="delete" type="submit" class="btn btn-primary">Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td colspan="2">
                    <button id="add" type="button" class="btn btn-primary" data-toggle="modal" style=" border:none; background-color:#2D58C7 !important;" data-target="#addModal">
                        Tambah Barang <i class="fas fa-plus"></i>
                    </button>
                </td>
                <!-- Modal Tambah Barang -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            </tr>
            </tfoot>
    </table>

    <?= $this->endSection() ?>