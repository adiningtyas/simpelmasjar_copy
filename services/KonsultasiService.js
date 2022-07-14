var table;

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
          'url': 'konsultasi/ambil-data',
          dataSrc: function(data)
          {
            var return_data = new Array();
              for(var i=0;i< data.data.length; i++){
              return_data.push({
                'no'        : data.data[i].no,
                'nama'     : data.data[i].nama,
                'jabatan'     : data.data[i].jabatan,
                'jam_konsul'     : data.data[i].jam_konsul,
                'no_hp'     : data.data[i].no_hp,
                'status'    : data.data[i].isActive,
                'gambar'      : data.data[i].gambar,
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
          {'data': 'nama'},
          {'data': 'jabatan'},
          {'data': 'jam_konsul'},
          {'data': 'no_hp'},
          {'data': 'gambar'},
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
  var nama = $("#insert-modal").find("input[name='nama']").val();
  var jabatan = $("#insert-modal").find("input[name='jabatan']").val();
  var jam_konsul = $("#insert-modal").find("input[name='jam_konsul']").val();
  var no_hp = $("#insert-modal").find("input[name='no_hp']").val();
  var file_data = $('#file')[0].files[0];
          
  if(file_data == "" || nama == "")
  {
    toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
  }
  else {
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('nama', nama);
    form_data.append('jabatan', jabatan);
    form_data.append('jam_konsul', jam_konsul);
    form_data.append('no_hp', no_hp);
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: 'konsultasi/insert-data',
        cache: false,
        contentType: false,
        processData: false,
        data:form_data,
        beforeSend: function () { $("#loading").show(); },
        success : function (data, status)
        {
          if(data.status != 'error')
          {
            $("#insert-modal").find("input[name='nama']").val('');
            $("#insert-modal").find("input[name='jabatan']").val('');
            $("#insert-modal").find("input[name='jam_konsul']").val('');
            $("#insert-modal").find("input[name='no_hp']").val('');
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
    url: 'konsultasi/ambil-data-by-id/'+id,
    success: function ( data) {
      $("#update-modal").find("input[name='nama2']").val(data.data[0].nama);
      $("#update-modal").find("input[name='jabatan2']").val(data.data[0].jabatan);
      $("#update-modal").find("input[name='jam_konsul2']").val(data.data[0].jam_konsul);
      $("#update-modal").find("input[name='no_hp2']").val(data.data[0].no_hp);
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
  var nama = $("#update-modal").find("input[name='nama2']").val();
  var jabatan = $("#update-modal").find("input[name='jabatan2']").val();
  var jam_konsul = $("#update-modal").find("input[name='jam_konsul2']").val();
  var no_hp = $("#update-modal").find("input[name='no_hp2']").val();
  var id = $("#update-modal").find("input[name='id']").val();
  var file_data = $('#file2')[0].files[0];

  var form_data = new FormData();
  form_data.append('file', file_data);
  form_data.append('nama', nama);
  form_data.append('jabatan', jabatan);
  form_data.append('jam_konsul', jam_konsul);
  form_data.append('no_hp', no_hp);
  form_data.append('id', id);
  $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'konsultasi/edit-data/'+id,
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
          $("#update-modal").find("input[name='file2']").val('');
          $("#update-modal").find("select[name='nama2']").val('');
          $("#update-modal").find("select[name='jabatan2']").val('');
          $("#update-modal").find("select[name='jam_konsul2']").val('');
          $("#update-modal").find("select[name='no_hp2']").val('');
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
    url: 'konsultasi/ambil-data-by-id/'+id,
    success: function ( data) {
      //console.log(data.data); //view the returned json in the console
      var nama = data.data[0].nama;
      var isactive = data.data[0].isActive;
      $.confirm({
        title : 'Hapus Data',
        content : 'Apakah Anda Yakin Untuk Menghapus Data : '+nama,
        buttons: {
        hapus: {
            btnClass: 'btn-blue',
            text:'Hapus',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'konsultasi/remove/'+id,
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

function activate(id){
  $.ajax({
    dataType: 'json',
    url: 'konsultasi/ambil-data-by-id/'+id,
    success: function ( data) {
      //console.log(data.data); //view the returned json in the console
      var nama = data.data[0].nama;
      var isactive = data.data[0].isActive;
      $.confirm({
        title : 'Aktifkan Data',
        content : 'Apakah Anda Yakin Untuk Mengaktifkan Kembali Data : '+nama,
        buttons: {
        hapus: {
            btnClass: 'btn-blue',
            text:'Aktifkan',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'konsultasi/remove/'+id,
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