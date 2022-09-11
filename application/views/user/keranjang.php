<div class="container-fluid">
    <h4 class="font-weight-bold text-danger text-center text-uppercase"><i class="fas fa-fw fa-shopping-cart"></i> Keranjang</h4>

    <table class="table table-bordered table-striped table-hover">
        <tr style="background-color:#ff3d00; color:#ffffff">
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sub-Total</th>
        </tr>
        <?php if($this->cart->contents() != null)  : ?> 
        <?php $no = 1;
        foreach ($this->cart->contents() as $items) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $items['name']; ?></td>
                <td><?= $items['keterangan']; ?></td>
                <td><?= $items['qty']; ?></td>
                <td align="right">
                    Rp. <?= number_format($items['price'], 0, ",", "."); ?>
                </td>
                <td align="right">
                    Rp. <?= number_format($items['subtotal'], 0, ",", "."); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" align="center">Tidak ada barang dalam keranjang.</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td style="color:#ff3d00" colspan="5" align="right"><strong>Total :</strong></td>
            <td align="right">Rp. <?= number_format($this->cart->total(), 0, ",", ".") ?></td>
        </tr>

    </table>
    <div align="right">
        <a href="<?= base_url('user/hapus_keranjang'); ?>" class="btn btn-sm btn-danger mr-3"><i class="fas fa-fx fa-trash"></i> Hapus Keranjang</a>
        <a href="<?= base_url('user/shoping'); ?>" class="btn btn-sm btn-primary mr-3"><i class="fas fa-fx fa-cart-plus"></i> Lanjutkan Belanja</a>
        <?php if($this->cart->contents() != null) :?>
        <a href="<?= base_url('user/pembayaran'); ?>" class="btn btn-sm btn-success mr-3"><i class="fas fa-fx fa-wallet"></i> Pembayaran</a>
        <?php endif; ?>
    </div>
</div>
</div>