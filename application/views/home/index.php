<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?=$judul ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
  <div class="header">
    <div class="container">
      <div class="navbar" style="border-bottom: 1px solid #ffffff; margin-left:-21px ; width: 1222px; height:100px">
        <div class="logo">
          <img src="<?= base_url('assets/img/jordi.png') ?>" alt="Logo Shop" width="200px">
        </div>
        <nav>
          <ul>
            <li><a href="<?= base_url('auth/registration') ?>">Registrasi Akun</a></li>
          </ul>
        </nav>
      </div>
      <div class="row">
        <div class="col-2">
          <h1><span style="color:red">TERSEDIA :</span> SARUNG JOK, KACA FILM, HANDLE, GARNISH, DLL</h1>
          <a href="<?= base_url('auth'); ?>" class="btn">LOGIN SEKARANG &#x279E; </a>
        </div>
        <div class="col-2">
          <img src="<?= base_url('assets/img/mobil.png') ?>" alt="picture">
        </div>
        <h3 class="font-weight-bold text-center h3 text-gray-900">Jl. Lingkar Selatan, Lkr. Sel., Kec. Jambi Sel., Kota Jambi, Jambi 36126</h3>

      </div>
    </div>
  </div>


</body>

</html>