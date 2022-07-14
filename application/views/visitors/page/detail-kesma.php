<?php $this->load->view('visitors/layout/header') ?>
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

  .container-iframe {
    position: relative;
    overflow: hidden;
    width: 100%;
    padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
  }

  /* Then style the iframe to fit in the container div with full height and width */
  .responsive-iframe {
    position: absolute;
    top: 40;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
  }
</style>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Kesehatan Masyarakat</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Kesehatan Masyarakat</li>
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
        <h2>Kesehatan Masyarakat</h2>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-4 mb-5 mb-lg-0">
          <ul class="nav nav-tabs flex-column">
            <?php
            $this->db->select('id, tanggal, judul, isi, imgpath, isActive');
            $this->db->where('isActive', '1');
            $this->db->order_by("id", "asc");
            $get_kesma = $this->db->get('kesma')->result();

            foreach ($get_kesma as $val) {
              ?>
              <li class="nav-item">
                <a class="nav-link active show" data-toggle="" href="<?php echo base_url();?>detail-kesma/<?= $val->id ?>">
                  <h4><?php echo @$val->judul; ?></h4>
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="col-lg-8">
          <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
              <h3><?php echo @$detailkesma->judul; ?></h3>
              <div style="--aspect-ratio: 13/9;" class="container-iframe"> 
                <?php echo @$detailkesma->isi; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Departments Section -->


</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>
<script type="text/javascript">
  $("iframe").addClass("responsive-iframe");
</script>