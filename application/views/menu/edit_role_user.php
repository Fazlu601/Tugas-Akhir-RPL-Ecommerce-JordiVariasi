<div class="container-fluid">
    <h3> <i class="fas fa-fw fa-edit"></i> EDIT STATUS PEMBAYARAN</h3>

    <?php foreach ($user_data as $s) : ?>

        <form action="<?= base_url('admin/update_role_user'); ?>" method="POST">
            <div class="form-group">
                <label><?= $user_data['nama']; ?></label>
                <input type="hidden" class="form-control" name="id_user" value="<?= $s['id_user']; ?>">
                <select name="role_id" class="form-control" style="width: 180px;">
                    <option value="<?= $role_data['id'] ?>"> <?= $role_id['role']; ?></option>
                    <option>Belum dibayar</option>
                </select>
            </div>
            <div class="form-group">
                <label>Status</label>
                <input type="hidden" class="form-control" name="id_user" value="<?= $s['id_user']; ?>">
                <select name="role_id" class="form-control" style="width: 180px;">
                    <option value="<?= $role_data['id'] ?>"> <?= $role_id['role']; ?></option>
                    <option>Belum dibayar</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>

        </form>

    <?php endforeach; ?>
</div>
</div>