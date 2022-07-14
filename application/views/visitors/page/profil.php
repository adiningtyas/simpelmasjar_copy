<?php $this->load->view('visitors/layout/header') ?>
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
        <h2>Profil</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Profil</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <!--<section class="inner-page">
    <div class="container">
      <p>
        Example inner page template
      </p>
    </div>
  </section>-->


  <!-- ======= Departments Section ======= -->
  <section id="departments" class="departments">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Profil</h2>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-4 mb-5 mb-lg-0">
          <ul class="nav nav-tabs flex-column">
            <li class="nav-item">
              <a class="nav-link active show" data-toggle="tab" href="#tab-1">
                <h4>Visi dan Misi Puskesmas Kertosono</h4>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-toggle="tab" href="#tab-2">
                <h4>Tata Nilai Puskesmas Kertosono</h4>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-toggle="tab" href="#tab-3">
                <h4>Falsafah Puskesmas Kertosono</h4>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-toggle="tab" href="#tab-4">
                <h4>Tujuan Puskesmas Kertosono</h4>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-toggle="tab" href="#tab-5">
                <h4>Janji Layanan Puskesmas Kertosono</h4>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-toggle="tab" href="#tab-6">
                <h4>Budaya Kerja Puskesmas Kertosono</h4>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-toggle="tab" href="#tab-7">
                <h4>Mars Puskesmas Kertosono</h4>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-toggle="tab" href="#tab-8">
                <h4>Data Demografi Wilayah Kerja Puskesmas Kertosono</h4>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-8">
          <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
              <?php
              $this->db->select('isi, status, isActive');
              $this->db->where('status', 'Visi Misi');
              $this->db->where('isActive', '1');
              $get_visimisi = $this->db->get('profil')->row();
              ?>
              <h3><?php echo @$get_visimisi->status; ?> Puskesmas Kertosono</h3>
              <?php echo @$get_visimisi->isi; ?>
            </div>
            <div class="tab-pane" id="tab-2">
              <?php
              $this->db->select('isi, status, isActive');
              $this->db->where('status', 'Tata Nilai');
              $this->db->where('isActive', '1');
              $get_tatanilai = $this->db->get('profil')->row();
              ?>
              <h3><?php echo @$get_tatanilai->status; ?> Puskesmas Kertosono</h3>
              <?php echo @$get_tatanilai->isi; ?>
            </div>
            <div class="tab-pane" id="tab-3">
              <?php
              $this->db->select('isi, status, isActive');
              $this->db->where('status', 'Falsafah');
              $this->db->where('isActive', '1');
              $get_tatanilai = $this->db->get('profil')->row();
              ?>
              <h3><?php echo @$get_tatanilai->status; ?> Puskesmas Kertosono</h3>
              <?php echo @$get_tatanilai->isi; ?>
            </div>
            <div class="tab-pane" id="tab-4">
              <?php
              $this->db->select('isi, status, isActive');
              $this->db->where('status', 'Tujuan');
              $this->db->where('isActive', '1');
              $get_tatanilai = $this->db->get('profil')->row();
              ?>
              <h3><?php echo @$get_tatanilai->status; ?> Puskesmas Kertosono</h3>
              <?php echo @$get_tatanilai->isi; ?>
            </div>
            <div class="tab-pane" id="tab-5">
              <?php
              $this->db->select('isi, status, isActive');
              $this->db->where('status', 'Janji Layanan');
              $this->db->where('isActive', '1');
              $get_janjilayanan = $this->db->get('profil')->row();
              ?>
              <h3><?php echo @$get_janjilayanan->status; ?> Puskesmas Kertosono</h3>
              <?php echo @$get_janjilayanan->isi; ?>
            </div>
            <div class="tab-pane" id="tab-6">
              <?php
              $this->db->select('isi, status, isActive');
              $this->db->where('status', 'Budaya Kerja');
              $this->db->where('isActive', '1');
              $get_budayakerja = $this->db->get('profil')->row();
              ?>
              <h3><?php echo @$get_budayakerja->status; ?> Puskesmas Kertosono</h3>
              <?php echo @$get_budayakerja->isi; ?>
            </div>
            <div class="tab-pane" id="tab-7">
              <?php
              $this->db->select('isi, status, isActive, filepath');
              $this->db->where('status', 'Mars Puskesmas');
              $this->db->where('isActive', '1');
              $get_mars = $this->db->get('profil')->row();
              ?>
              <h3><?php echo @$get_mars->status; ?> Kertosono</h3>
              <?php echo @$get_mars->isi; ?><br>
              <div class="yutub"><?php echo @$get_mars->filepath; ?></div>
            </div>
            <div class="tab-pane" id="tab-8">
              <?php
              $this->db->select('isi, status, isActive');
              $this->db->where('status', 'Data Demografi');
              $this->db->where('isActive', '1');
              $get_demografi = $this->db->get('profil')->row();
              ?>
              <h3><?php echo @$get_demografi->status; ?> Wilayah Kerja Puskesmas Kertosono</h3>
              <?php echo @$get_demografi->isi; ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Departments Section -->


</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>