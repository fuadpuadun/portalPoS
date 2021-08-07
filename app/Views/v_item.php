<?= $this->extend('v_template') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Barang</h3>
    <hr>
    <!--Search bar-->
    <form method="get" action="<?= base_url('item/search') ?>" class="form-group">
        <div class="input-group mb-4 border rounded-pill p-1">
            <input name="keyword" type="text" placeholder="Mau cari apa..." class="form-control bg-none border-0 font-italic">
            <div class="input-group-append border-0">
                <button type="submit" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <!--List Barang-->
    <table class="table table-responsive-sm">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th style="width:35%">Barang</th>
                <th style="width:20%">Harga</th>
                <th style="width:25%">Stok</th>
                <th style="width:20%"></th>
                <th style="width:20%"></th>
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
            ?>
                <tr>
                    <td>
                        <h5 class="text-dark"><?= $itemName ?></h5>
                    </td>
                    <td>
                        <h5 class="text-dark"><?= $formatter->formatCurrency($itemPrice, 'IDR') ?></h5>
                    </td>
                    <td>
                        <h5 class="text-dark"><?= $itemStock; ?></h5>
                    </td>
                    <td>
                        <a href="<?= base_url('cart') . "?itemName=$itemName"; ?>" class="btn btn-primary" style=" border:none; background-color:#58DD55 !important;">Tambah <i class="fa fa-angle-right"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php if (false) $pager; ?>
</div>

<?= $this->endSection() ?>