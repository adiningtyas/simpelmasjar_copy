<?php 
$this->view('users/layout/header');
$this->view('users/layout/navbar');
?>
<div id="loading" style="display:none">
  <img id="loading-image" src="<?php echo base_url();?>medicio/assets/img/loading.gif" alt="Loading..." />
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 dinsos-color">Lengkapi IKK 3.1</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Home</a></li>
            <li class="breadcrumb-item active">IKK 3.1</li>
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
            <div class="col-sm-4 float-left">
              <button type="button" data-toggle="modal" data-target="#tambah_aspek-modal" class="btn btn-block bg-gradient-info btn-flat"><i class="fas fa-plus"></i> &nbsp;Tambah Aspek</button>
            </div>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width: 5%; vertical-align">No</th>
                  <th style="width: 30%; vertical-align">Aspek</th>
                  <th style="width: 30%; vertical-align">Fokus</th>
                  <!-- <th style="width: 30%; vertical-align">IKK</th> -->
                </tr>
              </thead>
              <tbody id="show_data">
                <?php
                $curr_aspek_id = NULL;
                $buffer = ""; 
                $count_aspek=0;
                $nomor=0;
                $jml_data=count($data_ikk);
                
                foreach ($data_ikk as $val) {
                  $curr_fokus_id=NULL;
                  $count_fokus=0;

                  if($curr_aspek_id != $val->id_aspek) {

                    if($count_aspek > 0) {
                      $nomor+=1;
                      echo "<tr><td rowspan=$count_aspek>$nomor</td><td rowspan=$count_aspek>$val->nama_aspek</td>";
                      echo $buffer;
                    }

                    $curr_aspek_id = $val->id_aspek;
                    $buffer = "<td>" . $val->nama_fokus . "</td></tr>";
                    $count_aspek = 1;
                  }
                  else {

                    $buffer .= "<tr><td>" . $val->nama_fokus . "</td></tr>";
                    $count_aspek++;
                    if($count_aspek==$jml_data){
                      $nomor+=1;
                      echo "<tr><td rowspan=$count_aspek>$nomor</td><td rowspan=$count_aspek>$val->nama_aspek</td>";
                      echo $buffer;
                    }
                  }
                }
                ?>
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

<!-- ////////////////////////////////////////////////////////////// MODAL ASPEK ////////////////////////////////////////////////////////// -->
<!--MODAL TAMBAH ASPEK-->
<div class="modal fade" id="tambah_aspek-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Form Tambah Aspek</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="form_add_aspek">
        <div class="modal-body form">
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_aspek">
            <div class="col-sm-2"><label class="control-label" for="title">Nama Aspek</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Nama Aspek" name="nama_aspek" id="nama_aspek"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSaveAspek" class="btn btn-info" onclick="insert()">Simpan</button>
          <button type="button" id="btnUpdateAspek" class="btn btn-success" onclick="edit_data_aspek()" style="display:none">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---->
<!-- ////////////////////////////////////////////////////////////// END ASPEK ////////////////////////////////////////////////////////// -->


<!-- //////////////////////////////////////////////////// MODAL FOKUS ///////////////////////////////////////////////////// -->
<!--MODAL TAMBAH FOKUS-->
<div class="modal fade" id="tambah_fokus-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Form Tambah Fokus</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="form_add_fokus">
        <div class="modal-body form">
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_aspek">
            <div class="col-sm-2"><label class="control-label" for="title">Nama Fokus</label></div>
            <div class="col-sm-10 float-right">
              <div class="table-responsive">
                <table class="table" id="dynamic_field">

                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSaveFokus" class="btn btn-info" onclick="simpan_fokus()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- EDIT FOKUS -->
<div class="modal fade" id="edit_fokus-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Form Edit Fokus</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="form_edit_fokus">
        <div class="modal-body form">
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_fokus">
            <div class="col-sm-2"><label class="control-label" for="title">Nama Fokus</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Nama Fokus" name="nama_fokus" id="nama_fokus"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnUpdateFokus" class="btn btn-success" onclick="edit_data_fokus()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---->
