var table;

$(document).ready(function(){
  manageData();
  function manageData() {
    table = $('#example2').DataTable({
      'responsive': true,
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
              'tanggal' : data.data[i].tanggal,
              'status'  : data.data[i].isActive,
              //'kategori'  : data.data[i].nama_kategori,
              'action'  : data.data[i].action,
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
          {'data': 'tanggal'},
          {'data': 'judul'},
          //{'data': 'kategori'},
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
    var tanggal = $("#insert-modal").find("input[name='tanggal']").val();
    var judul = $("#insert-modal").find("input[name='judul']").val();
    var ins = document.getElementById('file').files.length;
    var file = document.getElementById('file').files;
    //var id_kategori = $('#tag').find(':selected').val();

  if(tanggal == '' || judul =='' || ins == 0)
  {
    toastr.error('Data Tidak Boleh Kosong', 'Error Alert', {timeOut: 5000});
  }
  else
  {
    size = validSize(file);
    // type = validType(file);
    // console.info("size :: "+size+" | type :: "+type);
    if(size == false)
      toastr.error('Ukuran File Tidak Boleh Lebih Dari 2MB', 'Error Alert', {timeOut: 5000});
    // else if(type == false)
    //   toastr.error('Type File Harus .jpg', 'Error Alert', {timeOut: 5000});
    // else if(size == false && type == false)
    //   toastr.error('Type File Harus .jpg dan Ukuran File Tidak Boleh Lebih Dari 2MB', 'Error Alert', {timeOut: 5000});
    else {
      //console.info("upload file");
      var form_data = new FormData();
      form_data.append('tanggal', tanggal);
      form_data.append('judul', judul);
      //form_data.append('id_kategori', id_kategori);
      for (var i = 0; i < ins; i++) {
        form_data.append("files[]", document.getElementById('file').files[i]);
      }
      $.ajax({
        dataType: 'json',
        type:'POST',
        url: 'galeri_foto/insert-data',
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
            $('#mySelect2').val(null).trigger('change');
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
}

function validSize(data)
{
  //console.info(data)
  var error = 0
  for(var i=0; i<data.length; i++)
  {
    if(data[i].size > 2097152)
      error +=1
  }

  if(error > 0)
    return false;
  else 
    return true;
}

function validType(data)
{
  var error = 0;
  var allowed_type = new Array("image/jpeg","image/pjpeg","image/png","image/x-png");
  for(var i = 0; i<data.length; i++)
  {
    if(data[i].type != allowed_type[0])
      error +=1;
  }

  if(error > 0)
    return false;
  else
    return true; 
}

function preview(id)
{
  $.ajax({
    dataType: 'json',
    url: 'galeri_foto/detail-galeri_foto/'+id,
    success: function (data) {
      var $index = 0;
      updateGallery(0,data.data)
      $('#show-next-image').click(function(){
        if($index < data.data.length - 1) $index++;
        updateGallery($index,data.data);
      });
      $('#show-previous-image').click(function(){
        if($index > 0) $index--;
        updateGallery($index,data.data);
      });
      $('#preview-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function updateGallery(selector, data) {
  var $sel = selector;
  $('#image-gallery-image').attr('src', data[$sel].imgpath);
  disableButtons(selector,data.length);
}

function disableButtons(counter_current,counter_max){
  $('#show-previous-image, #show-next-image').removeAttr("disabled");
  if(counter_current == counter_max-1){
    $('#show-next-image').attr("disabled", true);
  } else if (counter_current == 0){
    $('#show-previous-image').attr("disabled", true);
  }
}

function update(id)
{
  $.ajax({
    dataType: 'json',
    url: 'galeri_foto/edit-data/'+id,
    success: function ( data) {
      console.log("tes");
      $('#tanggal2').datepicker({format : 'yyyy-mm-dd'}).datepicker("setDate",'"'+data.data[0].tanggal+'"');
      $("#update-modal").find("input[name='judul']").val(data.data[0].judul);
      $("#update-modal").find("input[name='id']").val(data.data[0].id);
      //$("#update-modal").find('[name="tag2"]').val(data.data[0].id_kategori);
      $('#update-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function update_data()
{
  var tanggal = $("#update-modal").find("input[name='tanggal']").val();
  var judul = $("#update-modal").find("input[name='judul']").val();
  var id = $("#update-modal").find("input[name='id']").val();
  //var id_kategori = $('#tag2').val();
  // console.log($('#tag2').val());
  $.ajax({
    dataType: 'json',
    type:'POST',
    url: 'galeri_foto/update-data',
    data:{
      id:id,
      tanggal:tanggal,
      //id_kategori:id_kategori,
      judul:judul
    }
  }).done(function(data){
    if(data.status != 'error')
    {
      $(".modal").modal('hide');
      $("#update-modal").find("input[name='judul']").val('');
      $("#update-modal").find("input[name='id']").val('');
      $("#update-modal").find("input[name='tag2']").val('');
      reload_table();
      toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
    }
    else{
      toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
    }
  });
}

function hapus(id)
{
  $.ajax({
    dataType: 'json',
    url: 'galeri_foto/edit-data/'+id,
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
                url: 'galeri_foto/remove/'+id,
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
    url: 'galeri_foto/edit-data/'+id,
    success: function ( data) {
      console.log(data.data); //view the returned json in the console
      var judul = data.data[0].judul;
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
                url: 'galeri_foto/remove/'+id,
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


