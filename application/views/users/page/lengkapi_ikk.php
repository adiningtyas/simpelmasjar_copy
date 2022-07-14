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
            
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width: 5%; vertical-align">No</th>
                  <th style="width: 20%; vertical-align">Nama IKK</th>
                  <th style="width: 20%; vertical-align">Jenis Data/Rumus</th>
                  <th style="width: 20%; vertical-align">Capaian Kinerja</th>
                  <th style="width: 20%; vertical-align">Keterangan</th>
                </tr>
              </thead>
              <tbody id="show_data">
                <?php
                $count=0; 
                foreach ($data_ikk as $val) { 
                  $count=$count+1;
                  ?>
                  <tr>
                    <td style="width: 5%; vertical-align"><?php echo $count; ?></td>
                    <td style="width: 20%; vertical-align"><?php echo $val->nama_ikk.' <div class="btn-group" role="group" aria-label="Basic example"><button class="btn btn-warning btn-xs" id="detail_ikk" title="Edit IKK" onclick="detail_ikk('."'".$val->id_ikk."'".')"><i class="fas fa-highlighter"></i></button></div> &nbsp;'; ?></td>
                    <td style="width: 20%; vertical-align"><?php if(!$val->id_rumus) { 
                      echo "Rumus Belum Diisi"; 
                    } 
                    else { 
                      echo '<br><div class="btn-group" role="group" aria-label="Basic example"><button class="btn btn-info btn-sm" id="input_capaian" title="Capaian Kinerja" onclick="input_capaian('."'".$val->id_ikk."'".')"><i class="fas fa-question-circle"></i></button> &nbsp;'.'<button class="btn btn-info btn-sm" title="Upload Bukti" onclick="upload_bukti('."'".$val->id_ikk."'".')"><i class="fas fa-upload"></i></button> &nbsp;'.'<button class="btn btn-info btn-sm" title="Keterangan" onclick="input_keterangan('."'".$val->id_ikk."'".')"><i class="fas fa-comment-dots"></i></button></div> &nbsp;' ;}; ?></td>
                      <td style="width: 20%; vertical-align"><?php echo $val->capaian_kinerja; ?></td>
                      <td style="width: 20%; vertical-align"><?php echo $val->keterangan; ?></td>
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

  <script type="text/javascript"> ////////////////////////////////// FUNCTION UNTUK PEMBULATAN //////////////////////////////////////////////
  function pembulatan(value, exp) {
    if (typeof exp === 'undefined' || +exp === 0)
      return Math.round(value);

    value = +value;
    exp = +exp;

    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
      return NaN;

  // Shift
  value = value.toString().split('e');
  value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

  // Shift back
  value = value.toString().split('e');
  return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
}
</script>

<!-- //////////////////////////////////////////////////// MODAL EDIT DETAIL IKK //////////////////////////////////////////////////////////// -->
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
            <div class="col-sm-2"><label class="control-label" for="title">Rumus/Perhitungan</label></div>
            <div class="col-sm-10"><textarea name="keterangan_rumus" id="keterangan_rumus" rows="3" cols="80" class="form-control"></textarea></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Jenis Data</label></div>
            <div class="col-sm-10"><textarea name="jenis_data" id="jenis_data" rows="3" cols="80" class="form-control"></textarea></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Capaian Kinerja</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Capaian Kinerja" name="capaian_kinerja" id="capaian_kinerja"></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">Keterangan</label></div>
            <div class="col-sm-10"><input class="form-control" type="text" placeholder="Keterangan" name="keterangan" id="keterangan"></div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-2"><label class="control-label" for="title">OPD Pengampu</label></div>
            <div class="col-sm-10">
              <select class="form-control" name="id_user" id="id_user" style="pointer-events: none;">
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
<!--////////////////////////////////////////////// END MODAL EDIT DETAIL IKK ///////////////////////////////////////////////////////////////////-->

<!-- ////////////////////////////////////////////////////////////// MODAL CAPAIAN KINERJA ////////////////////////////////////////////////////////// -->
<!--MODAL INPUT CAPAIAN-->
<div class="modal fade" id="capaian_kinerja-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-qibul">
        <h3 class="modal-title">Form Capaian Kinerja</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <input type="hidden" class="form-control" name="id_ikk">
      <div class="card-body" id="form_capaian">

      </div>
    </div>
  </div>
</div>
<!---->
<!-- ////////////////////////////////////////////////////////////// END CAPAIAN KINERJA ////////////////////////////////////////////////////////// -->


<script type="text/javascript">
  var url = "Aspek/ambil-data";
  
</script>
<?php  
$this->view('users/layout/footer');
?>
<script src="<?php echo base_url(); ?>services/LengkapiIKK.js"></script>