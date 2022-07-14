var kolom_ckm=1;
var count_ckm = 1;

$('#tambah_ckm-modal').on('hidden.bs.modal', function () {
  $('#contoh_rumus').empty();
  $('#form_detail_ckm').each(function(){
    this.reset();
  });
})

function isJson(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}

function reload_table()
{
  location.reload();
}

///////////////////////////////////////////////FUNGSI UNTUK TAMBAH CKM///////////////////////////////////////////////
///////////////////////////////////////////////FUNGSI UNTUK TAMBAH CKM///////////////////////////////////////////////

function simpan_ckm(){

  var nama_ckm            = $("#tambah_ckm-modal").find("input[name='nama_ckm']").val();
  var definisi            = $("#tambah_ckm-modal").find("textarea[name='definisi']").val();
  var jenis_data          = $("#tambah_ckm-modal").find("textarea[name='jenis_data']").val();
  var keterangan          = $("#tambah_ckm-modal").find("input[name='keterangan']").val();
  var id_user             = $("#tambah_ckm-modal").find("select[name='id_user']").val();
  var id_rumus            = $("#tambah_ckm-modal").find("select[name='id_rumus']").val();
  
  var form_data = new FormData();
  form_data.append('nama_ckm', nama_ckm);
  form_data.append('definisi', definisi);
  form_data.append('jenis_data', jenis_data);
  form_data.append('keterangan', keterangan);
  form_data.append('id_user', id_user);
  form_data.append('id_rumus', id_rumus);
  
  $.ajax({
    dataType: 'json',
    type:'POST',
    url: 'susun-ckm-makro/insert',
    cache: false,
    contentType: false,
    processData: false,
    data:form_data,
    beforeSend: function () { $("#loading").show(); },
    success : function (data, status)
    {
      if(data.status != 'error')
      {
        $('#form_detail_ckm').each(function(){
          this.reset();
        });
        $(".modal").modal('hide');
        reload_table();
        toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
      }
      else{
        toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
      }
    },
      complete: function () { $("#loading").hide(); } //<Hide Overlay
    })
}

function edit_ckm(id){
  console.log(id);
  $('#btnSave').hide();
  $('#btnSaveEdit').show();
  $.ajax({
    dataType: 'json',
    url: 'susun-ckm-makro/ambil-data-by-id/'+id,
    success: function ( data) {
      $("#tambah_ckm-modal").find("input[name='id_edit_ckm']").val(data.data[0].id);
      $("#tambah_ckm-modal").find("input[name='nama_ckm']").val(data.data[0].nama_ckm);
      $("#tambah_ckm-modal").find("textarea[name='definisi']").val(data.data[0].definisi);
      $("#tambah_ckm-modal").find("textarea[name='jenis_data']").val(data.data[0].jenis_data);
      $("#tambah_ckm-modal").find("input[name='keterangan']").val(data.data[0].keterangan);
      $("#tambah_ckm-modal").find("select[name='id_user']").val(data.data[0].id_user);
      $("#tambah_ckm-modal").find("select[name='id_rumus']").val(data.data[0].id_rumus);
      /////////// CONTOH FORM RUMUS /////////////
      cek_form_rumus(data.data[0].id_rumus);
      ///////////// END CONTOH FORM RUMUS ///////////////
      $('#tambah_ckm-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function capaian_kinerja(id){
  $.ajax({
    dataType: 'json',
    url: 'susun-ckm-makro/ambil-data-by-id/'+id,
    success: function ( data) {
      $("#capaian_kinerja-modal").find("input[name='id_ckm']").val(data.data[0].id);
      /////////// CONTOH FORM RUMUS /////////////

      get_form_rumus(data.data[0].id_rumus);

      ///////////// END CONTOH FORM RUMUS ///////////////
      $('#capaian_kinerja-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function get_form_rumus(id){
  var id = id;
  $.ajax({
    dataType: 'json',
    url: 'rumus/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      $('#form_capaian').empty();
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
      var url_rumus=baseUrl+'/rumus/'+data.data[0].form_rumus;
      
      $.get(url_rumus, function(data){
        $("#capaian_kinerja-modal").find("#form_capaian").html(data);
        // console.log(data);
      });
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function cek_form_rumus(id){
  var id = id;
  $.ajax({
    dataType: 'json',
    url: 'rumus/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      $('#contoh_rumus').empty();
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
      var url_rumus=baseUrl+'/rumus/'+data.data[0].form_rumus;
      
      $.get(url_rumus, function(data){
        $("#tambah_ckm-modal").find("#contoh_rumus").html(data);
      });
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

$('#id_rumus').on('change', function (e) {
  var id = $(this).val();
  $.ajax({
    dataType: 'json',
    url: 'rumus/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      $('#contoh_rumus').empty();
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
      var url_rumus=baseUrl+'/rumus/'+data.data[0].form_rumus;
      
      $.get(url_rumus, function(data){
        $("#tambah_ckm-modal").find("#contoh_rumus").html(data);
      });
    },
    error: function ( data ) {
      console.log('error');
    }
  });
});

function simpan_ckm_edit()
{
  console.log('tes');
  var id = $("#tambah_ckm-modal").find("input[name='id_edit_ckm']").val();
  var nama_ckm = $("#tambah_ckm-modal").find("input[name='nama_ckm']").val();
  var definisi = $("#tambah_ckm-modal").find("textarea[name='definisi']").val();
  var jenis_data = $("#tambah_ckm-modal").find("textarea[name='jenis_data']").val();
  var keterangan = $("#tambah_ckm-modal").find("input[name='keterangan']").val();
  var id_user        = $("#tambah_ckm-modal").find("select[name='id_user']").val();
  var id_rumus            = $("#tambah_ckm-modal").find("select[name='id_rumus']").val();
  
  var form_data = new FormData();
  form_data.append('id', id);
  form_data.append('nama_ckm', nama_ckm);
  form_data.append('definisi', definisi);
  form_data.append('jenis_data', jenis_data);
  form_data.append('keterangan', keterangan);
  form_data.append('id_user', id_user);
  form_data.append('id_rumus', id_rumus);
  
  $.ajax({
    dataType: 'json',
    type:'POST',
    url: 'susun-ckm-makro/edit-data/'+id,
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
        reload_table();
        toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
      }
      else{
        toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
      }
    },
      complete: function () { $("#loading").hide(); } //<Hide Overlay
    })
}

function hapus_ckm(id){
  $.ajax({
    dataType: 'json',
    url: 'susun-ckm-makro/ambil-data-by-id/'+id,
    success: function ( data) {
      var nama_ckm = data.data[0].nama_ckm;
      $.confirm({
        title : 'Hapus Data',
        content : 'Apakah Anda Yakin Untuk Menghapus : '+nama_ckm,
        buttons: {
          hapus: {
            btnClass: 'btn-blue',
            text:'Hapus',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'susun-ckm-makro/remove/'+id,
                data:{
                  id:id,
                  isActive:0
                }
              }).done(function(data){
                $(".modal").modal('hide');
                reload_table();
                toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
              });
            }
          },
          batal: {
            btnClass: 'btn-red any-other-class',
            text:'Batal'
          },
        }
      });   
    },
    error: function ( data ) {
      console.log('error');
    }
  });    
}

function modal_bukti(id){
  $("#upload_bukti-modal").find("input[name='id_ckm']").val(id);
  $('#upload_bukti-modal').modal('show');
}

function keterangan(id){
  $("#keterangan-modal").find("input[name='id_ckm']").val(id);
  $('#keterangan-modal').modal('show');
}

