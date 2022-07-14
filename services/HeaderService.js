
$(document).ready(function(){
manageData();
  function manageData() {
    table = $('#example2').DataTable({
      "responsive": true,
        "processing": true,
        'serverSide': true,
        "paging": true,
        "lengthChange": false,
        "ordering": false,
        'ajax': {
          'type': 'POST',
          'url': 'gambar-header/ambil-data',
          dataSrc: function(data)
          {
            var return_data = new Array();
              for(var i=0;i< data.data.length; i++){
              return_data.push({
                'no'        : data.data[i].no,
                'judul'     : data.data[i].judul,
                'author'    : data.data[i].author,
                'status'    : data.data[i].isActive,
                'action'    : data.data[i].action,
              })
            }
            return return_data;
          }
        },
           "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
        "columns"    : [
          {'data': 'no'},
          {'data': 'judul'},
          {'data': 'author'},
          {'data': 'status'},
          {'data': 'action'}
        ]
    });
  }
});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function insert()
{
  var judul = $("#insert-modal").find("input[name='judul']").val();
  var file_data = $('#file')[0].files[0];
          
  if(file_data == "" || judul == "")
  {
    toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
  }
  else {
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('judul', judul);
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: 'gambar-header/insert-data',
        cache: false,
        contentType: false,
        processData: false,
        data:form_data,
        beforeSend: function () { $("#loading").show(); },
        success : function (data, status)
        {
          if(data.status != 'error')
          {
            $("#insert-modal").find("input[name='judul']").val('');
            $("#insert-modal").find("input[name='file']").val('');
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
}

function update(id)
{
  $.ajax({
    dataType: 'json',
    url: 'gambar-header/ambil-data-by-id/'+id,
    success: function ( data) {
      $("#update-modal").find("input[name='judul']").val(data.data[0].judul);
      $("#update-modal").find("input[name='id']").val(data.data[0].id);
      $('#update-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function update_data()
{
  var judul = $("#update-modal").find("input[name='judul']").val();
  var id = $("#update-modal").find("input[name='id']").val();
  var file_data = $('#file2')[0].files[0];

  var form_data = new FormData();
  form_data.append('file', file_data);
  form_data.append('judul', judul);
  form_data.append('id', id);
  $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'gambar-header/edit-data/'+id,
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
          $("#update-modal").find("input[name='judul']").val('');
          $("#update-modal").find("input[name='file']").val('');
          toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
        }
        else{
          toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
        }
      },
      complete: function () { $("#loading").hide(); } //<Hide Overlay
  })
}

function hapus(id)
{
  $.ajax({
    dataType: 'json',
    url: 'gambar-header/ambil-data-by-id/'+id,
    success: function ( data) {
      //console.log(data.data); //view the returned json in the console
      var judul = data.data[0].judul;
      var isactive = data.data[0].isActive;
      $.confirm({
        title : 'Hapus Data',
        content : 'Apakah Anda Yakin Untuk Menghapus Data : '+judul,
        buttons: {
        hapus: {
            btnClass: 'btn-blue',
            text:'Hapus',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'gambar-header/remove/'+id,
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

function activate(id)
{
  $.ajax({
    dataType: 'json',
    url: 'gambar-header/ambil-data-by-id/'+id,
    success: function ( data) {
      //console.log(data.data); //view the returned json in the console
      var judul = data.data[0].judul;
      var isactive = data.data[0].isActive;
      $.confirm({
        title : 'Hapus Data',
        content : 'Apakah Anda Yakin Untuk Mengaktifkan Data : '+judul,
        buttons: {
        hapus: {
            btnClass: 'btn-blue',
            text:'Aktifkan',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'gambar-header/remove/'+id,
                data:{
                  id:id,
                  isActive:1
                }
              }).done(function(data){
                $(".modal").modal('hide');
                reload_table();
                toastr.success('Item Activated Successfully.', 'Success Alert', {timeOut: 5000});
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