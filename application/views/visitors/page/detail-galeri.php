<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Galeri</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url();?>galeri">Galeri</a></li>
          <li>Detail Galeri</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <?php
        $id = $this->uri->segment(3);
        $this->db->select('galeri_foto.judul,galeri_foto.tanggal');
        $this->db->where('galeri_foto.id', $id);
        $this->db->where('galeri_foto.isActive', 1);
        $get_data = $this->db->get('galeri_foto')->row(); 
        ?>
        <h2><?php echo $get_data->judul; ?>XXXXX</h2>
        <p style="color: #888;font-size: 0.8125rem;"><i class="icofont-clock-time"></i> <?php echo TanggalIndo($get_data->tanggal); ?></p>
      </div>

      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">

        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <?php
        $id = $this->uri->segment(3);
        $this->db->select('detail_galeri_foto.id, detail_galeri_foto.idgaleri, detail_galeri_foto.imgpath, detail_galeri_foto.isActive, galeri_foto.judul');
        $this->db->join('galeri_foto','detail_galeri_foto.idgaleri=galeri_foto.id', 'INNER');
        $this->db->where('detail_galeri_foto.idgaleri', $id);
        $this->db->where('detail_galeri_foto.isActive', 1);
        $get_data = $this->db->get('detail_galeri_foto')->result();

        foreach ($get_data as $val) {
          ?>

          <div class="col-lg-4 col-md-6 portfolio-item" >
            <a href="<?php echo $val->imgpath; ?>" data-gall="portfolioGallery" class="venobox preview-link" title="Perbesar">
              <img src="<?php echo $val->imgpath; ?>" class="img-fluid" alt="">
            </a>
          </div>
          <?php } ?>
          
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php $this->load->view('visitors/layout/footer'); ?>