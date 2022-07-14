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