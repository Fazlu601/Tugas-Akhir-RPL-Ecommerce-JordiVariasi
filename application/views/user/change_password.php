 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

<div class="row">
    <div class="col-lg-6">
        <form action="<?= base_url('user/ubah_password') ?>" method="POST">
                <div class="form-group">
                    <label for="currentPassword">Password</label>
                    <input type="password" name="currentPassword" class="form-control" id="currentPassword">
                    <?= form_error('currentPassword', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="newPassword1">Password Baru</label>
                    <input type="password" id="newPasssword1" name="newPassword1" class="form-control">
                    <?= form_error('newPassword1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="repeatPassword">Konfirmasi Password</label>
                    <input type="password" id="repeatPassword" name="newPassword2" class="form-control">
                    <?= form_error('newPassword2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                </div>
        </form>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->