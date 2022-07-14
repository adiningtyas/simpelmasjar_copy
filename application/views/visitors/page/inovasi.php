<?php $this->load->view('visitors/layout/header') ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Inovasi</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Inovasi</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->


  <!-- ======= Departments Section ======= -->
  <section id="departments" class="departments">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Inovasi</h2>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-4 mb-5 mb-lg-0">
          <ul class="nav nav-tabs flex-column">
            <?php
              $this->db->select('id, tanggal, judul, isi, imgpath, isActive');
              $this->db->where('isActive', '1');
              $this->db->order_by("id", "asc");
              $get_inovasi = $this->db->get('inovasi')->result();

              foreach ($get_inovasi as $val) {
            ?>
            <li class="nav-item">
              <a class="nav-link active show" data-toggle="" href="<?php echo base_url();?>detail-inovasi/<?= $val->id ?>">
                <h4><?php echo $val->judul; ?></h4>
              </a>
            </li>
            <?php } ?>
          </ul>
        </div>
        <div class="col-lg-8">
          <div class="tab-content">
            <?php
              $this->db->select('id, tanggal, judul, isi, imgpath, isActive');
              $this->db->where('isActive', '1');
              $this->db->order_by("id", "asc");
              $get_detinovasi = $this->db->get('inovasi')->row();
            ?>
            <div class="tab-pane active show" id="tab-1">
              <h3><?php echo $get_detinovasi->judul; ?></h3>
              <img src="<?php echo $get_detinovasi->imgpath; ?>" alt="" class="img-fluid">
              <?php echo $get_detinovasi->isi; ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Departments Section -->


</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>
