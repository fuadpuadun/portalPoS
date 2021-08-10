<!DOCTYPE html>
<?= $this->extend('v_template') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <h3 class="panel-title">Informasi Akun</h3>
    <hr>
    <?php
    $umkmId = $this->data['id_umkm'];
    $email = $this->data['email'];
    $umkmName = $this->data['nama_umkm'];
    $phoneNumber = $this->data['notelp'];
    $address = $this->data['alamat'];
    ?>
    <h4 class="text-center p-4"><b><?= $umkmName ?></b></h4>
    <table class="table table-user-information">
        <tbody>
            <tr>
                <td>ID</td>
                <td><?= $umkmId ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?= str_repeat('*', strlen($umkmId)) ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $email ?></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td><?= $phoneNumber ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $address ?></td>
            </tr>
        </tbody>
    </table>
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-sm">
            </div>
            <div class="">
                <button type="button" class="btn btn-primary" data-toggle="modal" style=" border:none; background-color:#676767 !important;" data-target="#changeProfileModal">
                    Update Profil <i class="far fa-edit"></i>
                </button>
                <!-- Modal Profile -->
                <div class="modal fade" id="changeProfileModal" tabindex="-1" role="dialog" aria-labelledby="changeProfileModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changeProfileModalLongTitle">Ubah Profil</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('account/change/profile') ?>" method="post" id="changeProfile">
                                    <div class="form-group">
                                        <label for="umkmName" class="col-form-label">Nama UMKM:</label>
                                        <input name="umkmName" type="text" class="form-control" id="umkmName" required="required" value="<?= $umkmName ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email:</label>
                                        <input name="email" type="text" class="form-control" id="email" required="required" value="<?= $email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNumber" class="col-form-label">No Telepon:</label>
                                        <input name="phoneNumber" type="number" class="form-control" id="phoneNumber" required="required" value="<?= $phoneNumber ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-form-label">Alamat:</label>
                                        <textarea name="address" class="form-control" id="address" required="required"><?= $address ?></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button id="cancleChangeProfile" type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#676767;">Kembali</button>
                                <script>
                                    $('#cancleChangeProfile').on('click', function() {
                                        $('#changeProfile').trigger('reset');
                                    });
                                </script>
                                <button form="changeProfile" type="submit" class="btn btn-primary" style=" border:none; background-color:#2D58C7;">Update Data</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" style=" border:none; background-color:#676767 !important;" data-target="#changePasswordModal">
                    Ganti Password <i class="far fa-edit"></i>
                </button>
                <!-- Modal Password -->
                <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changePasswordModalLongTitle">Ubah Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('account/change/password') ?>" method="post" id="changePassword">
                                    <div class="form-group">
                                        <label for="changePasswordPassword" class="col-form-label">Password:</label>
                                        <input id="changePasswordPassword" name='password' type="password" class="form-control" placeholder="Password" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="changePasswordNewPassword" class="col-form-label">Password Baru:</label>
                                        <input id="changePasswordNewPassword" oninput="confirmPassword()" name='newPassword' type="password" class="form-control" placeholder="Password" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="changePasswordConfirmPassword" class="col-form-label">Konfirmasi Password:</label>
                                        <input id="changePasswordConfirmPassword" oninput="confirmPassword()" type="password" class="form-control" placeholder="Password" required="required">
                                    </div>
                                </form>
                                <script>
                                    function confirmPassword() {
                                        if (document.getElementById('changePasswordNewPassword').value == document.getElementById('changePasswordConfirmPassword').value) {
                                            document.getElementById('submitChangePassword').disabled = false;
                                            return;
                                        }
                                        document.getElementById('submitChangePassword').disabled = true;
                                    }
                                </script>
                            </div>
                            <div class="modal-footer">
                                <button id="cancleChangePassword" type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#676767;">Kembali</button>
                                <script>
                                    $('#cancleChangePassword').on('click', function() {
                                        $('#changePassword').trigger('reset');
                                    });
                                </script>
                                <button id="submitChangePassword" form="changePassword" type="submit" class="btn btn-primary" style=" border:none; background-color:#2D58C7;">Ubah Password</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" style=" border:none; background-color:#FF0000 !important;" data-target="#deleteModal">
                    Hapus Akun <i class="fas fa-trash"></i>
                </button>
                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLongTitle">Hapus Akun</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('account/delete') ?>" method="post" id="delete">
                                    <p>Apakah anda yakin akan menghapus akun <b><?= $umkmName ?></b>. Akun tidak lagi dapat dikembalikan setelah dihapus, masukkan password untuk melanjutkan?</p>
                                    <input name='password' type="password" class="form-control" placeholder="Password" required="required">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button id="cancleDelete" type="button" class="btn btn-secondary" data-dismiss="modal" style=" border:none; background-color:#676767;">Kembali</button>
                                <script>
                                    $('#cancleDelete').on('click', function() {
                                        $('#delete').trigger('reset');
                                    });
                                </script>
                                <button form="delete" type="submit" class="btn btn-primary" style=" border:none; background-color:#FF0000;">Hapus </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>