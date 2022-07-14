<?php $this->load->view('visitors/layout/header'); ?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Kepegawaian</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Kepegawaian</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section class="inner-page">
    <div class="container">
      <div class="section-title">
        <h2>Kepegawaian</h2>
      </div>

      <?php
        $this->db->select('isi, status, isActive');
        $this->db->where('status', 'Kepegawaian');
        $this->db->where('isActive', '1');
        $get_kepegawaian = $this->db->get('profil')->row();
      ?>
      <center><?php echo $get_kepegawaian->isi; ?></center>
    </div>
  </section>

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>