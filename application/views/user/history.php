<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-history"></i> <?= $judul; ?></h6>
        </div>

        <?php $invoice = $this->db->get_where('invoice', ['nama' => $user['nama']])->result_array();
        $sudahDibayar = 'Sudah dibayar';
        $sedangDiproses = 'Sedang diproses';
        $sedangDiantar = 'Sedang dikirimkan';
        $selesai = 'Diterima';
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center" style="background-color:  #2E59D9; color:#ffffff;">
                            <th style="width: 30px;">No</th>
                            <th style="width: 50px;">ID Invoice</th>
                            <th style="width: 150px;">Nama Pemesan</th>
                            <th style="width: 150px;">Alamat Pengiriman</th>
                            <th style="width: 150px;">Tanggal Pemesanan</th>
                            <th style="width: 150px;">Batas Pembayaran</th>
                            <th>Status</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; if( $invoice != null ) :
                        foreach ($invoice as $inv) : ?>
                            <tr align="center">
                                <td align="center"><?=$no++ ?></td>
                                <td align="center"><?='INV/'.date('d/m/Y/').$inv['id']; ?></td>
                                <td><?= $inv['nama']; ?></td>
                                <td><?= $inv['alamat']; ?></td>
                                <td><?= $inv['tgl_pesan']; ?></td>
                                <td><?= $inv['batas_bayar']; ?></td>
                                <td>
                                <?php if ($inv['status'] == $sedangDiproses) : ?>
                                              <p class="badge badge-info p-1"><i class="fas fa-fw fa-spinner"></i> <?= $inv['status']; ?></p>
                                          <?php elseif ($inv['status'] == $sedangDiantar) : ?>
                                              <p class="badge badge-warning p-1"><i class="fas fa-fw fa-truck"></i> <?= $inv['status']; ?></p>
                                              <?php elseif  ($inv['status'] != $sudahDibayar) : ?>
                                              <p class="badge badge-success"><?= $inv['status']; ?></p>
                                              <?php else : ?>
                                              <p class="badge badge-danger"><?= $inv['status']; ?></p>
                                          <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('user/invoice_detail/') . $inv['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; 
                            else: ?>
                                    <td colspan="7" align="center">Tidak ada pemesanan</td>
                             <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->