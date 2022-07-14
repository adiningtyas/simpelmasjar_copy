<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Galeri</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Galeri</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section id="portfolio" class="portfolio">
    <div class="container">


      <div class="section-title" data-aos="fade-up">
        <h2>Galeri Foto dan Video</h2>
      </div>

      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <!-- <li data-filter="*" class="filter-active">All</li> -->
            <li data-filter=".filter-fot" onclick="filterfoto()" id="tabFoto">Galeri Foto</li>
            <li data-filter=".filter-vid" onclick="filtervideo()" id="tabVideo">Galeri Video</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <?php
        $this->db->select('detail_galeri_foto.id, detail_galeri_foto.idgaleri, detail_galeri_foto.imgpath, detail_galeri_foto.isActive, galeri_foto.judul, galeri_foto.tanggal');
        $this->db->join('galeri_foto','detail_galeri_foto.idgaleri=galeri_foto.id', 'INNER');
        $this->db->where('detail_galeri_foto.isActive', 1);
        $this->db->order_by("detail_galeri_foto.id", "desc");
        $this->db->group_by('detail_galeri_foto.idgaleri');
        $get_data = $this->db->get('detail_galeri_foto')->result();
        foreach ($get_data as $val) {
          ?>            
          <div class="col-lg-4 col-md-6 portfolio-item filter-fot" id="filter-fot">
            <img src="<?php echo $val->imgpath; ?>" class="img-fluid" alt="">
            <div class="portfolio-info" style="opacity: 1">
              <h4></h4>
              <a href="welcome/detailGaleri/<?php echo $val->idgaleri; ?>"><p><?php echo $val->judul; ?> <p style="color: #444;font-size: 0.8125rem;"><i class="icofont-clock-time"></i> <?php echo TanggalIndo($val->tanggal); ?></p></p></a>
              <a href="<?php echo $val->imgpath; ?>" data-gall="portfolioGallery" class="venobox preview-link" title="Perbesar"><i class="bx bx-plus"></i></a>
              <a href="welcome/detailGaleri/<?php echo $val->idgaleri; ?>" class="details-link" title="Detil"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <?php } ?>
          <?php
          $this->db->select('galeri_video.id, galeri_video.tanggal, galeri_video.judul, galeri_video.isi, galeri_video.url,galeri_video.isActive');
          $this->db->where('galeri_video.isActive', 1);
          $this->db->order_by("galeri_video.id", "DESC");
          $get_data = $this->db->get('galeri_video')->result();
          foreach ($get_data as $val) {  ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-vid" id="filter-vid">
              <?php 
              parse_str( parse_url( $val->url, PHP_URL_QUERY ), $my_array_of_vars );
              ?>
              <img src="https://img.youtube.com/vi/<?php echo $my_array_of_vars['v']; ?>/hqdefault.jpg" class="img-fluid" alt="">
              <div class="portfolio-info" style="opacity: 1">
                <h4></h4>
                <a href="detail-galerivideo/<?php echo $val->id; ?>"><p><?php echo $val->judul; ?> <p style="color: #444;font-size: 0.8125rem;"><i class="icofont-clock-time"></i> <?php echo TanggalIndo($val->tanggal); ?></p></p></a>
                <a href="https://img.youtube.com/vi/<?php echo $my_array_of_vars['v'];?>/hqdefault.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Perbesar"><i class="bx bx-plus"></i></a>
                <a href="detail-galerivideo/<?php echo $val->id; ?>" class="details-link" title="Detail"><i class="bx bx-link"></i></a>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>


    </main><!-- End #main -->

    <script src="<?php echo base_url(); ?>services/PageBeritaFoto.js"></script>
    <?php $this->load->view('visitors/layout/footer'); ?>
    <script type="text/javascript">

      function filtervideo(){
        $('#tabVideo').addClass("filter-active");
        $('#tabFoto').removeClass("filter-active");
        $('.filter-fot').hide();
        $('.filter-vid').show();
      };

      function filterfoto(){
        $('#tabFoto').addClass("filter-active");
        $('#tabVideo').removeClass("filter-active");
        $('.filter-fot').show();
        $('.filter-vid').hide();
      };
    </script>


