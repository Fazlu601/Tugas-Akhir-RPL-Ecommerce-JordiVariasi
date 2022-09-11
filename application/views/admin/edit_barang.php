<div class="container-fluid">
    <h3> <i class="fas fa-fw fa-edit"></i> EDIT DATA BARANG</h3>

    <?php foreach ($barang as $b) : ?>

        <form action="<?= base_url('admin/update'); ?>" method="POST">
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="hidden" name="kode_barang" class="form-control" value="<?= $b['kode_barang']; ?>">
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= $b['nama_barang']; ?>">
            </div>
            <div class="form-group">
                <label>Kategori Barang</label>
                <input type="text" name="kategori_barang" class="form-control" value="<?= $b['kategori_barang']; ?>">
            </div>
            <div class="form-group">
                <label>Katerangan Barang</label>
                <input type="text" name="keterangan_barang" class="form-control" value="<?= $b['keterangan']; ?>">
            </div>
            <div class="form-group">
                <label>Stok Barang</label>
                <input type="number" style="width: 100px;" name="jumlah_barang" class="form-control" value="<?= $b['jumlah_barang']; ?>">
            </div>
            \ <button type="submit" class="btn btn-primary">Simpan</button>

        </form>

    <?php endforeach; ?>
</div>
</div>