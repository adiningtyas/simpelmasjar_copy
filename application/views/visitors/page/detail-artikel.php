<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Artikel</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url();?>artikel">Artikel</a></li>
          <li>Detail Artikel</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section class="inner-page">
    <div class="container" data-aos="fade-up">
      
      <div class="section-title">
        <h3><?php echo $detailartikel->judul; ?></h3>
        <p style="color: #888;font-size: 0.8125rem;"><i class="icofont-clock-time"></i> <?php echo TanggalIndo($detailartikel->tanggal); ?></p>
      </div>

      <center><img src="<?php echo $detailartikel->imgpath; ?>" class="img-fluid" alt="" style="width:50% !important; height: auto !important;"></center>
      <p>
        <?php echo $detailartikel->isi; ?>
      </p>
    </div>
  </section>

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>