<!DOCTYPE html>
<html lang="en"><head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $judul; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">


</head><body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <div class="container-fluid">
            <div class="md-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 font-weight-bold text-uppercase text-center" style="color: black; text-align: center;">Nota Pembayaran <br> Jordi Variasi Auto Accessories</h1>
                <h1 class="h3 font-weight-bold text-uppercase text-center">=======================================</h1>
                <br><br>
            </div>
            <table class="table table-sm table-hover mt-2">
                <tr>
                    <td><b>Nama Pelanggan :</b> <?= $invoice['nama']; ?></td>
                </tr>
                <tr>
                    <td><b>Nomor Telepon :</b> <?= $invoice['no_telp'] ?></td>
                </tr>
                <tr>
                    <td style="width: 300px;"><b>Alamat Lengkap :</b> <?= $invoice['alamat']; ?></td>
                </tr>
            </table><br><br>

            <table cellpadding="5" style="border: 2px solid gray;">
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Keterangan Produk</th>
                    <th>Jumlah</th>
                    <th style="width:100px">Harga</th>
                    <th style="width:100px">Sub-Total</th>
                </tr>
                <?php $no = 1;
                $total = 0;
                foreach ($pesanan as $psn) :
                    $subtotal = $psn['jumlah'] * $psn['harga'];
                    $total += $subtotal;
                    $grandTotal = $total + 30000;
                ?>

                    <tr align="left">
                        <td><?= $no++ ?></td>
                        <td><?= $psn['nama_barang']; ?></td>
                        <td><?= $psn['keterangan']; ?></td>
                        <td align="center"><?= $psn['jumlah']; ?></td>
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
                <li>Nota ini digunakan sebagai bukti bahwa pelanggan yang bersangkutan sudah melakukan transaksi.</li>
                <li>Jika pesanan tidak sampai dalam kurun waktu yang ditentukan, silahkan kontak kami melalui whatsapp.</li>
                <li>Hubungi kami : 0895639394873</li>
                <li>Tambahan biaya ongkir sebesar Rp. 30.000</li>
            </ul>

        </div>
<br><br><br><br><br><br><br><br><br><br><br>
        <p style="text-align: right">Yang bertanda tangan dibawah ini.</p>
        <div>
            <ul>

                <p style="text-align:right; margin-right: 50px">Fazlu Rachman</p>
            </ul>

        </div>

</body></html>