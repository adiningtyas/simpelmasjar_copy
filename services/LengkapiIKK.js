
function reload_table()
{
    location.reload(); //reload datatable ajax 
  }

  function input_capaian(id){
    $.ajax({
      dataType: 'json',
      url: 'ikk-31/ambil-data-by-id-ikk/'+id,
      success: function ( data) {
        $("#capaian_kinerja-modal").find("input[name='id_ikk']").val(data.data[0].id);
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
    url: 'rumus-ikk/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      $('#contoh_rumus').empty();
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
      var url_rumus=baseUrl+'/rumus/'+data.data[0].form_rumus;
      
      $.get(url_rumus, function(data){
        $("#capaian_kinerja-modal").find("#form_capaian").html(data);
      });
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

  function detail_ikk(id){
  // console.log(id);
  $.ajax({
    dataType: 'json',
    url: 'ikk-31/ambil-data-by-id-ikk/'+id,
    success: function ( data) {
      $("#detail_ikk-modal").find("input[name='id_edit_ikk']").val(data.data[0].id);
      $("#detail_ikk-modal").find("input[name='nama_ikk']").val(data.data[0].nama_ikk);
      $("#detail_ikk-modal").find("textarea[name='keterangan_rumus']").val(data.data[0].keterangan_rumus);
      $("#detail_ikk-modal").find("textarea[name='jenis_data']").val(data.data[0].jenis_data);
      $("#detail_ikk-modal").find("input[name='keterangan']").val(data.data[0].keterangan);
      $("#detail_ikk-modal").find("input[name='capaian_kinerja']").val(data.data[0].capaian_kinerja);
      $("#detail_ikk-modal").find("select[name='id_user']").val(data.data[0].id_user);
      $("#detail_ikk-modal").find("select[name='id_rumus']").val(data.data[0].id_rumus);
      /////////// CONTOH FORM RUMUS /////////////
      cek_form_rumus(data.data[0].id_rumus);
      ///////////// END CONTOH FORM RUMUS ///////////////
      $('#detail_ikk-modal').modal('show');
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
    url: 'rumus-ikk/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      $('#contoh_rumus').empty();
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
      var url_rumus=baseUrl+'/rumus/'+data.data[0].form_rumus;
      
      $.get(url_rumus, function(data){
        $("#detail_ikk-modal").find("#contoh_rumus").html(data);
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
    url: 'rumus-ikk/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      $('#contoh_rumus').empty();
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
      var url_rumus=baseUrl+'/rumus/'+data.data[0].form_rumus;
      
      $.get(url_rumus, function(data){
        $("#detail_ikk-modal").find("#contoh_rumus").html(data);
      });
    },
    error: function ( data ) {
      console.log('error');
    }
  });
});

function edit_data_ikk()
{
  var id = $("#detail_ikk-modal").find("input[name='id_edit_ikk']").val();
  var nama_ikk = $("#detail_ikk-modal").find("input[name='nama_ikk']").val();
  var keterangan_rumus = $("#detail_ikk-modal").find("textarea[name='keterangan_rumus']").val();
  var jenis_data = $("#detail_ikk-modal").find("textarea[name='jenis_data']").val();
  var keterangan = $("#detail_ikk-modal").find("input[name='keterangan']").val();
  var capaian_kinerja = $("#detail_ikk-modal").find("input[name='capaian_kinerja']").val();
  var id_user        = $("#detail_ikk-modal").find("select[name='id_user']").val();
  var id_rumus            = $("#detail_ikk-modal").find("select[name='id_rumus']").val();
  
  var form_data = new FormData();
  form_data.append('id', id);
  form_data.append('nama_ikk', nama_ikk);
  form_data.append('keterangan_rumus', keterangan_rumus);
  form_data.append('jenis_data', jenis_data);
  form_data.append('keterangan', keterangan);
  form_data.append('capaian_kinerja', capaian_kinerja);
  form_data.append('id_user', id_user);
  form_data.append('id_rumus', id_rumus);
  
  $.ajax({
    dataType: 'json',
    type:'POST',
    url: 'ikk-31/edit-data-ikk/'+id,
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