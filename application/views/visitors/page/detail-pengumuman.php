<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Pengumuman</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url();?>pengumuman">Pengumuman</a></li>
          <li>Detail Pengumuman</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section class="inner-page">
    <div class="container" data-aos="fade-up">
      
      <div class="section-title">
        <h3><?php echo $detailpengumuman->judul; ?></h3>
        <p style="color: #888;font-size: 0.8125rem;"><i class="icofont-clock-time"></i> <?php echo TanggalIndo($detailpengumuman->tanggal); ?></p>
      </div>

      <img src="<?php echo $detailpengumuman->imgpath; ?>" class="img-fluid" alt="" style="width:50% !important; height: auto !important;">
      <?php echo $detailpengumuman->isi; ?>
    </div>
  </section>

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>