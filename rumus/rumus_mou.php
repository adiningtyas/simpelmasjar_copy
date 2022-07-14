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