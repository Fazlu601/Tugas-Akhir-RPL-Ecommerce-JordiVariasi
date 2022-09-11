<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?> Master</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal"><i class="fas fa-plus"></i> Tambah Role Baru</a>

                <table class="table table-hover">
                    <thead>
                        <tr class="bg-gradient-primary" style="color:#fff;">
                            <th scope="col">No.</th>
                            <th scope="col">Role</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($role as $r) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $r['role']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-user"></i> Akses</a>
                                    <a href="#" class="btn btn-success btn-sm"> <i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->











<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambahkan Role Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role') ?>" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" name="role" id="role" placeholder="Role">
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