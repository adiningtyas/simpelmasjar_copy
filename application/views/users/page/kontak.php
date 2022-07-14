<?php 
  $this->view('users/layout/header');
  $this->view('users/layout/navbar');
?>
<div id="loading" style="display:none">
  <img id="loading-image" src="<?php echo base_url();?>medicio/assets/img/loading.gif" alt="Loading..." />
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="border-top: 2px solid #f8c300; border-bottom: 2px solid #f8c300;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 dinsos-color">Kontak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Home</a></li>
            <li class="breadcrumb-item active">Kontak</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

 <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-info card-outline">
          <div class="card-header">
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th style="width: 5%; vertical-align">No</th>
                <th style="width: 15%; vertical-align">Nama OPD</th>
                <th style="width: 15%; vertical-align">Alamat OPD</th>
                <th style="width: 15%; vertical-align">Email OPD</th>
                <th style="width: 15%; vertical-align">No. Telepon</th>
                <th style="width: 15%; vertical-align">Peta OPD</th>
                <th style="width: 15%; vertical-align">Facebook OPD</th>
                <th style="width: 15%; vertical-align">Instagram OPD</th>
                <th style="width: 15%; vertical-align">Youtube OPD</th>
                <th style="width: 15%; vertical-align">Wa Daftar Online</th>
                <th style="width: 15%; vertical-align">Wa Saran Kritik</th>
                <th style="width: 15%; vertical-align">Wa Saran Kritik</th>
                <th style="width: 15%; vertical-align">Action</th>
              </tr>
              </thead>
              <tbody id="show_data">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--update Modal-->
<div class="modal fade" id="update-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Form Edit Kontak</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post">
        <div class="modal-body form">
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">Nama OPD</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="Nama OPD" name="nama_opd">
              <input class="form-control" type="hidden" name="id">
              <input class="form-control" type="hidden" name="isactive">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">Alamat OPD</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="Alamat OPD" name="alamat_opd">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">Email OPD</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="Email OPD" name="email_opd">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">No. Telepon</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="No. Telepon" name="no_telp">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">Peta OPD (Lokasi Google Maps)</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="Lokasi Google Maps" name="peta_opd">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">Facebook OPD</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="No. Telepon" name="fb_opd">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">Instagram OPD</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="No. Telepon" name="ig_opd">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">Youtube OPD</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="No. Telepon" name="youtube_opd">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">WA Daftar Online</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="No. Telepon" name="wa_daftar_online">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">WA Saran Kritik</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="No. Telepon" name="wa_saran_kritik">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3"><label class="control-label" for="title">WA Customer Service</label></div>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="No. Telepon" name="wa_cs">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" class="btn btn-info" onclick="update_data()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---->

<script type="text/javascript">
  var url = "kontak/ambil-data";
</script>
<?php  
  $this->view('users/layout/footer');
?>
<script src="<?php echo base_url(); ?>services/KontakService.js"></script>
