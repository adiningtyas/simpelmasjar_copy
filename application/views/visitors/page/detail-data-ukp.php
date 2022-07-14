<?php $this->load->view('visitors/layout/header'); ?>
<style type="text/css">
  [style*="--aspect-ratio"] > :first-child {
  width: 100%;
}
[style*="--aspect-ratio"] > img {  
  height: auto;
}
@supports (--custom:property) {
  [style*="--aspect-ratio"] {
    position: relative;
  }
  [style*="--aspect-ratio"]::before {
    content: "";
    display: block;
    padding-bottom: calc(100% / (var(--aspect-ratio)));
  }  
  [style*="--aspect-ratio"] > :first-child {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
  }  
}
</style>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Data UKP</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url();?>data-ukp">Data UKP</a></li>
          <li>Detail Data UKP</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section class="inner-page">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h3><?php echo $detaildataukp->judul; ?></h3>
        <p style="color: #888;font-size: 0.8125rem;"><i class="icofont-clock-time"></i> <?php echo TanggalIndo($detaildataukp->tanggal); ?></p>
      </div>

      <div style="--aspect-ratio: 13/9;"> 
        <iframe src="<?php echo $detaildataukp->imgpath; ?>" ></iframe>
      </div>
      <br>
      <?php echo $detaildataukp->isi; ?>
    </div>
  </section>

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>