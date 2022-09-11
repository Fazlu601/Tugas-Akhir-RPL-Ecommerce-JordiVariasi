<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn btn btn-success mb-3">
                <?php
                $grand_total = 0;
                if ($keranjang = $this->cart->contents()) {
                    foreach ($keranjang as $items) {
                        $grand_total = $grand_total + $items['subtotal'];
                    }
                    echo "<h4>TOTAL : Rp. " . number_format($grand_total, 0, ",", ".");
                ?>
            </div><br><br>

            <h3 class="font-weight-bold text-success text-uppercase">Input Alamat Pengiriman dan Pembayaran</h3>

            <form action="<?= base_url('user/proses_pesanan'); ?>" method="POST">
                <div class="form-group">
                    <label class="text-primary" for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="<?= $user['nama']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label class="text-primary" for="">Alamat Lengkap</label>
                    <input type="text" class="form-control" name="alamat" value="<?= $user['alamat']; ?>" required>
                </div>
                <div class="form-group">
                    <label class="text-primary" for="">No. telepon</label>
                    <input type="text" class="form-control" name="no_telp" value="<?= $user['no_telp']; ?>" required>
                </div>
                <div class="form-group">
                    <label class="text-primary" for="">Jasa Pengiriman</label>
                    <select name="jasa" class="form-control" id="">
                        <option value="">JNE</option>
                        <option value="">J&T</option>
                        <option value="">POS Indonesia</option>
                        <option value="">GOJEK</option>
                        <option value="">GRAB</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="text-primary" for="">Pilih Bank</label>
                    <select name="jasa" class="form-control" id="">
                        <option value="">BCA - XXXXXXX</option>
                        <option value="">BNI - XXXXXXX</option>
                        <option value="">BRI - XXXXXXX</option>
                        <option value="">MANDIRI - XXXXXXX</option>
                    </select>
                </div>
                    <div class="form-group">
                        <button type="submit" style="margin-left: 15%; width: 500px;" class="btn btn-primary mb-3">PESAN!</button>
                    </div>
            </form>
        <?php
                } else {
                    echo "<h4'>Keranjang Belanja Anda Masih Kosong!";
                }
        ?>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>