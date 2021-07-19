<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Stock Opname</h3>
    <hr>
    <table class="table table-responsive-sm">
        <thead class="text-white" style="background-color:#2D58C7;">
            <tr>
                <th style="width:35%">Nama Barang</th>
                <th style="width:25%">Harga</th>
                <th style="width:20%">Stok</th>
                <th style="width:15%">Update Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($barang as $key => $data) {
                $data['kuantitas']=1;
                ?>
            <tr>
                <td class="align-middle"><h5 class="text-dark"><?php echo $data['namabrg']; ?></h5></td>                
                <td class="align-middle"><h5 class="text-dark">Rp<?php echo format_rupiah($data['harga']); ?></h5></td>    
                <td class="align-middle"><h5 class="text-dark"><?php echo $data['stok']; ?></h5></td>      
                <td>
                    <form method="post" action="<?php echo base_url('updatecart/'.$key); ?>" class="form-group">
                        <div class="input-group">
                            <input type="number" class="form-control" min="1" max="" value="<?php echo $data['kuantitas']; ?>" name="kuantitas">
                        </div>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<?= $this->endSection() ?>