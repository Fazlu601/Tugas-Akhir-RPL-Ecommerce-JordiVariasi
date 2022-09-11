<div class="container-fluid">
    <h3 class="mb-5 text-center font-weight-bold text-success text-uppercase">VERIFIKASI STATUS PESANAN</h3>

    <?php foreach ($status as $s) : ?>

        <form action="<?= base_url('admin/update_status_invoice'); ?>" method="POST">
            <div class="form-group" style="margin-left: 40%;">
                <div class="form-group">
                    <input type="text" name="tglDibayar" value="<?= date('l, d-m-Y') ?>" readonly>
                </div>
                <input type="hidden" class="form-control" name="id" value="<?= $s['id']; ?>">
                <select name="status" class="form-control" style="width: 180px;">
                    <option>Sedang diproses</option>
                    <option>Sedang dikirimkan</option>
                    <option>Belum dibayar</option>
                    <option>Selesai</option>
                </select>
            </div>

            <button type="submit" style="width: 300px; margin-left: 34%;" class="btn btn-primary">SIMPAN</button>
            <a href="<?= base_url('admin'); ?>" style="width: 300px; margin-left: 34%;" class="btn btn-secondary mt-2">Kembali</a>

        </form>

    <?php endforeach; ?>
</div>
</div>