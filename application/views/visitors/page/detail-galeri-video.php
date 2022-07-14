<?php $this->load->view('visitors/layout/header'); ?>
<style>
  .yutub {
    position: relative;
    width: 100%;
    overflow: hidden;
    padding-top: 56.25%; /* 16:9 Aspect Ratio */
  }

  .responsive-iframe {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    border: none;
  }
</style>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Galeri Video</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url();?>galeri">Galeri</a></li>
          <li>Detail Galeri Video</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2><?php echo $detailvideo->judul; ?></h2>
        <p style="color: #888;font-size: 0.8125rem;"><i class="icofont-clock-time"></i> <?php echo TanggalIndo($detailvideo->tanggal); ?></p>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <div class="yutub">
          <?php
          parse_str( parse_url( $detailvideo->url, PHP_URL_QUERY ), $my_array_of_vars );
          ?>
          <iframe class="responsive-iframe" src="https://www.youtube.com/embed/<?php echo $my_array_of_vars['v'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        
      </div>

      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">
          <?php echo $detailvideo->isi;?>
        </div>
      </div>

    </div>
  </section>

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>