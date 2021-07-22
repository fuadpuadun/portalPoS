<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

        <style>
            .navbar {
                background-color: #2D58C7;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow">
            <div class="container-fluid">
                <a class="navbar-brand font-weight-bold" href="<?php echo base_url('beranda'); ?>">
                    <img src="<?= base_url('web/logo.png') ?>" width="50" class="img-thumbnail">
                    portalPoS
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href= "<?php echo base_url('item'); ?>">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href= "<?php echo base_url('cart'); ?>">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href= "<?php echo base_url(''); ?>">Laporan Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href= "<?php echo base_url(''); ?>">Kelola Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href= "<?php echo base_url(''); ?>">Kelola Akun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href= "<?php echo base_url(''); ?>">Keluar</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!--Enable Code dibawah buat menampilkan template header&footer-->
        <div class="pt-5">
        <?= $this->renderSection('content') ?>
        </div>

        <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <hr class="bg-secondary">
            <div class="col-md-12 text-center text-white">
                <p>
                    <small class="block">&copy; 2021 | All Rights Reserved.</small> 
                    <small class="block">Powered by  KoTA 209</small>
                </p>
            </div>
        </div>
    </footer>

    </body>
</html>