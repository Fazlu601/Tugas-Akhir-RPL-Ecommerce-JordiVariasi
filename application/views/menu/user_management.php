<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
            <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
                <?php endif; ?>

                <a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-plus"></i> Tambah User</a>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr class="bg-gradient-primary" style="color:#fff;">
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Active</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($user_data as $u) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $u['nama']; ?></td>
                                    <td><?= $u['email']; ?></td>
                                    <td><?= $u['role']; ?></td>
                                    <td><?= $u['is_active']; ?></td>
                                    <td>
                                        <a href="<?= base_url('menu/role/') . $u['id_user']; ?>" class="btn btn-warning btn-sm"> <i class="fas fa-fw fa-user"></i> Role</a>
                                        <?php if($u['role'] == 'member') : ?>
                                        <a href="<?= base_url('menu/hapus_user/') . $u['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus user dengan nama ' . $u['nama']; . '?')"><i class="fas fa-fw fa-trash-alt"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    </div>
    </div>
    <!-- End of Main Content -->














    <!-- Modal -->
    <div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSubMenuModalLabel">Tambahkan User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/user') ?>" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="text" class="form-control" name="nama" id="title" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="title" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="title" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password1" id="title" placeholder="Konfirmasi Password">
                        </div>
                        <div class="form-group">
                            <select name="role_id" id="menu_id" class="form-control">
                                <option value="">Select Role</option>
                                <?php foreach ($role_data as $ud) : ?>
                                    <option value="<?= $ud['id']; ?>"><?= $ud['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Aktif?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Menu Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>