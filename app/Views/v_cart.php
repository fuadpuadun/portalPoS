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
            $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
            foreach ($cart as $itemName => $item) {
                $itemPrice = $item['itemPrice'];
                $itemStock = $item['itemStock'];
                $itemAmount = $item['itemAmount'];
                $subTotal = $itemPrice * $itemAmount;
                $total += $subTotal;
            ?>
                <tr>
                    <td class="align-middle"><a href="<?= base_url('cart/delete') . "?itemName=$itemName" ?>" class="btn btn-danger btn-lg my-1"><i class="fa fa-trash"></i></a></td>
                    <td class="align-middle">
                        <h5 class="text-dark"><?php echo $itemName; ?></h5>
                    </td>
                    <td>
                        <form method="get" action="<?= base_url('cart/update') ?>" class="form-group">
                            <div class="input-group">
                                <input name="itemName" type="hidden" value="<?= $itemName ?>" />
                                <input name="itemAmount" type="number" class="form-control" min="1" max="<?= $itemStock ?>" value="<?= $itemAmount ?>">
                                <button class="btn btn-link" type="submit"><i class="fa fa-sync-alt"></i></button>
                            </div>
                        </form>
                    </td>
                    <td class="align-middle">
                        <h5 class="text-dark"><?= $formatter->formatCurrency($itemPrice, 'IDR') ?></h5>
                    </td>
                    <td class="align-middle">
                        <h5 class="text-dark"><?= $formatter->formatCurrency($subTotal, 'IDR') ?></h5>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><a class="text-danger font-weight-bold" href="<?= base_url('cart/delete') ?>">Hapus Keranjang</a></td>
                <td colspan="2" class="text-right font-weight-bold">Total</td>
                <td>
                    <h5 class="font-weight-bold"><?= $formatter->formatCurrency($total, 'IDR') ?></h5>
                </td>
            </tr>
            <tr>
                <td colspan="2"><a href="<?= base_url('item') ?>" class="btn btn-primary" style=" border:none; background-color:#2D58C7 !important;"><i class="fa fa-angle-left"></i> Tambah produk</a>
                <td colspan="2"></td>
                <td colspan="1">
                    <?php if (!empty($cart) || !empty($info)) { ?>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" style=" border:none; background-color:#58DD55 !important;" data-target="#checkoutModal">
                            Checkout
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="checkoutModalLongTitle">Checkout</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('cart/checkout') ?>" method="post" id="checkout">
                                            <label class="col-form-label">Total:</label>
                                            <p><b><?= $formatter->formatCurrency($total, 'IDR') ?></b></p>
                                            <div class="form-group">
                                                <label for="payment" class="col-form-label">Nilai Pembayaran:</label>
                                                <input type="number" class="form-control" id="payment" min="0" value="0" oninput="getReturn()" required="required">
                                            </div>
                                            <input type="hidden" name="paymentStatus" id="paymentStatus" value="0">
                                            <div class="form-group">
                                                <label for="description" class="col-form-label">Keterangan:</label>
                                                <textarea name="description" class="form-control" id="description" required="required"></textarea>
                                            </div>
                                            <label class="col-form-label">Nilai Kembalian:</label>
                                            <p><b id="returnPayment"></b></p>
                                            <script>
                                                function getReturn() {
                                                    var formatter = new Intl.NumberFormat('id-ID', {
                                                        style: 'currency',
                                                        currency: 'IDR',
                                                        maximumFractionDigits: 0,
                                                    });
                                                    if ((document.getElementById("payment").value - <?= $total ?>) >= 0) {
                                                        document.getElementById("returnPayment").innerHTML = formatter.format(document.getElementById("payment").value - <?= $total ?>);
                                                        document.getElementById("paymentStatus").value = 1;
                                                        return;
                                                    }
                                                    document.getElementById("returnPayment").innerHTML = formatter.format(0);
                                                    document.getElementById("paymentStatus").value = 0;
                                                }
                                            </script>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#FF0000;">Batalkan</button>
                                        <button form="checkout" type="submit" class="btn btn-primary">Lanjutkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<?= $this->endSection() ?>