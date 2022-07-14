$('#tambah_aspek-modal').on('hidden.bs.modal', function () {
  $('#btnSaveAspek').show();
  $('#btnUpdateAspek').hide();
})

function insert()
{
  var nama_aspek = $("#tambah_aspek-modal").find("input[name='nama_aspek']").val();

  if(nama_aspek == "")
  {
    toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
  }
  else {
    var form_data = new FormData();
    form_data.append('nama_aspek', nama_aspek);
    $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'ikk-31/insert-aspek',
      cache: false,
      contentType: false,
      processData: false, 
      data:form_data,
      beforeSend: function () { $("#loading").show(); },
      success : function (data, status)
      {
        if(data.status != 'error')
        {
          $("#tambah_aspek-modal").find("input[name='nama_aspek']").val('');
          $(".modal").modal('hide');
          location.reload();
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

function edit_aspek(id){
  $.ajax({
    dataType: 'json',
    url: 'ikk-31/ambil-data-by-id-aspek/'+id,
    success: function ( data) {
      $('#btnSaveAspek').hide();
      $('#btnUpdateAspek').show();
      $("#tambah_aspek-modal").find("input[name='id_edit_aspek']").val(data.data[0].id);
      $("#tambah_aspek-modal").find("input[name='nama_aspek']").val(data.data[0].nama_aspek);
      $('#tambah_aspek-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function edit_data_aspek()
{
  var id_aspek = $("#tambah_aspek-modal").find("input[name='id_edit_aspek']").val();
  var nama_aspek = $("#tambah_aspek-modal").find("input[name='nama_aspek']").val();

  if(nama_aspek == "")
  {
    toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
  }
  else {
    var form_data = new FormData();
    form_data.append('nama_aspek', nama_aspek);
    form_data.append('id_aspek', id_aspek);
    $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'ikk-31/edit-data-aspek/'+id_aspek,
      cache: false,
      contentType: false,
      processData: false, 
      data:form_data,
      beforeSend: function () { $("#loading").show(); },
      success : function (data, status)
      {
        if(data.status != 'error')
        {
          $("#tambah_aspek-modal").find("input[name='nama_aspek']").val('');
          $(".modal").modal('hide');
          location.reload();
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

function hapus_aspek(id){
  $.ajax({
    dataType: 'json',
    url: 'ikk-31/ambil-data-by-id-aspek/'+id,
    success: function ( data) {
      var nama_aspek = data.data[0].nama_aspek;
      $.confirm({
        title : 'Hapus Data',
        content : 'Apakah Anda Yakin Untuk Menghapus : '+nama_aspek,
        buttons: {
          hapus: {
            btnClass: 'btn-blue',
            text:'Hapus',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'ikk-31/remove_aspek/'+id,
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