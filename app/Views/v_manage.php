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
                        <button id="changeButton" type="button" class="btn btn-primary" data-item-name="<?= $itemName ?>" data-item-price="<?= $itemPrice ?>" data-item-stock="<?= $itemStock ?>" data-item-min-stock="<?= $itemMinStock ?>" data-toggle="modal" style=" border:none; background-color:#676767 !important;" data-target="#changeModal">
                            Ubah <i class="far fa-edit"></i>
                        </button>
                    </td>
                    <!-- Trigger Delete -->
                    <td>
                        <button id="deleteButton" type="button" class="btn btn-primary" data-item-name="<?= $itemName ?>" data-toggle="modal" style=" border:none; background-color:#FF0000 !important;" data-target="#deleteModal">
                            Hapus <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <!-- Modal Change -->
                <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><b id="changeModalLongTitle"></b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ">
                                <form action="<?= base_url('manage/change') ?>" method="post" id="change">
                                    <input type="hidden" class="form-control" name="itemName" id="chageItemName">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="itemPrice" id="chageItemPrice" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" class="form-control" name="itemStock" id="chageItemStock" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Stok Minimal</label>
                                        <input type="number" class="form-control" name="itemMinStock" id="chageItemMinStock" required="required">
                                    </div>
                                </form>
                            </div>
                            <script>
                                $(document).on("click", "#changeButton", function() {
                                    const itemName = $(this).data('item-name');
                                    const itemPrice = $(this).data('item-price');
                                    const itemStock = $(this).data('item-stock');
                                    const itemMinStock = $(this).data('item-min-stock');
                                    $('#chageItemName').val(itemName);
                                    $('#chageItemPrice').val(itemPrice);
                                    $('#chageItemStock').val(itemStock);
                                    $('#chageItemMinStock').val(itemMinStock);
                                    $('#changeModalLongTitle').html(itemName);
                                });
                            </script>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#676767;">Kembali </button>
                                <button form="change" type="submit" class="btn btn-primary" style=" border:none; background-color:#2D58C7;">Lanjutkan</button>
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
                                <form action="<?= base_url('manage/delete') ?>" method="get" id="delete">
                                    <p>Anda akan menghapus data barang <b id="deleteNameDisplay"></b>. Tindakan ini tidak dapat dikembalikan.
                                        </br>Lanjutkan ?</p>
                                    <input type="hidden" name="itemName" id="deleteItemName">
                                </form>
                            </div>
                            <script>
                                $(document).on("click", "#deleteButton", function() {
                                    const itemName = $(this).data('item-name');
                                    $('#deleteItemName').val(itemName);
                                    $('#deleteNameDisplay').html(itemName);
                                });
                            </script>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#676767;">Kembali</button>
                                <button form="delete" type="submit" class="btn btn-primary" style=" border:none; background-color:#FF0000;">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td colspan="2">
                    <button id="addButton" type="button" class="btn btn-primary" data-toggle="modal" style=" border:none; background-color:#2D58C7 !important;" data-target="#addModal">
                        Tambah Barang <i class="fas fa-plus"></i>
                    </button>
                </td>
                <!-- Modal Tambah Barang -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLongTitle">Tambah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ">
                                <form action="<?= base_url('manage/add') ?>" method="post" id="add">
                                    <div class="form-group">
                                        <label>Barang </label>
                                        <input type="text" class="form-control" name="itemName" id="addItemPrice" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="itemPrice" id="addItemPrice" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" class="form-control" name="itemStock" id="addItemStock" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Stok Minimal</label>
                                        <input type="number" class="form-control" name="itemMinStock" id="addItemMinStock" required="required">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#676767;">Kembali</button>
                                <button form="add" type="submit" class="btn btn-primary" style=" border:none; background-color:#2D58C7;">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            </tfoot>
    </table>

    <?= $this->endSection() ?>