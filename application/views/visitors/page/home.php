<?php $this->load->view('visitors/layout/header'); ?>

<!-- PopUP -->
<?php
$this->db->select('*');
$get_promo = $this->db->get('promo')->row();

if ($get_promo->isActive == '1') {
  ?>
  <div id="mainPop" class="modal fade" role="dialog" style="z-index: 99999 !important">
    <div class="modal-header" style="border-bottom: none">
      <button type="button" class="close" style="opacity: 1" data-dismiss="modal"><span style="color: white !important;font-style: 'Open Sans';font-size: 60%">Tutup &times;</span></button>
    </div>
    <div class="modal-dialog modal-lg" style="max-width:100% !important;">
      <div class="modal-dialog modal-lg" style="max-width:95% !important;">
        <center><img src="<?php echo $get_promo->filepath;?>" class="img-responsive" width="100%"></center>
      </div>
    </div>
  </div>
<?php } ?>

<!-- PERCOBAAN MAKK++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- PERCOBAAN MAKK++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="col-lg-12 col-md-12" style="margin-top: 125px;">
  <!-- ======= Hero Section ======= -->

  <section id="hero" style="border: 0.5px solid #F7F7F7;">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <div class="carousel-inner" role="listbox">
       <!-- Slide 1 -->
       <?php
       $this->db->select('*');
       $this->db->where('isActive', '1');
       $get_header = $this->db->get('header_image')->result_array();
       foreach ($get_header as $key => $value) {?>
        <div class="carousel-item <?php if($key == 0) { echo 'active'; } ?>" style="background-image: url(<?php echo $value['imgpath']?>); width: 100%;">
          <div class="carousel-container">
          </div>
        </div>
      <?php } ?>
    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

  </div>
</section><!-- End Hero -->
</div>
<!-- PERCOBAAN MAKK++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- PERCOBAAN MAKK++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<main id="main">
  <!-- ======= Featured Services Section ======= -->
  <section id="featured-services" class="featured-services">
    <div class="container">
      <div class="section-title">
        <h2>Pengumuman</h2>
      </div>
    </div>

    <div class="container" data-aos="fade-up">

      <div class="row">

        <?php
        $get_pengumuman = $this->db->query('SELECT *, CASE WHEN tanggal >= CURDATE() THEN 1 ELSE 0 END AS isBerlangsung FROM `pengumuman` WHERE isActive = "1" ORDER BY isBerlangsung DESC, CASE WHEN isBerlangsung = 1 THEN tanggal END ASC, CASE WHEN 1 = 1 THEN tanggal END DESC LIMIT 4')->result();

        foreach ($get_pengumuman as $val) {
          ?>
          <a href="<?php echo base_url();?>detail-pengumuman/<?= $val->id ?>">
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><i class="icofont-book-mark"></i></div>
                <h4 class="title"><a href="<?php echo base_url();?>detail-pengumuman/<?= $val->id ?>"><?php echo tanggalIndoSingkat($val->tanggal); ?></a></h4>
                <a href="<?php echo base_url();?>detail-pengumuman/<?= $val->id ?>"><p class="description" style="color: #111;"><?php echo substr(preg_replace("/\r?\n$/", "", strip_tags($val->judul)), 0, 80); ?></p></a>
              </div>
            </div>
          </a>
        <?php } ?>

      </div>

      <div class="row" data-aos="fade-up" style="padding-top: 20px;">
        <div class="col-lg-12 col-md-12">
          <center><a href="<?php echo base_url();?>pengumuman"><button type="button" class="btn tombol"><span>Selengkapnya </span></button></a></center>
        </div>
      </div>

    </div>
  </section><!-- End Featured Services Section -->

  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container" data-aos="zoom-in">
      <?php
      $this->db->select('*');
      $get_kontak = $this->db->get('kontak')->row();
      ?>

      <div class="text-center">
        <h1>Hubungi Kami</h1>
        <p></p><br>
        <a class="cta-btn scrollto" href="https://api.whatsapp.com/send?phone=<?php echo $get_kontak->wa_daftar_online; ?>&text=Silahkan Melakukan Pendaftaran" target="_blank"><i class="icofont-brand-whatsapp"></i> Pendaftaran Online</a>
        <a class="cta-btn scrollto" href="https://api.whatsapp.com/send?phone=<?php echo $get_kontak->wa_saran_kritik; ?>&text=Saran dan Pengaduan" target="_blank"><i class="icofont-ui-message"></i> Saran dan Pengaduan</a>
        <a class="cta-btn scrollto" href="https://api.whatsapp.com/send?phone=<?php echo $get_kontak->wa_cs; ?>&text=Anda Terhubung dengan Customer Service kami" target="_blank"><i class="icofont-support"></i> Customer Service</a>
      </div>

    </div>
  </section><!-- End Cta Section -->


  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts">
    <div class="container">
      <div class="section-title">
        <h2>Artikel</h2>
      </div>
    </div>

    <div class="container" data-aos="fade-up">

      <div class="row no-gutters">

        <?php
        $this->db->select('id, tanggal, judul, isi, imgpath, isActive');
        $this->db->where('isActive', '1');
        $this->db->order_by("tanggal", "desc");
        $this->db->limit('4');
        $get_artikel = $this->db->get('berita')->result();

        foreach ($get_artikel as $val) {
          ?>
          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <a href="<?php echo base_url();?>detail-artikel/<?= $val->id ?>">
              <div class="count-box">
                <a href="<?php echo base_url();?>detail-artikel/<?= $val->id ?>"><img src="<?php echo $val->imgpath; ?>" class="img-fluid" alt=""></a>
                <a href="<?php echo base_url();?>detail-artikel/<?= $val->id ?>"><h5 style="margin-top: 8px;"><?php echo $val->judul; ?></h5></a>
                <?php echo substr(preg_replace("/\r?\n$/", "", strip_tags($val->isi)), 0, 100); ?>
                <a href="<?php echo base_url();?>detail-artikel/<?= $val->id ?>">Selengkapnya &raquo;</a>
              </div>
            </a>
          </div>
        <?php } ?>

      </div>


      <div class="row" data-aos="fade-up" style="padding-top: 20px;">
        <div class="col-lg-12 col-md-12">
          <center><a href="<?php echo base_url();?>artikel"><button type="button" class="btn tombol"><span>Selengkapnya </span></button></a></center>
        </div>
      </div>

    </div>
  </section><!-- End Counts Section -->


  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Kontak</h2>
      </div>

    </div>

    <div>
      <?php echo $get_kontak->peta_opd; ?>
    </div>

    <div class="container">

      <div class="row mt-5">

        <div class="col-lg-7">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Alamat</h3>
                <p><?php echo $get_kontak->alamat_opd; ?></p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-5">

          <div class="row">
            <div class="col-md-7">
              <div class="info-box">
                <i class="bx bx-envelope"></i>
                <h3>Email Us</h3>
                <p><?php echo $get_kontak->email_opd; ?></p>
              </div>
            </div>
            <div class="col-md-5">
              <div class="info-box">
                <i class="bx bx-phone-call"></i>
                <h3>Telepon</h3>
                <p><?php echo $get_kontak->no_telp; ?></p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>

<!-- PopUP -->
<script type="text/javascript">
  $('#mainPop').modal('show');
</script>