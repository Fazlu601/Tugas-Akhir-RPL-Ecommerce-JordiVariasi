<div class="container-fluid">
    <div class="card">
        <h5 class="card-header bg-gradient-danger font-weight-bold text-warning text-uppercase">Detail Produk</h5>
        <div class="card-body">

            <?php foreach ($barang as $b) : ?>
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/') . $b['image'] . '.jpg' ?>" class="card-img-top" width="300px">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <td>Nama Produk </td>
                                <td>: <strong><?= $b['nama_barang']; ?> </strong></td>
                            </tr>
                            <tr>
                                <td>Keterangan </td>
                                <td>: <strong><?= $b['keterangan']; ?> </strong></td>
                            </tr>
                            <tr>
                                <td>Kategori Produk </td>
                                <td>: <strong><?= $b['kategori_barang']; ?> </strong></td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>: <strong><?= $b['jumlah_barang']; ?> </strong></td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>: <strong>
                                        <div class="btn btn-sm" style="background-color:#ff3d00; color:#ffffff">Rp. <?= number_format($b['harga'], 0, ",", "."); ?></div>
                                    </strong></td>
                            </tr>
                        </table>
                        <a href="<?= base_url('user/shoping'); ?>" class="btn btn-sm btn-danger ml-1"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                        <?php if( $b['jumlah_barang'] != 0 ) :?>
                        <a href="<?= base_url('user/tambah_ke_keranjang/') . $b['kode_harga']; ?>" class="btn btn-sm btn-warning ml-1"><i class="fas fa-fx fa-cart-arrow-down"></i> Masukan keranjang</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>