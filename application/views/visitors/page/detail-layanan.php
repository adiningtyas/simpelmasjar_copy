<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Jenis Layanan</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url();?>layanan">Jenis Layanan</a></li>
          <li>Detail Jenis Layanan</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section class="inner-page">
    <div class="container" data-aos="fade-up">
      
      <div class="section-title">
        <h3><?php echo $detaillayanan->judul; ?></h3>
      </div>
      <?php echo $detaillayanan->layanan; ?>
    </div>
  </section>

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>