<!-- //////////////////////////////////////////////////// END MODAL FOKUS ///////////////////////////////////////////////////// -->


<!-- //////////////////////////////////////////////////// MODAL IKK ///////////////////////////////////////////////////// -->
<!--MODAL TAMBAH IKK-->
<div class="modal fade" id="tambah_ikk-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Form Tambah IKK</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="form_add_ikk">
        <div class="modal-body form">
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_fokus">
            <input type="hidden" class="form-control" name="id_aspek_fokus">
            <div class="col-sm-2"><label class="control-label" for="title">Nama IKK</label></div>
            <div class="col-sm-10 float-right">
              <div class="table-responsive">
                <table class="table" id="dynamic_field_ikk">

                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" class="btn btn-info" onclick="simpan_ikk()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---->
<!-- EDIT FOKUS -->
<div class="modal fade" id="detail_ikk-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Input Detail IKK</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="" method="post" id="form_detail_ikk">
        <div class="modal-body form">
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_ikk">
            <div class="col-sm-2"><label class="control-label" for="title">Nama IKK</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Nama IKK" name="nama_ikk" id="nama_ikk"></div>
          </div>
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_ikk">
            <div class="col-sm-2"><label class="control-label" for="title">Rumus/Perhitungan</label></div>
            <div class="col-sm-10"><textarea name="keterangan_rumus" id="keterangan_rumus" rows="3" cols="80" class="form-control"></textarea></div>
          </div>
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_ikk">
            <div class="col-sm-2"><label class="control-label" for="title">Jenis Data</label></div>
            <div class="col-sm-10"><textarea name="jenis_data" id="jenis_data" rows="3" cols="80" class="form-control"></textarea></div>
          </div>
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_ikk">
            <div class="col-sm-2"><label class="control-label" for="title">Capaian Kinerja</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Capaian Kinerja" name="capaian_kinerja" id="capaian_kinerja"></div>
          </div>
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_ikk">
            <div class="col-sm-2"><label class="control-label" for="title">Keterangan</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Keterangan" name="keterangan" id="keterangan"></div>
          </div>
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_ikk">
            <div class="col-sm-2"><label class="control-label" for="title">OPD Pengampu</label></div>
            <div class="col-sm-10">
              <select class="form-control" name="id_user" id="id_user" required>
                <option value="" selected disabled>Pilih OPD Pengampu</option>
                <?php
                foreach ($pengampu as $val) {
                  echo "<option value='" .$val->id. "'>" . $val->nama . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row mb-2">
            <input type="hidden" class="form-control" name="id_edit_ikk">
            <div class="col-sm-2"><label class="control-label" for="title">Jenis Rumus</label></div>
            <div class="col-sm-10">
              <select class="form-control" name="id_rumus" id="id_rumus" required>
                <option value="" selected disabled> Pilih Rumus </option>
                <?php
                foreach ($rumus as $val) {
                  echo "<option value='" .$val->id. "'>" . $val->nama_rumus . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-lg-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title" style="float:none; text-align: center;">Contoh Form Rumus</h3>
                </div>
                <div class="card-body" id="contoh_rumus" style="pointer-events: none;">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnUpdateFokus" class="btn btn-success" onclick="edit_data_ikk()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---->


<!-- //////////////////////////////////////////////////// END MODAL FOKUS ///////////////////////////////////////////////////// -->



<script type="text/javascript">
  var url = "Aspek/ambil-data";
</script>
<?php  
$this->view('users/layout/footer');
?>
<script src="<?php echo base_url(); ?>services/AspekService.js"></script>
<script src="<?php echo base_url(); ?>services/FokusService.js"></script>
<script src="<?php echo base_url(); ?>services/IkkService.js"></script>
