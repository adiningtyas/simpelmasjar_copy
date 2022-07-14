var table;

$(document).ready(function(){
  manageData();
  function manageData() {
    table = $('#example2').DataTable({
     "responsive": true,
     "processing": true,
     'serverSide': true,
     "paging": true,
     "responsive": true,
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
            'no'        : data.data[i].no,
            'status'     : data.data[i].status,
            'isi'       : data.data[i].isi.substr(0, 100),
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
          {'data': 'status'},
          {'data': 'isi'},
          {'data': 'action'}
          ]
        });
  }
});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
  }

  function update(id){
    $.ajax({
      dataType: 'json',
      url: 'profil/ambil-data-by-id/'+id,
      success: function ( data) {
        $("#update-modal").find("input[name='id']").val(data.data[0].id);
        $("#update-modal").find("input[name='status']").val(data.data[0].status);
        CKEDITOR.instances.editor1.setData(data.data[0].isi);
        $('#update-modal').modal('show');
      },
      error: function ( data ) {
        console.log('error');
      }
    });
  }

  function update_data()
  {

    var status = $("#update-modal").find("input[name='status']").val();
    var id = $("#update-modal").find("input[name='id']").val();
    var isi = CKEDITOR.instances.editor1.getData();
    
    var form_data = new FormData();
    form_data.append('status', status);
    form_data.append('isi', isi);
    form_data.append('id', id);
    $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'profil/edit-data/'+id,
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


  function detail(id){
    $.ajax({
      dataType: 'json',
      url: 'profil/ambil-data-by-id/'+id,
      success: function ( data) {
        $("#title h4").text(data.data[0].status);
        $("#uisi").html(''+data.data[0].isi+'');
        $('#detail-modal').modal('show');
      },
      error: function ( data ) {
        console.log('error');
      }
    });
  }

  function detail_url(id){
    $.ajax({
      dataType: 'json',
      url: 'profil/ambil-data-by-id/'+id,
      success: function ( data) {
        $("#update-url").find("input[name='id']").val(data.data[0].id);
        $("#update-url").find("input[name='filepath']").val(data.data[0].filepath);
        $('#update-url').modal('show');
      },
      error: function ( data ) {
        console.log('error');
      }
    });
  }

  function update_url()
  {

    var id = $("#update-url").find("input[name='id']").val();
    var filepath = $("#update-url").find("input[name='filepath']").val();
    
    var form_data = new FormData();
    form_data.append('filepath', filepath);
    form_data.append('id', id);
    $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'profil/edit-data/'+id,
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