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
          <h1 class="m-0 dinsos-color">Daftar Pengumuman</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Home</a></li>
            <li class="breadcrumb-item active">Pengumuman</li>
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
            <div class="col-sm-2 float-left">
              <button type="button" data-toggle="modal" data-target="#insert-modal" class="btn btn-block bg-gradient-info btn-flat"><i class="fas fa-plus"></i> &nbsp;Tambah</button>
            </div>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width: 5%; vertical-align">No</th>
                  <th style="width: 30%; vertical-align">Judul</th>
                  <th style="width: 15%; vertical-align">Tanggal</th>
                  <th style="width: 10%; vertical-align">Author</th>
                  <th style="width: 10%; vertical-align">File</th>
                  <th style="width: 8%; vertical-align">Status</th>
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

<!--Add Modal-->
<div class="modal fade" id="insert-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Form Tambah Pengumuman</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="newsform">
        <div class="modal-body form">
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Tanggal</label></div>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tanggal" name="tanggal">
              <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('userid'); ?>" name="user">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Judul Pengumuman</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Judul Pengumuman" name="judul" id="judul"></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Isi Pengumuman</label></div>
            <div class="col-sm-10 float-right"><textarea name="isi" id="editor1" rows="10" cols="80"></textarea></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">File Gambar</label></div>
            <div class="col-sm-10 float-right"><input type="file" class="form-control" name="file" id="file"><span><i style="color: red; font-size: 8pt">* File : .jpg/.png/.jpeg</i></span></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" class="btn btn-info" onclick="insert()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---->

<!--update Modal-->
<div class="modal fade" id="update-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Form Edit Pengumuman</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="newsform">
        <div class="modal-body form">
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Tanggal</label></div>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tanggal2" name="tanggal">
              <input type="hidden" class="form-control" name="id">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Judul Pengumuman</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Judul Pengumuman" name="judul" id="judul"></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Isi Pengumuman</label></div>
            <div class="col-sm-10 float-right"><textarea name="isi" id="editor2" rows="10" cols="80"></textarea></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">File Gambar</label></div>
            <div class="col-sm-10 float-right"><input type="file" class="form-control" name="file2" id="file2">
              <span><i style="color: red; font-size: 8pt">* Kosongkan jika tidak ada perubahan gambar</i></span>
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

<!--Detail Modal-->
<div class="modal fade" id="detail-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Detail Pengumuman</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form">
        <div class="col-12" id="title">
          <h4 style="text-align: center;">Ini Judul</h4>
          <h6 id="oleh" style="text-align: center; font-style: italic;"></h6>
          <h6 id="tanggal" style="text-align: center; font-style: italic;"></h6>
        </div>
        <br>
        <div class="col-12" id="isi">
          <img id="gambar" style="width: 50%; float: left; padding-right: 2rem; padding-bottom: 2rem">
          <div id="uisi"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>
<!---->

<script type="text/javascript">
  var url = "pengumuman/ambil-data";
  CKEDITOR.replace( 'editor1' );
  CKEDITOR.replace( 'editor2' );
</script>
<?php  
$this->view('users/layout/footer');
?>
<script src="<?php echo base_url(); ?>services/AdminPengumumanService.js"></script>