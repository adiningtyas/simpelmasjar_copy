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
          'url': url,
          dataSrc: function(data)
          {
            var return_data = new Array();
              for(var i=0;i< data.data.length; i++){
              return_data.push({
                'no'      : data.data[i].no,
                'judul'   : data.data[i].judul,
                'icon'    : data.data[i].icon,
                'layanan' : data.data[i].layanan,
                'nama'    : data.data[i].nama,
                'status'  : data.data[i].isActive,
                'action'  : data.data[i].action
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
          {'data': 'icon'},
          {'data': 'layanan'},
          {'data': 'nama'},
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
  var judul    = $("#insert-modal").find("input[name='judul']").val();
  var icon     = $("#insert-modal").find("select[name='icon']").val();
  var layanan  = CKEDITOR.instances.editor1.getData();
          
  if(judul == "" || icon == "" || layanan == "")
  {
    toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
  }
  else {
    var form_data = new FormData();
    form_data.append('judul', judul);
    form_data.append('icon', icon);
    form_data.append('layanan', layanan);
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: 'layanan/insert-data',
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
            $("#insert-modal").find("select[name='icon']").val(''); 
            CKEDITOR.instances.editor1.setData('');
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

function detail(id){
  $.ajax({
    dataType: 'json',
    url: 'layanan/ambil-data-by-id/'+id,
    success: function ( data) {
      $("#title h4").text(data.data[0].judul);
      $("#title #oleh").text('Oleh : '+data.data[0].nama);
      $("#title #tanggal").text(data.data[0].tanggal);
      $("#uisi").html(''+data.data[0].layanan+'');
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
    url: 'layanan/ambil-data-by-id/'+id,
    success: function ( data) {
      $("#update-modal").find("input[name='id']").val(data.data[0].id);
      $("#update-modal").find("input[name='judul']").val(data.data[0].judul);
      $("#update-modal").find("select[name='icon']").val(data.data[0].icon);
      CKEDITOR.instances.editor2.setData(data.data[0].layanan);
      $('#update-modal').modal('show');
      
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function update_data()
{
  var id      = $("#update-modal").find("input[name='id']").val();
  var judul   = $("#update-modal").find("input[name='judul']").val();
  var icon    = $("#update-modal").find("select[name='icon']").val();
  var layanan = CKEDITOR.instances.editor2.getData();

  var form_data = new FormData();
  form_data.append('id', id);
  form_data.append('judul', judul);
  form_data.append('icon', icon);
  form_data.append('layanan', layanan);
  $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'layanan/edit-data/'+id,
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
    url: 'layanan/ambil-data-by-id/'+id,
    success: function ( data) {
      //console.log(data.data); //view the returned json in the console
      var judul    = data.data[0].judul;
      var isactive = data.data[0].isActive;
      $.confirm({
        title : 'Hapus Data',
        content : 'Apakah Anda Yakin Untuk Menonaktifkan Data : '+judul,
        buttons: {
        hapus: {
            btnClass: 'btn-blue',
            text:'Hapus',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'layanan/remove/'+id,
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
    url: 'layanan/ambil-data-by-id/'+id,
    success: function ( data) {
      //console.log(data.data); //view the returned json in the console
      var judul    = data.data[0].judul;
      var isactive = data.data[0].isActive;
      $.confirm({
        title : 'Aktifkan Data',
        content : 'Apakah Anda Yakin Untuk Mengaktifkan Kembali Data : '+judul,
        buttons: {
        hapus: {
            btnClass: 'btn-blue',
            text:'Aktifkan',
            action: function(){
              $.ajax({
                dataType: 'json',
                type:'POST',
                url: 'layanan/activate/'+id,
                data:{
                  id:id,
                  isActive:0
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

function hapus_permanen(id){
  $.ajax({
    dataType: 'json',
    url: 'layanan/ambil-data-by-id/'+id,
    success: function ( data) {
      //console.log(data.data); //view the returned json in the console
      var judul = data.data[0].judul;
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
                url: 'layanan/remove_data/'+id,
                data:{
                  id:id
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

