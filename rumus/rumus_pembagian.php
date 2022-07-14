<form action="" method="post" id="form_pembagian">
  <div class="modal-body form">

    <div class="row mb-2">
      <table class="tab_rumus col-lg-12">
        <tbody>
          <tr>
            <td style="padding:5px 0px;">
              <div class="input-group">
                <input autocomplete="off" type="text" tabindex="1" class="form-control" id="pembilang" name="pembilang" value="" placeholder="Pembilang">
                <span class="input-group-addon"></span>
              </div>
            </td>
            <td rowspan="2" class="smdg">=</td>
            <td rowspan="2">
              <div class="input-group">
                <input readonly="" autocomplete="off" type="text" class="form-control" id="hasil_bagi" name="hasil_bagi" value="" placeholder="Hasil Bagi">
                <span class="input-group-addon" style=""> %</span>
              </div>
            </td>
          </tr>
          <tr>
            <td style="padding:5px 0px;border-top:2px solid #1e5d21;">
              <div class="input-group">
                <input autocomplete="off" type="text" tabindex="1" class="form-control" id="penyebut" name="penyebut" value="" placeholder="Penyebut">
                <span class="input-group-addon"></span>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-info" onclick="simpan_capaian()">Simpan</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
  </div>
</form>

<script type="text/javascript">
  set_value();

  $('#pembilang').on('input',function(){
    hitung_persen();
  });

  $('#penyebut').on('input',function(){
    hitung_persen();
  });

  function hitung_persen(){
    var value1 = parseInt($('#pembilang').val()) || 0;
    var value2 = parseInt($('#penyebut').val()) || 0;
    var hasil = (value1/value2)*100;
    $('#hasil_bagi').val(pembulatan(hasil,1));
  }

  function set_value(){
    var id = $("#capaian_kinerja-modal").find("input[name='id_ckm']").val();

    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var con_set = baseUrl+'/IkkMakroCon/ambil_capaian/'+id;

    $.ajax({
      dataType: 'json',
      url: con_set,
      success: function ( data) {
        // cek data JSON apa bukan
        if(isJson(data.data)){
          var val = JSON.parse(data.data);
          $("#form_pembagian").find("input[name='pembilang']").val(val.pembilang);
          $("#form_pembagian").find("input[name='penyebut']").val(val.penyebut);
          $("#form_pembagian").find("input[name='hasil_bagi']").val(val.hasil_bagi);
        }
        else {
          console.log('bukan JSON');
        }
      },
      error: function ( data ) {
        console.log('error');
      }
    });
  }

  function simpan_capaian(){

    var id = $("#capaian_kinerja-modal").find("input[name='id_ckm']").val();
    var pembilang = $("#form_pembagian").find("input[name='pembilang']").val();
    var penyebut = $("#form_pembagian").find("input[name='penyebut']").val();
    var hasil_bagi = $("#form_pembagian").find("input[name='hasil_bagi']").val();

    ///////////////////// URL UNTUK CONTROLLER //////////////////////////

    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var con_rumus = baseUrl+'/IkkMakroCon/input_capaian';

    /////////////////////// ARRAY UNTUK OPERASI /////////////////////

    const operasi = {
      nama: 'rumus_pembagian',
      pembilang: pembilang,
      penyebut: penyebut,
      hasil_bagi: hasil_bagi
    };

    var operasiJson = JSON.stringify(operasi);
    var form_data = new FormData();
    form_data.append('id', id);
    form_data.append('operasiJson', operasiJson);

    $.ajax({
      dataType: 'json',
      type:'POST',
      url: con_rumus,
      cache: false,
      contentType: false,
      processData: false,
      data:form_data,
      beforeSend: function () { $("#loading").show(); },
      success : function (data, status)
      {
        if(data.status != 'error')
        {
          $(".modal").modal('hide');
          location.reload();
          toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
        }
        else{
          toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
        }
      },
      complete: function () { $("#loading").hide(); } //<Hide Overlay
    })
  }
</script>