<?php $this->load->view('visitors/layout/header'); ?>
<link href="<?php echo base_url();?>assets/css/blog.css" rel="stylesheet">
<style type="text/css">
  .dataTables_length{
    display: none !important;
  }

  .dataTables_info{
    display: none !important;
  }

  .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #3FBBC0;
    border-color: #3FBBC0;
  }
  
  .page-link {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #3FBBC0;
    background-color: #fff;
    border: 1px solid #dee2e6;
  }
</style>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Artikel</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>Artikel</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog">
    <div class="container">

      <div class="row">

        <div class="col-lg-12 entries">
          <?php
          $this->db->select('id, tanggal, judul, isi, imgpath, isActive');
          $this->db->where('isActive', '1');
          $this->db->order_by("tanggal", "desc");
          $this->db->limit('7');
          $get_artikel = $this->db->get('berita')->result(); ?>

          <table id="example" class="" style="width:100%">
            <thead>
             <tr>
              <th style="width: 100%; border: none !important;"></th>
            </tr>
          </thead>
          <tbody>
           <?php foreach ($get_artikel as $val) {
            ?>
            <tr><td>
              <article class="entry" data-aos="fade-up">

                <div class="entry-img">
                  <img src="<?php echo $val->imgpath; ?>" alt="" class="img-fluid">
                </div>

                <h5>
                  <a href="<?php echo base_url();?>detail-artikel/<?= $val->id ?>"><?php echo $val->judul; ?></a>
                </h5>

                <div class="entry-meta">
                  <ul>
                    <!-- <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">John Doe</a></li> -->
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="<?php echo $val->tanggal; ?>"><?php echo $val->tanggal; ?></time></a></li>
                    <!-- <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">12 Comments</a></li> -->
                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    <?php echo substr(preg_replace("/\r?\n$/", "", strip_tags($val->isi)), 0, 200); ?> <a href="<?php echo base_url();?>detail-artikel/<?= $val->id ?>" style="color: #3FBBC0">....</a>
                  </p>
                  <div class="read-more">
                    <a href="<?php echo base_url();?>detail-artikel/<?= $val->id ?>" style="background: #3FBBC0">Selengkapnya</a>
                  </div>
                </div>

              </article><!-- End blog entry -->
            </td></tr>
          <?php } ?>
        </tbody>
      </table>

    </div><!-- End blog entries list -->
  </div>
</div>
</section><!-- End Blog Section -->

</main><!-- End #main -->

<?php $this->load->view('visitors/layout/footer'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({

     "drawCallback": function( settings ) {
      $("#example thead").remove(); },
      "ordering":false,
      "language": {
        "search": "<button type='submit' class='btn btn-info btn-sm' style='background:#3FBBC0; border:none; padding: 8.3px 10px !important; position:relative; bottom:1; left:6'><i class='icofont-search'></i></button>",
        "searchPlaceholder": "Pencarian",
        "paginate": {
          "previous": "<",
          "next":">"
        }
      }
    });
  } );
</script>
