<div class="container-fluid">
    <!-- Page Heading -->
    <div class="align-items-center justify-content-between mb-4">
        <h1 class="h3 font-weight-bold text-success text-uppercase">Detail Pesanan</h1>
        <?php if( $invoice['status'] == 'Sedang diproses' || $invoice['status'] == 'Sedang dikirimkan' || $invoice['status'] == 'Selesai')  : ?>
        <a href="<?= base_url('user/pdf/') . $invoice['id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm ml-2 float-right"><i class="fas fa-fx fa-download fa-sm text-white-50"></i> Download PDF</a>
        <a href="<?= base_url('user/print/') . $invoice['id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-fx fa-print fa-sm text-white-50"></i> Cetak Laporan</a>
        <?php endif; ?>
    </div>
    <table class="table table-hover mt-2">
        <tr>
            <td><b>Nama Pelanggan :</b> <?= $invoice['nama']; ?></td>
        </tr>
        <tr>
            <td><b>Nomor Telepon :</b> <?= $invoice['no_telp']; ?></td>
        </tr>
        <tr>
            <td><b>Alamat Lengkap :</b> <?= $invoice['alamat']; ?></td>
        </tr>
        <?php if($invoice['status'] == 'Sudah dibayar') : ?>
        <tr>
            <td><b>Dibayar Pada :</b> <?= $invoice['tanggal_dibayar']; ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <table class="table table-bordered table-hover table-striped">
        <tr class="bg-gradient-success" style="color:#ffffff">
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Keterangan Produk</th>
            <th>Jumlah Pesanan</th>
            <th>Harga Satuan</th>
            <th>Sub-Total</th>
        </tr>
        <?php $no = 1;
        $total = 0;
        foreach ($pesanan as $psn) :
            $subtotal = $psn['jumlah'] * $psn['harga'];
            $total += $subtotal;
            $grandTotal = $total + 30000;
        ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $psn['nama_barang']; ?></td>
                <td><?= $psn['keterangan']; ?></td>
                <td><?= $psn['jumlah']; ?></td>
                <td>Rp. <?= number_format($psn['harga'], 0, ",", "."); ?></td>
                <td>Rp. <?= number_format($subtotal, 0, ",", "."); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td class="bg-gray-200 text-success" colspan=" 5" align="right"><b>Grand Total :</b> </td>
            <td class="bg-gray-200">Rp. <?= number_format($grandTotal, 0, ",", "."); ?></td>
        </tr>
    </table>

    <ul>
        <?php if($invoice['status'] == 'Sudah dibayar') : ?>
        <li>Jika pesanan tidak sampai dalam kurun waktu yang ditentukan, silahkan melakukan kontak melalui nomor Whatsapp kami.</li>
        <?php endif; ?>
        <li>Nomor Kontak Admin : 0895639394873</li>
        <li>Tambahan biaya ongkir sebesar Rp. 30.000</li>
    </ul>

</div>
</div>