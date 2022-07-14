<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Pengumuman</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Pengumuman</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

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
          $get_pengumuman = $this->db->query('SELECT *, CASE WHEN tanggal >= CURDATE() THEN 1 ELSE 0 END AS isBerlangsung FROM `pengumuman` WHERE isActive = "1" ORDER BY isBerlangsung DESC, CASE WHEN isBerlangsung = 1 THEN tanggal END ASC, CASE WHEN 1 = 1 THEN tanggal END DESC LIMIT 20')->result();

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

    </div>
  </section><!-- End Featured Services Section -->

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>