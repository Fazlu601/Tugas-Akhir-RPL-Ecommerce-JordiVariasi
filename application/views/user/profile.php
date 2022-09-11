<div class="container-fluid mb-5">
<div class="card  text-center">
    <div class="card-header bg-gradient-warning">
        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" width="180px" height="180px" class="img-profile rounded-circle mx-auto d-block">
        <a href="<?= base_url('user/edit'); ?>" class="btn btn-primary mx-auto m-3" style="width: 150px; border-radius:30px">Edit Profile</a>
    </div>
        <div class="card-body">
        <h5 class="card-title h4 font-weight-bold text-uppercase text-gray-900">Nama</h5>
        <p class="card-text h5 mb-3"><?= $user['nama']; ?></p>
        <hr class="sidebar-divider d-none d-md-block mt-3">
        <h5 class="card-title h4 font-weight-bold text-uppercase text-gray-900">Email</h5>
        <p class="card-text h5 mb-3"><?= $user['email']; ?></p>
        <hr class="sidebar-divider d-none d-md-block mt-3">
        <h5 class="card-title h4 font-weight-bold text-uppercase text-gray-900">No Telepon</h5>
        <p class="card-text h5 mb-3"><?= $user['no_telp']; ?></p>
        <hr class="sidebar-divider d-none d-md-block mt-3">
        <h5 class="card-title h4 font-weight-bold text-uppercase text-gray-900">Alamat</h5>
        <p class="card-text h5 mb-3"><?= $user['alamat']; ?></p>
        <div class="card-footer text-muted">
            <?php if($user['role_id'] == 1) : ?>
                <h6 class="text-gray-900">Admin sejak <?= date('d F Y', $user['created_at']); ?> </h6>
                <?php else : ?>
                    <h6 class="text-gray-900">Member sejak <?= date('d F Y', $user['created_at']); ?> </h6>
                    <?php endif; ?>
        </div>
        </div>
</div>
</div>
