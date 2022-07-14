
<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="footer-info">
            <?php
            $this->db->select('*');
            $get_kontak = $this->db->get('kontak')->row();
            ?>
            <h3><?php echo $get_kontak->nama_opd; ?></h3>
            <p><?php echo $get_kontak->alamat_opd; ?><br><br>
              <strong>Telepon:</strong> <?php echo $get_kontak->no_telp; ?><br>
              <strong>Email:</strong> <?php echo $get_kontak->email_opd; ?><br>
            </p>
            <div class="social-links mt-3">
              <a href="<?php echo $get_kontak->fb_opd; ?>" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
              <a href="<?php echo $get_kontak->ig_opd; ?>" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
              <a href="<?php echo $get_kontak->youtube_opd; ?>" class="youtube" target="_blank"><i class="bx bxl-youtube"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Tautan</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url();?>">Beranda</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url();?>profil">Profil</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url();?>kepegawaian">Kepegawaian</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url();?>layanan">Jenis Layanan</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url();?>admen">Admen</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url();?>konsultasi">Konsultasi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url();?>inovasi">Inovasi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url();?>galeri">Galeri</a></li>
          </ul>
        </div>

        <div class="col-lg-6 col-md-6 footer-links">
          <h4>Link Terkait</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="https://www.nganjukkab.go.id/home/" target="_blank">PING Portal Informasi Pemkab Nganjuk</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="http://dinkes.nganjukkab.go.id/" target="_blank">Dinas Kesehatan Kabupaten Nganjuk</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="http://dppkb.nganjukkab.go.id/" target="_blank">Dinas Pengendalian Penduduk dan Keluarga Berencana Kabupaten Nganjuk</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="http://diskominfo.nganjukkab.go.id/" target="_blank">Dinas Komunikasi dan Informatika Kabupaten Nganjuk</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="http://kertosono.nganjukkab.go.id/" target="_blank">Kecamatan Kertosono</a></li>
          </ul><br><br>
          <!-- Badge Code - Do Not Change The Code -->
          <h4 style="padding-bottom: 0px">Statistik Pengunjung</h4>
          <a href='https://www.symptoma.com/en/info/covid-19'>Coronavirus Facts</a>
          <script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=f6c11955a2fcfb4f1834ee95a2cf09a4136fb67d'></script>
          <script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/851952/t/1"></script>
          <!-- Badge Code End Here -->

        </div>

          <!--<div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>-->

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>E-Government Diskominfo Nganjuk</span></strong>. 
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
        <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url();?>medicio/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>medicio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>medicio/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>medicio/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url();?>medicio/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url();?>medicio/assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url();?>medicio/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url();?>medicio/assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url();?>medicio/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url();?>medicio/assets/js/main.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    $("iframe").addClass("responsive-iframe");
  </script>

</body>

</html>