
function reload_table()
{
  location.reload(true);
}

function insert()
{
  var nama_rumus = $("#insert-modal").find("input[name='nama_rumus']").val();
  var keterangan = $("#insert-modal").find("input[name='keterangan']").val();
  var form_rumus = $("#insert-modal").find("select[name='form_rumus']").val();

  if(nama_rumus == "" || keterangan == "")
  {
    toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
  }
  else {
    var form_data = new FormData();
    form_data.append('nama_rumus', nama_rumus);
    form_data.append('keterangan', keterangan);
    form_data.append('form_rumus', form_rumus);
    
    $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'rumus/insert-rumus',
      cache: false,
      contentType: false,
      processData: false,
      data:form_data,
      beforeSend: function () { $("#loading").show(); },
      success : function (data, status)
      {
        if(data.status != 'error')
        {
          $("#insert-modal").find("input[name='nama_rumus']").val('');
          $("#insert-modal").find("input[name='keterangan']").val(''); 
          $("#insert-modal").find("select[name='form_rumus']").val(''); 
          $(".modal").modal('hide');
          reload_table();
          toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
          toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
        }
        else{
          toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
        }
      },
        complete: function () { $("#loading").hide(); } //<Hide Overlay
      })
  }
}

function detail_rumus(id){
  $.ajax({
    dataType: 'json',
    url: 'rumus/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
      var url_rumus=baseUrl+'/rumus/'+data.data[0].form_rumus;
      console.log(url_rumus);
      $.get(url_rumus, function(data){
        $('#contoh_rumus').html(data);
      });
      $('#detail-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function update(id){
  $.ajax({
    dataType: 'json',
    url: 'rumus/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      $("#update-modal").find("input[name='id_rumus']").val(data.data[0].id);
      $("#update-modal").find("input[name='nama_rumus']").val(data.data[0].nama_rumus);
      $("#update-modal").find("input[name='keterangan']").val(data.data[0].keterangan);
      $("#update-modal").find("select[name='form_rumus']").val(data.data[0].form_rumus);
      $('#update-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function update_data()
{
  console.log('tes');
  var id = $("#update-modal").find("input[name='id_rumus']").val();
  var nama_rumus = $("#update-modal").find("input[name='nama_rumus']").val();
  var keterangan = $("#update-modal").find("input[name='keterangan']").val();
  var form_rumus = $("#update-modal").find("select[name='form_rumus']").val();

  var form_data = new FormData();
  form_data.append('id', id);
  form_data.append('nama_rumus', nama_rumus);
  form_data.append('keterangan', keterangan);
  form_data.append('form_rumus', form_rumus);
  
  $.ajax({
    dataType: 'json',
    type:'POST',
    url: 'rumus/edit-data-rumus/'+id,
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

function hapus(id){
  $.ajax({
    dataType: 'json',
    url: 'rumus/ambil-data-by-id-rumus/'+id,
    success: function ( data) {
      var nama_rumus = data.data[0].nama_rumus;
      $.confirm({
        title : 'Hapus Data',
        content : 'Apakah Anda Yakin Untuk Menghapus : '+nama_rumus,
        buttons: {
          hapus: {
            btnClass: 'btn-blue',
            text:'Hapus',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'rumus/remove_rumus/'+id,
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
