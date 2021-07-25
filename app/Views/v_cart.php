<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Keranjang</h3>
    <hr>
    <table class="table table-responsive-sm">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th style="width:10%"></th>
                <th style="width:35%">Barang</th>
                <th style="width:15%">Jumlah</th>
                <th style="width:20%">Harga</th>
                <th style="width:20%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total = 0;
                $cart = $this->data['cart'];
                $info = $this->data['changed'];
                $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                foreach($cart as $itemName => $item) {
                    $itemPrice = $item['itemPrice'];
                    $itemStock = $item['itemStock'];
                    $itemAmount = $item['itemAmount'];
                    $subTotal = $itemPrice*$itemAmount;
                    $total += $subTotal;
            ?>
            <tr>
                <td class="align-middle"><a href="<?= base_url('cart/delete'), "?itemName=$itemName" ?>" class="btn btn-danger btn-lg my-1"><i class="fa fa-trash"></i></a></td>
                <td class="align-middle"><h5 class="text-dark"><?php echo $itemName; ?></h5></td>                
                <td>
                    <form method="get" action="<?= base_url('cart/update') ?>" class="form-group">
                        <div class="input-group">
                            <input name="itemName" type="hidden" value="<?= $itemName ?>"/>
                            <input name="itemAmount" type="number" class="form-control" min="1" max="<?= $itemStock ?>" value="<?= $itemAmount ?>">
                            <button class="btn btn-link" type="submit"><i class="fa fa-sync-alt"></i></button>
                        </div>
                    </form>
                </td>
                <td class="align-middle"><h5 class="text-dark"><?= $formatter->formatCurrency($itemPrice, 'IDR'); ?></h5></td>
                <td class="align-middle"> <h5 class="text-dark"><?= $formatter->formatCurrency($subTotal, 'IDR'); ?></h5></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><a class="text-danger font-weight-bold" href="<?= base_url('cart/delete') ?>">Hapus Keranjang</a></td>
                <td colspan="2" class="text-right font-weight-bold">Total</td>
                <td> <h5 class="font-weight-bold"><?= $formatter->formatCurrency($total, 'IDR') ?></h5></td>
            </tr>
            <tr>
                <td colspan="2"><a href="<?= base_url('item') ?>" class="btn btn-primary" style=" border:none; background-color:#2D58C7 !important;"><i class="fa fa-angle-left"></i> Tambah produk</a>
                <td colspan="2"></td>
                <td colspan="1"><a href="<?= base_url('checkout') ?>" class="btn btn-primary" style=" border:none; background-color:#58DD55 !important;">Checkout <i class="fa fa-angle-right" ></i></a></td>
        </tfoot>
    </table>
</div>

<?= $this->endSection() ?>