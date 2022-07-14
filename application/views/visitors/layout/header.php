<style type="text/css">
  .nav-menu > ul > li {
    padding: 10px 0 10px 18px !important;
  }

  .center-menu {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PKM-KERTOSONO</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url();?>medicio/assets/img/pkm-kertosono.PNG" rel="icon">
  <link href="<?php echo base_url();?>medicio/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url();?>medicio/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>medicio/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>medicio/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>medicio/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>medicio/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url();?>medicio/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>medicio/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url();?>medicio/assets/css/style.css" rel="stylesheet">
  <!-- SOURCE DATATABLE -->
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- =======================================================
  * Template Name: Medicio - v2.1.1
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <i class="icofont-clock-time"></i> Senin - Sabtu, 07.30 - 11.00 
      </div>
      <div class="d-flex align-items-center">
        <?php
        $this->db->select('*');
        $get_kontak = $this->db->get('kontak')->row();
        ?>
        <i class="icofont-phone"></i> Telepon <?php echo $get_kontak->no_telp; ?>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="<?php echo base_url();?>" class="logo mr-auto"><img src="<?php echo base_url();?>medicio/assets/img/logo.jpeg" class="img-fluid" alt=""> <span style="font-size: 80%"><?php echo $get_kontak->nama_opd; ?></span></a>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <h1 class="logo mr-auto"><a href="index.html">Medicio</a></h1> -->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="<?php echo $this->uri->segment(1) == '' ? 'active': '' ;?>"><a href="<?php echo base_url();?>"><span style="font-size: 80%">Beranda</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'profil' ? 'active': '' ;?>"><a href="<?php echo base_url();?>profil"><span style="font-size: 80%">Profil</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'kepegawaian' ? 'active': '' ;?>"><a href="<?php echo base_url();?>kepegawaian"><span style="font-size: 80%">Kepegawaian</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'layanan' ? 'active': '' ;?>"><a href="<?php echo base_url();?>layanan"><span style="font-size: 80%">Jenis Layanan</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'admen' ? 'active': '' ;?>"><a href="<?php echo base_url();?>admen"><span style="font-size: 80%;">Manajemen<br>Administrasi</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'ukm' ? 'active': '' ;?>"><a href="<?php echo base_url();?>kesma"><span style="font-size: 80%;">Kesehatan<br>Masyarakat</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'ukp' ? 'active': '' ;?>"><a href="<?php echo base_url();?>kesper"><span style="font-size: 80%;">Kesehatan<br>Perorangan</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'mutu' ? 'active': '' ;?>"><a href="<?php echo base_url();?>manmu"><span style="font-size: 80%;">Manajemen<br>Mutu</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'konsultasi' ? 'active': '' ;?>"><a href="<?php echo base_url();?>konsultasi"><span style="font-size: 80%">Konsultasi</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'inovasi' ? 'active': '' ;?>"><a href="<?php echo base_url();?>inovasi"><span style="font-size: 80%">Inovasi</span></a></li>
          <li class="<?php echo $this->uri->segment(1) == 'galeri' ? 'active': '' ;?>"><a href="<?php echo base_url();?>galeri"><span style="font-size: 80%">Galeri</span></a></li>
          <!-- <li class="drop-down"><a href="#">Galeri</a>
          <ul>
            <li><a href="<?php echo base_url();?>galeri-ukp">UKP</a></li>
            <li><a href="<?php echo base_url();?>data-ukp">Data Terupdate UKP</a></li>
            <li><a href="<?php echo base_url();?>galeri-ukm">UKM</a></li>
            <li><a href="<?php echo base_url();?>galeri">Galeri</a></li>
          </ul> -->
        </li>

      </ul>
    </nav><!-- .nav-menu -->
    <a href="<?php echo base_url();?>" class="logo mr-auto"><img src="<?php echo base_url();?>medicio/assets/img/pkm-kertosono.PNG" class="img-fluid" alt="" style="margin-left: 10px;"></a>
      <!--

      <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a>-->

    </div>
  </header><!-- End Header -->
  <style type="text/css">
    .mbohcok-responsive {
      width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
    }
  </style>