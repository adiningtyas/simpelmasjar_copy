<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>UKP</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>UKP</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->


  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>UKP (Upaya Kesehatan Perseorangan)</h2>
      </div>

      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">

        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <?php
        $this->db->select('detail_galeri_foto.id, detail_galeri_foto.idgaleri, detail_galeri_foto.imgpath, detail_galeri_foto.isActive, galeri_foto.judul, galeri_foto.id_kategori, kategori.id_kategori');
        $this->db->join('galeri_foto','detail_galeri_foto.idgaleri=galeri_foto.id', 'INNER');
        $this->db->join('kategori','galeri_foto.id_kategori=kategori.id_kategori', 'INNER');
        $this->db->where('detail_galeri_foto.isActive', 1);
        $this->db->where('kategori.id_kategori', 1);
        $this->db->or_where('kategori.id_kategori', 2);
        $this->db->or_where('kategori.id_kategori', 3);
        $this->db->or_where('kategori.id_kategori', 4);
        $this->db->or_where('kategori.id_kategori', 5);
        $this->db->or_where('kategori.id_kategori', 6);
        $this->db->or_where('kategori.id_kategori', 7);
        $this->db->or_where('kategori.id_kategori', 8);
        $this->db->or_where('kategori.id_kategori', 9);
        $this->db->order_by("detail_galeri_foto.id", "desc");
        $this->db->group_by('detail_galeri_foto.idgaleri');
        $get_data = $this->db->get('detail_galeri_foto')->result();

        foreach ($get_data as $val) {
          ?>

          <div class="col-lg-4 col-md-6 portfolio-item" >
            <img src="<?php echo $val->imgpath; ?>" class="img-fluid" alt="">
            <div class="portfolio-info" style="opacity: 1">
              <h4></h4>
              <a href="welcome/detailGaleriUkp/<?php echo $val->idgaleri; ?>"><p>Klik untuk info lengkap</p></a>
              <a href="<?php echo $val->imgpath; ?>" data-gall="portfolioGallery" class="venobox preview-link" title="Perbesar"><i class="bx bx-plus"></i></a>
              <a href="welcome/detailGaleriUkp/<?php echo $val->idgaleri; ?>" class="details-link" title="Detil"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <?php } ?>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php $this->load->view('visitors/layout/footer'); ?>




