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
          <h1 class="m-0 dinsos-color">Daftar Rumus</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Home</a></li>
            <li class="breadcrumb-item active">Rumus</li>
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
            <table id="example2" class="table table-bordered table-hover dt-responsive">
              <thead>
                <tr>
                  <th style="width: 5%; vertical-align">No.</th>
                  <th style="width: 20%; vertical-align">Nama Rumus</th>
                  <th style="width: 20%; vertical-align">Keterangan</th>
                  <th style="width: 5%; vertical-align">Detail</th>
                  <th style="width: 10%; vertical-align">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count=0; 
                foreach ($data_rumus as $val) { 
                  $count=$count+1;
                  ?>
                  <tr>
                    <td style="width: 5%; vertical-align"><?php echo $count; ?></td>
                    <td style="width: 20%; vertical-align"><?php echo $val->nama_rumus; ?></td>
                    <td style="width: 20%; vertical-align"><?php echo $val->keterangan; ?></td>
                    <td style="width: 5%; vertical-align"><?php echo '<button class="btn btn-warning btn-sm" title="Detail Rumus" onclick="detail_rumus('."'".$val->id."'".')"><i class="fa fa-eye"></i></button> &nbsp;'; ?></td>
                    <td style="width: 10%; vertical-align"><?php echo '<button class="btn btn-info btn-sm" title="Edit" onclick="update('."'".$val->id."'".')"><i class="fa fa-edit"></i></button> &nbsp;'.'<button class="btn btn-danger btn-sm" title="Hapus" onclick="hapus('."'".$val->id."'".')"><i class="fa fa-trash"></i></button> &nbsp;'; ?></td>
                  </tr>
                <?php } ?>
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
        <h3 class="modal-title">Form Tambah Rumus</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="newsform">
        <div class="modal-body form">
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Nama Rumus</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Nama Rumus" name="nama_rumus" id="nama_rumus"></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Keterangan</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Keterangan Rumus" name="keterangan" id="keterangan"></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Lokasi Rumus</label></div>
            <div class="col-sm-10 float-right">
              <select class="form-control" name="form_rumus" id="form_rumus" required>
                <option value="" selected disabled>Pilih Rumus</option>
                <?php
                $s =  realpath(getcwd());
                foreach(glob($s . '/rumus/*') as $filename){
                 $filename = basename($filename);
                 echo "<option value='" . $filename . "'>". $filename."</option>";
               }
               ?>
             </select>
           </div>
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
        <h3 class="modal-title">Form Edit Rumus</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="newsform">
        <div class="modal-body form">
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_rumus">
            <div class="col-sm-2"><label class="control-label" for="title">Nama Rumus</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Nama Rumus" name="nama_rumus" id="nama_rumus"></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Keterangan</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Keterangan Rumus" name="keterangan" id="keterangan"></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Lokasi Rumus</label></div>
            <div class="col-sm-10 float-right">
              <select class="form-control" name="form_rumus" id="form_rumus" required>
                <option value="" selected disabled>Pilih Rumus</option>
                <?php
                $s =  realpath(getcwd());
                foreach(glob($s . '/rumus/*') as $filename){
                 $filename = basename($filename);
                 echo "<option value='" . $filename . "'>". $filename."</option>";
               }
               ?>
             </select>
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
        <h3 class="modal-title">Contoh Form Rumus</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form" id="contoh_rumus" style="pointer-events: none;">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>
<!---->

<?php  
$this->view('users/layout/footer');
?>
<script src="<?php echo base_url(); ?>services/AdminRumusService.js"></script>