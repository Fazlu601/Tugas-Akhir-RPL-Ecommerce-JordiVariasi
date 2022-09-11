  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow bg-gray-900" style="height: 70px;">
              <div class="mt-3">
                  <?= $this->session->flashdata('message'); ?>

              </div>

              <!-- Sidebar Toggle (Topbar) -->
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
              </button>
              <?php
                $email = $this->session->userdata('email');
                ?>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="navbar">
                      <?php if($user['role_id'] != 1 ) : ?>
                      <ul class="nav navbar-nav navbar-right">
                          <li class="btn btn-warning" style="text-decoration: none; color:#ffffff;">
                              <?php
                                $keranjang = '<i class="fas fa-fw fa-shopping-cart text-primary"></i> <span class="badge badge-light">' . $this->cart->total_items() . '</span>' ?>
                              <?= anchor('user/detail_keranjang', $keranjang) ?> 
                          </li>
                      </ul>
                      <?php endif; ?>
                  </div>

                    <div class="navbar">
                      <?php 
                      $nama = $user['nama'];
                      $query = "SELECT * FROM invoice WHERE nama = '$nama' AND status = 'Belum dibayar' ";
                      $notif = $this->db->query($query)->num_rows();
                       if($user['role_id'] != 1 ) : ?>
                      <ul class="nav navbar-nav navbar-right">
                      <a href="<?= base_url('user/notification/') . $user['nama'] ; ?>" class="btn btn-primary">
                            <i class="fas fa-fw fa-bell text-warning"></i> <span class="badge badge-light"><?= $notif ?></span>
                            </a>
                      </ul>
                      <?php endif; ?>
                  </div>
                  
                  <div class="topbar-divider d-none d-sm-block"></div>


                  <!-- Nav Item - User Information -->
                  <li class="nav-item dropdown no-arrow">
                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="mr-2 d-none d-lg-inline text-gray-100 small"><?= $user['nama']; ?></span>
                          <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/'); ?><?= $user['image']; ?>">
                      </a>
                      <!-- Dropdown - User Information -->
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                      <?php if($user['role_id'] != 1 ) : ?>
                          <a class="dropdown-item" href="<?= base_url('user/profile'); ?>">
                              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                              My Profile
                          </a>
                          <?php endif; ?>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                              Logout!
                          </a>
                      </div>
                  </li>

              </ul>

          </nav>
          <!-- End of Topbar -->