<?php $this->load->view('visitors/layout/header'); ?>
<style type="text/css">
  .konsul-hov:hover{
    color: #46C254 !important;
    background-color: #fff !important;
    text-shadow: 2px 2px 4px green;
  }
</style>
<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Konsultasi</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Konsultasi</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Doctors Section ======= -->
  <section id="doctors" class="doctors section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Konsultasi</h2>
        <!--<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>-->
      </div>

      <div class="row">

        <?php
        $this->db->select('*');
        $this->db->where('isActive', '1');
        $get_konsultasi = $this->db->get('konsultasi')->result();

        foreach ($get_konsultasi as $val) {
          ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <a href="https://api.whatsapp.com/send?phone=<?php echo $val->no_hp; ?>&text=Silahkan Melakukan Konsultasi" target="_blank"><img src="<?php echo $val->imgpath; ?>" class="img-fluid" alt=""></a>
                <div class="social">
                  <a href="https://api.whatsapp.com/send?phone=<?php echo $val->no_hp; ?>&text=Silahkan Melakukan Konsultasi" target="_blank"><i class="icofont-whatsapp"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4><?php echo $val->nama; ?></h4>
                <span style="color: #555555 !important;"><?php echo $val->jabatan; ?></span>
                <span style="margin-top: 3px;"><i class="icofont-clock-time"></i> <?php echo $val->jam_konsul; ?></span>
                <a href="https://api.whatsapp.com/send?phone=<?php echo $val->no_hp; ?>&text=Silahkan Melakukan Konsultasi" target="_blank"><span class="konsul-hov" style="margin-top: 3px;color: #fff; background-color: green; padding: 8px"><i style="color: #1AD03F" class="icofont-whatsapp"></i> Klik Untuk Konsultasi</span></a>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>

    </div>
  </section><!-- End Doctors Section -->

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>