<?php $this->load->view('visitors/layout/header'); ?>
<style type="text/css">
.services .icon-box:hover .icon i {
  box-shadow: 1px 0 25px rgba(63, 187, 192, 5);
}
</style>
<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Jenis Layanan</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Jenis Layanan</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services services">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Jenis Layanan</h2>
      </div>

      <div class="row">

        <?php
        $this->db->select('*');
        $this->db->where('isActive', '1');
        $get_jenis_layanan = $this->db->get('jenis_layanan')->result();

        foreach ($get_jenis_layanan as $val) {
          ?>

          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
            <a href="<?php echo base_url();?>detail-layanan/<?= $val->id ?>"><div class="icon"><i class="<?php echo $val->icon; ?>"></i></div></a>
            <h4 class="title"><a href="<?php echo base_url();?>detail-layanan/<?= $val->id ?>"><?php echo $val->judul; ?></a></h4>
          </div>

        <?php } ?>

      </div>

    </div>
  </section><!-- End Services Section -->

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>