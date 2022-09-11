  <!-- Begin Page Content -->
  <div class="container-fluid">

      <!-- Content Row -->
      <div class="row">
          <?php $produk = $this->db->get('barang_master')->num_rows();
            $customer = $this->db->get_where('user', ['role_id' => 2 ])->num_rows(); ?>


          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4 bg-gradient-primary">
              <div class="card shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                  Stok Barang</div>
                              <div class="h5 mb-0 font-weight-bold text-primary"><?= $produk; ?></div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-briefcase fa-2x text-primary"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <?php

            $sudahDibayar = 'Sudah dibayar';
            $sedangDiproses = 'Sedang diproses';
            $sedangDiantar = 'Sedang dikirimkan';
            $selesai = 'Selesai';
            $dibayar = $this->db->get_where('invoice', ['status' => $selesai])->num_rows();
            ?>
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4 bg-gradient-success">
              <div class="card shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                  Terjual</div>
                              <div class="h5 mb-0 font-weight-bold text-success"><?= $dibayar; ?></div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-dollar-sign fa-2x text-success"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <?php $pembayaran2 = 'Belum dibayar';
            $belumDibayar = $this->db->get_where('invoice', ['status' => $pembayaran2])->num_rows();
            $no = 1; ?>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4 bg-gradient-info">
              <div class="card shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan
                              </div>
                              <div class="row no-gutters align-items-center">
                                  <div class="col-auto">
                                      <div class="h5 mb-0 font-weight-bold text-info"><?= $belumDibayar; ?></div>
                                  </div>
                                  <div class="col">

                                  </div>
                              </div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-clipboard-list fa-2x text-info"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4 bg-gradient-danger">
              <div class="card shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Customer
                              </div>
                              <div class="row no-gutters align-items-center">
                                  <div class="col-auto">
                                      <div class="h5 mb-0 font-weight-bold text-danger"><?= $customer; ?></div>
                                  </div>
                                  <div class="col">

                                  </div>
                              </div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-user fa-2x text-danger"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Content Row -->
          <div class="card shadow mb-4  mx-auto">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?> Pemesanan</h6>
              </div>

              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr align="center" class="bg-gradient-primary" style="color: #ffffff;">
                                  <th style="width: 10px;">No</th>
                                  <th style="width: 100px;">ID Invoice</th>
                                  <th style="width: 150px;">Nama Pemesan</th>
                                  <th style="width: 150px;">Alamat Pengiriman</th>
                                  <th style="width: 150px;">Tanggal Pemesanan</th>
                                  <th style="width: 150px;">Batas Pembayaran</th>
                                  <th>Status</th>
                                  <th style="width: 150px;">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                              if($invoice != null) :
                              foreach ($invoice as $inv) : ?>
                                  <tr align="left">
                                      <td align="center"><?= $no++ ?></td>
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
                                              <?php elseif  ($inv['status'] == $sudahDibayar || $inv['status'] == $selesai) : ?>
                                              <p class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= $inv['status']; ?></p>
                                              <?php else : ?>
                                              <p class="badge badge-danger"><?= $inv['status']; ?></p>
                                          <?php endif; ?>
                                      </td>
                                      <td>
                                          <a href="<?= base_url('admin/invoice_detail/') . $inv['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info"></i></a>
                                          <?php if($inv['status'] != 'Selesai') : ?>
                                             <a href="<?= base_url('admin/edit_status_invoice/') . $inv['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a>
                                          <?php endif; ?>
                                          <a href="<?= base_url('admin/invoice_hapus/') . $inv['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus invoice pemesanan ini?')"><i class="fas fa-trash-alt"></i></a>
                                      </td>
                                  </tr>
                              <?php endforeach; 
                                    else : ?>
                                    <td colspan="7" align="center">Tidak ada pemesanan</td>
                                    <?php endif; ?>
                          </tbody>
                      </table>
                      <?= $this->pagination->create_links(); ?>
                    </div>
              </div>
          </div>
      </div>
      <!-- /.container-fluid -->

  </div>
  </div>
  <!-- End of Main Content -->