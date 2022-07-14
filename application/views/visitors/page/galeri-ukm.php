<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>UKM</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>UKM</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->


  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>UKM (Upaya Kesehatan Masyarakat)</h2>
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
        $this->db->or_where('kategori.id_kategori', 10);
        $this->db->or_where('kategori.id_kategori', 11);
        $this->db->or_where('kategori.id_kategori', 12);
        $this->db->or_where('kategori.id_kategori', 13);
        $this->db->or_where('kategori.id_kategori', 14);
        $this->db->or_where('kategori.id_kategori', 15);
        $this->db->or_where('kategori.id_kategori', 16);
        $this->db->or_where('kategori.id_kategori', 17);
        $this->db->or_where('kategori.id_kategori', 18);
        $this->db->or_where('kategori.id_kategori', 19);
        $this->db->or_where('kategori.id_kategori', 20);
        $this->db->or_where('kategori.id_kategori', 21);
        $this->db->or_where('kategori.id_kategori', 22);
        $this->db->or_where('kategori.id_kategori', 23);
        $this->db->or_where('kategori.id_kategori', 24);
        $this->db->or_where('kategori.id_kategori', 25);
        $this->db->order_by("detail_galeri_foto.id", "desc");
        $this->db->group_by('detail_galeri_foto.idgaleri');
        $get_data = $this->db->get('detail_galeri_foto')->result();

        foreach ($get_data as $val) {
          ?>

          <div class="col-lg-4 col-md-6 portfolio-item" >
            <img src="<?php echo $val->imgpath; ?>" class="img-fluid" alt="">
            <div class="portfolio-info" style="opacity: 1">
              <h4></h4>
              <a href="welcome/detailGaleriUkm/<?php echo $val->idgaleri; ?>"><p>Klik untuk info lengkap</p></a>
              <a href="<?php echo $val->imgpath; ?>" data-gall="portfolioGallery" class="venobox preview-link" title="Perbesar"><i class="bx bx-plus"></i></a>
              <a href="welcome/detailGaleriUkm/<?php echo $val->idgaleri; ?>" class="details-link" title="Detil"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <?php } ?>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php $this->load->view('visitors/layout/footer'); ?>




