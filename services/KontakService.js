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
                'no'              : data.data[i].no,
                'nama_opd'  : data.data[i].nama_opd,
                'alamat_opd': data.data[i].alamat_opd,
                'email_opd' : data.data[i].email_opd,
                'no_telp'         : data.data[i].no_telp,
                'peta_opd'         : data.data[i].peta_opd,
                'fb_opd'         : data.data[i].fb_opd,
                'ig_opd'         : data.data[i].ig_opd,
                'youtube_opd'         : data.data[i].youtube_opd,
                'wa_daftar_online'         : data.data[i].wa_daftar_online,
                'wa_saran_kritik'         : data.data[i].wa_saran_kritik,
                'wa_cs'         : data.data[i].wa_cs,
                'action'          : data.data[i].action,
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
          {'data': 'nama_opd'},
          {'data': 'alamat_opd'},
          {'data': 'email_opd'},
          {'data': 'no_telp'},
          {'data': 'peta_opd'},
          {'data': 'fb_opd'},
          {'data': 'ig_opd'},
          {'data': 'youtube_opd'},
          {'data': 'wa_daftar_online'},
          {'data': 'wa_saran_kritik'},
          {'data': 'wa_cs'},
          {'data': 'action'}
        ]
    });
  }
});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function update(id)
{
   $.ajax({
    dataType: 'json',
    url: 'kontak/ambil-data-by-id/'+id,
    success: function (data) {
      $("#update-modal").find("input[name='id']").val(data.data[0].id);
      $("#update-modal").find("input[name='nama_opd']").val(data.data[0].nama_opd);
      $("#update-modal").find("input[name='alamat_opd']").val(data.data[0].alamat_opd);
      $("#update-modal").find("input[name='email_opd']").val(data.data[0].email_opd);
      $("#update-modal").find("input[name='no_telp']").val(data.data[0].no_telp);
      $("#update-modal").find("input[name='peta_opd']").val(data.data[0].peta_opd);
      $("#update-modal").find("input[name='fb_opd']").val(data.data[0].fb_opd);
      $("#update-modal").find("input[name='ig_opd']").val(data.data[0].ig_opd);
      $("#update-modal").find("input[name='youtube_opd']").val(data.data[0].youtube_opd);
      $("#update-modal").find("input[name='wa_daftar_online']").val(data.data[0].wa_daftar_online);
      $("#update-modal").find("input[name='wa_saran_kritik']").val(data.data[0].wa_saran_kritik);
      $("#update-modal").find("input[name='wa_cs']").val(data.data[0].wa_cs);
      $("#update-modal").find("form").attr("action",'kontak/edit-data/'+id);
      $('#update-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function update_data()
{
    var form_action      = $("#update-modal").find("form").attr("action");
    var id               = $("#update-modal").find("input[name='id']").val();
    var nama_opd   = $("#update-modal").find("input[name='nama_opd']").val();
    var alamat_opd = $("#update-modal").find("input[name='alamat_opd']").val();
    var email_opd  = $("#update-modal").find("input[name='email_opd']").val();
    var no_telp          = $("#update-modal").find("input[name='no_telp']").val();
    var peta_opd          = $("#update-modal").find("input[name='peta_opd']").val();
    var fb_opd          = $("#update-modal").find("input[name='fb_opd']").val();
    var ig_opd          = $("#update-modal").find("input[name='ig_opd']").val();
    var youtube_opd          = $("#update-modal").find("input[name='youtube_opd']").val();
    var wa_daftar_online          = $("#update-modal").find("input[name='wa_daftar_online']").val();
    var wa_saran_kritik          = $("#update-modal").find("input[name='wa_saran_kritik']").val();
    var wa_cs          = $("#update-modal").find("input[name='wa_cs']").val();

    var form_data = new FormData();
    form_data.append('id', id);
    form_data.append('nama_opd', nama_opd);
    form_data.append('alamat_opd', alamat_opd);
    form_data.append('email_opd', email_opd);
    form_data.append('no_telp', no_telp);
    form_data.append('peta_opd', peta_opd);
    form_data.append('fb_opd', fb_opd);
    form_data.append('ig_opd', ig_opd);
    form_data.append('youtube_opd', youtube_opd);
    form_data.append('wa_daftar_online', wa_daftar_online);
    form_data.append('wa_saran_kritik', wa_saran_kritik);
    form_data.append('wa_cs', wa_cs);
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
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
            $("#update-modal").find("input[name='id']").val('');
            $("#update-modal").find("input[name='nama_opd']").val('');
            $("#update-modal").find("input[name='alamat_opd']").val('');
            $("#update-modal").find("input[name='email_opd']").val('');
            $("#update-modal").find("input[name='no_telp']").val('');
            $("#update-modal").find("input[name='peta_opd']").val('');
            $("#update-modal").find("input[name='fb_opd']").val('');
            $("#update-modal").find("input[name='ig_opd']").val('');
            $("#update-modal").find("input[name='youtube_opd']").val('');
            $("#update-modal").find("input[name='wa_daftar_online']").val('');
            $("#update-modal").find("input[name='wa_saran_kritik']").val('');
            $("#update-modal").find("input[name='wa_cs']").val('');
            toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
          }
          else{
            toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
          }
        },
        complete: function () { $("#loading").hide(); } //<Hide Overlay
    })
}


