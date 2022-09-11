<div class="container-fluid">
    <h3> <i class="fas fa-fw fa-edit"></i> EDIT DATA BARANG</h3>

    <?php foreach ($barang as $b) : ?>

        <form action="<?= base_url('admin/updateharga'); ?>" method="POST">
            <div class="form-group">
                <label>Kode Harga</label>
                <input type="text" name="kode_harga" class="form-control" value="<?= $b['kode_harga']; ?>">
            </div>
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" value="<?= $b['kode_barang']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga_barang" class="form-control" value="<?= $b['harga']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>

        </form>

    <?php endforeach; ?>
</div>
</div>