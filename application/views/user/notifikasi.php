<div class="container-fluid">
    <h4 class="h3 font-weight-bold text-danger text-center text-uppercase"> <i class="fas fa-fw fa-bell text-danger"></i> Notifikasi Pemesanan</h4>
    <?php foreach($invoice as $inv) : 
         $jlhProduk = $this->db->get_where('tb_pesanan', ['id_invoice' => $inv['id']])->num_rows(); ?>
    <div class="card mb-5">
        <div class="card-header">
        <?='INV/'.date('d/m/Y/').$inv['id']; ?>
        </div>
        <div class="card-body">
            <h5 class="card-title">STATUS PESANAN : 
                <?php if($inv['status'] == 'Sedang diproses') : ?>
                    <span class="h6 bg-info text-light font-weight-bold text-uppercase p-2"><?= $inv['status']; ?></span>
                    <?php elseif($inv['status'] == 'Sedang dikirimkan') : ?>
                    <span class="h6 bg-warning text-light font-weight-bold text-uppercase p-2"><?= $inv['status']; ?>
                    <?php elseif($inv['status'] == 'Selesai') : ?>
                    <span class="h6 bg-success text-light font-weight-bold text-uppercase p-2"><?= $inv['status']; ?>
                    <?php else: ?>
                        <span class="h6 bg-danger text-light font-weight-bold text-uppercase p-2"><?= $inv['status']; ?></span>
                    <?php endif; ?>
            </h5>
            <?php if($inv['status'] == 'Belum dibayar') : ?>
                <p class="card-text">Jumlah Produk : <?= $jlhProduk; ?></p>
                <p class="card-text">Tanggal Pemesanan : <?= $inv['tgl_pesan']; ?></p>
                <p class="card-text">Harus dibayar sebelum : <?= $inv['batas_bayar']; ?></p>
            <?php elseif($inv['status'] == 'Sedang diproses') : ?>
                <p class="card-text">Jumlah Produk : <?= $jlhProduk; ?></p>
                <p class="card-text text-info h4"> <i class="fas fa-fw fa-spinner fa-2x text-info"></i> Pesanan anda sedang disiapkan oleh admin mohon ditunggu! </p>
                <p class="card-text">Hubungi kami jika pesanan tidak sampai sebelum : <?= date('H:i | d-m-Y', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))); ?> </p>
            <?php elseif($inv['status'] == 'Sedang dikirimkan') : ?>
                <p class="card-text">Jumlah Produk : <?= $jlhProduk; ?></p>
                <p class="card-text text-warning h4"> <i class="fas fa-fw fa-truck fa-2x text-warning"></i>  Pesanan anda sedang dalam proses pengiriman! </p>
                <p class="card-text">Lokasi Tujuan : <?= $inv['alamat'] ?></p>
               <?php else : ?>
                <p class="card-text">Jumlah Produk : <?= $jlhProduk; ?></p>
                <p class="card-text text-success h4"> <i class="fas fa-fw fa-check-circle fa-2x text-success"></i>  Pemesanan sukses dan barang berhasil diterima! </p>
            <?php endif; ?>
            <a href="<?= base_url('user/invoice_detail/') . $inv['id'] ?>" class="btn btn-primary float-right ml-2"> <i class="fas fa-fw fa-info-circle"></i> Lihat Detail</a>
            <?php if($inv['status'] == 'Belum dibayar') : ?>
                <a href="<?= base_url('user/invoice_hapus/') . $inv['id'] ?>" onclick="return confirm('Apakah anda yakin ingin membatalkan invoice pemesanan berikut?')" class="btn btn-danger float-right"> <i class="fas fa-fw fa-ban"></i> Batalkan Pesanan</a>
                <?php elseif($inv['status'] == 'Sedang dikirimkan') : ?>
                    <a href="<?= base_url('user/update_status_invoice/') . $inv['id'] ?>" onclick="return confirm('Konfirmasi pesanan sudah diterima?')" class="btn btn-success float-right"> <i class="fas fa-fw fa-check-circle"></i> Pesanan Diterima</a>
                <?php endif; ?>
        </div>
    </div>
        <?php endforeach; ?>
    </div>
    <?= $this->pagination->create_links(); ?>
</div>