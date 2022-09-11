<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?> Master</h6>
        </div>
        <div class="card-body">
            <a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#newBarangModal"><i class="fas fa-plus"></i> Input Data Harga Produk</a>
            <!-- Topbar Search -->
            <form action="<?= base_url('admin/hargabarang'); ?>" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" name="keyword" placeholder="Masukan keyword..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary" name="submit" value="Cari!">   
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm mt-3" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center" class="bg-gradient-primary" style="color:#ffffff;">
                            <th>No .</th>
                            <th>Kode Harga</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($harga as $h) :  ?>
                            <tr align="center">
                                <td><?= ++$start; ?></td>
                                <td><?= $h['kode_harga']; ?></td>
                                <td><?= $h['kode_barang']; ?></td>
                                <td><?= $h['nama_barang']; ?></td>
                                <td align="left">Rp. <?= number_format($h['harga'], 0, ",", "."); ?></td>
                                <td align="left"><?= $h['keterangan']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/editharga/') . $h['kode_harga']; ?>" class="btn btn-success btn-sm"> <i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('admin/hapusdataharga/') . $h['kode_harga']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data harga <?=$h['nama_barang']; ?>?')"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->














<!-- Modal -->
<div class="modal fade" id="newBarangModal" tabindex="-1" aria-labelledby="newBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBarangModalLabel">Input Data Harga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/hargabarang') ?>" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" name="kode_harga" id="kode_harga" placeholder="Kode harga">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang">
                    </div>
                    <div class="form-group">
                        <input type="number" style="width: 150px;" class="form-control" name="harga" id="harga" placeholder="Harga Barang">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>