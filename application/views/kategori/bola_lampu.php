<!-- Begin Page Content -->


<div class="container-fluid border-danger" style="margin-top: -1px;">


<h5 class="card-title h3 font-weight-bold text-center text-uppercase text-gray-900">LIST PRODUK</h5>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #212529;">
            <li class="breadcrumb-item" style="color: #ffffff;"><a style="color: #ffffff; text-decoration:none;"> <i class="fa fa-fw fa-bars"></i> Category</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('user/kategori1'); ?>" onmouseover="this.style.borderBottom=' 3px solid #fff';" onmouseout="this.style.borderBottom='none';" style="color: #ffffff; text-decoration:none;"> Sarung Jok Mobil</a></li>
            <li class=" breadcrumb-item"><a href="<?= base_url('user/kategori2'); ?>" onmouseover="this.style.borderBottom=' 3px solid #fff';" onmouseout="this.style.borderBottom='none';" style="color: #ffffff; text-decoration:none;"> Handle</a></li>
            <li class=" breadcrumb-item"><a href="<?= base_url('user/kategori3'); ?>" onmouseover="this.style.borderBottom=' 3px solid #fff';" onmouseout="this.style.borderBottom='none';" style="color: #ffffff; text-decoration:none;"> Garnish</a></li>
            <li class=" breadcrumb-item"><a href="<?= base_url('user/kategori4'); ?>" onmouseover="this.style.borderBottom=' 3px solid #fff';" onmouseout="this.style.borderBottom='none';" style="color: #ffffff; text-decoration:none;"> Kaca Film</a></li>
            <li class=" breadcrumb-item"><a href="<?= base_url('user/kategori5'); ?>" onmouseover="this.style.borderBottom=' 3px solid #fff';" onmouseout="this.style.borderBottom='none';" style="color: #ffffff; text-decoration:none;"> Bola Lampu Mobil</a></li>
            <li class=" breadcrumb-item"><a href="<?= base_url('user/kategori6'); ?>" onmouseover="this.style.borderBottom=' 3px solid #fff';" onmouseout="this.style.borderBottom='none';" style="color: #ffffff; text-decoration:none;"> Karpet Mobil</a></li>
            <li class=" breadcrumb-item"><a href="<?= base_url('user/kategori7'); ?>" onmouseover="this.style.borderBottom=' 3px solid #fff';" onmouseout="this.style.borderBottom='none';" style="color: #ffffff; text-decoration:none;"> Sarung Setir</a></li>
        </ol>
    </nav>
              <form action="<?= base_url('user/shoping'); ?>" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" style="width: 950px; border: 2px solid #212529" class="form-control small" placeholder="Masukan keyword Pencarian..." name="keyword" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-sm" style="background-color: #212529; color:#ffffff; width:60px;"  name="submit" value="Cari!">
                    </div>
                </div>
            </form>

    <div class="row mt-3 mx-auto">
        <?php foreach ($harga as $h) : ?>
            <div class="col-md-4 mb-3" style="width: 80x;">
                <a href="<?= base_url('user/detail_produk/') . $h['kode_harga'] ?>" class="card shadow-sm p-3 mb-5 bg-white rounded" onmouseover="this.style.border='3px solid #ff3d00';" onmouseout="this.style.border='none';" style="width: 18rem; text-decoration: none">
                    <img src="<?= base_url('assets/img/') . $h['image'] . '.jpg' ?>" class="card-img-top" alt="..." height= "200px" >
                    <div class="card-body">
                        <h5 class="card-title text-center text-gray-900"><?= $h['nama_barang']; ?></h5>
                        <p class="card-text text-center text-gray-900"><?= $h['keterangan']; ?></p>
                        <p class="card-text text-center" style="background-color:#ff3d00; border-radius: 30px; color: white">Rp. <?= number_format($h['harga'], 0, ",", "."); ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>


    </div>
    <?= $this->pagination->create_links(); ?>

    <!-- Container fluit -->
</div>
</div>
<!-- end -->