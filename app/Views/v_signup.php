<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Portal PoS - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <style>
        .login-form {
            width: 600px;
            margin: 50px auto;
            font-size: 15px;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            width: 400px;
            min-height: 40px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            background-color: #58DD55;
            color: #FFFFFF;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <form action="<?= base_url('signup/send') ?>" method="post">
            <h2 class="text-center">Register</h2>
            <!--Isian-->
            <div class="form-group row">
                <label for="umkmName" class="col-sm-3 col-form-label">Nama UMKM</label>
                <input id="umkmName" name="umkmName" type="text" class="form-control" placeholder="Nama UMKM" required="required">
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                <input id="address" name="address" type="text" class="form-control" placeholder="Alamat" required="required">
            </div>
            <div class="form-group row">
                <label for="phoneNumber" class="col-sm-3 col-form-label">No Telepon</label>
                <input id="phoneNumber" name="phoneNumber" type="text" class="form-control" placeholder="No Telepon" required="required">
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <input id="email" name="email" type="text" class="form-control" placeholder="Email" required="required">
            </div>
            <!--pw-->
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Password" required="required">
            </div>
            <div class="form-group row">
                <label for="confirPassword" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                <input id="confirPassword" type="password" class="form-control" placeholder="Konfirmasi Password" required="required">
            </div>
            <!--Tombol Register-->
            <div class="form-group row">
                <label for="submit" class="col-sm-3 col-form-label"></label>
                <button id="submit" type="submit" class="btn  btn-block float-right">Register</button>
            </div>
            <div>
                <p class="text-center">Sudah punya akun? <a href="<?= base_url('signin') ?>">masuk</a> sekarang</p>
            </div>
        </form>
    </div>
</body>

</html>