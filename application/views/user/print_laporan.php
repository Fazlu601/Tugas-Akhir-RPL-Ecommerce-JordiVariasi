<div class="container-fluid">
    <div class="md-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 font-weight-bold text-uppercase" style="color: black; border-bottom: 5px solid black;">Nota Pesanan  <br> Jordi Variasi Auto Accessories</h1>
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
        <tr>
            <td><b>Status Pesanan :</b> <?= $invoice['status']; ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-hover table-striped">
        <tr style="color:#ffffff; background-color: black;">
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
            <td class="bg-gray-200" colspan=" 5" align="right"><b>Grand Total :</b> </td>
            <td class="bg-gray-200">Rp. <?= number_format($grandTotal, 0, ",", "."); ?></td>
        </tr>
    </table>
    <br><br>
            <ul>
                <li>Surat ini digunakan sebagai bukti bahwa pelanggan yang bersangkutan sudah melakukan transaksi.</li>
                <li>Jika pesanan tidak sampai dalam kurun waktu yang ditentukan, silahkan melakukan kontak terhadap admin.</li>
                <li>Nomor Kontak Admin : 0895639394873</li>
                <li>Tambahan biaya ongkir sebesar Rp. 30.000</li>
            </ul>       
</div>
<br><br><br><br><br><br><br><br><br><br><br>
        <p style="text-align: right">Yang bertanda tangan dibawah ini.</p>
      
            <ul>

                <p style="text-align:right; margin-right: 50px">Fazlu Rachman</p>
            </ul>

      


<script>
    window.print();
</script>
</body>