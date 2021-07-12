<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>portalPoS - Login</title>
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
            .form-control, .btn {
                width: 400px;
                min-height: 40px;
                border-radius: 2px;
            }
            .btn {        
                font-size: 15px;
                background-color:#58DD55; 
                color: #FFFFFF;
            }
        </style>
    </head>
    <body>
        <div class="login-form">
            <form action="/examples/actions/confirmation.php" method="post">
                <h2 class="text-center">Register</h2>
                <!--Isian-->      
                <div class="form-group row">
                <label for="staticNamaUMKM" class="col-sm-3 col-form-label">Nama UMKM</label>
                    <input type="text" class="form-control" placeholder="Nama UMKM" required="required">
                </div>
                <div class="form-group row">
                <label for="staticAlamat" class="col-sm-3 col-form-label">Alamat</label>
                    <input type="text" class="form-control" placeholder="Alamat" required="required">
                </div>
                <div class="form-group row">
                <label for="staticNoHp" class="col-sm-3 col-form-label">No Hp</label>
                    <input type="text" class="form-control" placeholder="No Hp" required="required">
                </div>
                <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <input type="text" class="form-control" placeholder="Email" required="required">
                </div>
                <!--pw-->
                <div class="form-group row">
                <label for="pw" class="col-sm-3 col-form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" required="required">
                </div>
                <div class="form-group row">
                <label for="konfirmPw" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" placeholder="Konfirmasi Password" required="required">
                </div>
                <!--Tombol Register-->
                <div class="form-group" >
                    <button type="submit" class="btn  btn-block float-right">Register</button>
                </div>
                <div class="clearfix">
                    <p class="text-center">Sudah punya akun ? <a href="//renol">masuk</a> sekarang</p>
                </div>        
            </form>
        </div>
    </body>
</html>