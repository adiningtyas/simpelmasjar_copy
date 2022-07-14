var kolom_ikk=1;
var count_ikk = 1;

$('#detail_ikk-modal').on('hidden.bs.modal', function () {
  $('#contoh_rumus').empty();
})

function reload_table()
{
  location.reload();
}

///////////////////////////////////////////////FUNGSI UNTUK TAMBAH IKK///////////////////////////////////////////////
///////////////////////////////////////////////FUNGSI UNTUK TAMBAH IKK///////////////////////////////////////////////
function tambah_ikk(id){
  $.ajax({
    dataType: 'json',
    url: 'ikk-31/ambil-data-by-id-fokus/'+id,
    success: function ( data) {
      $("#dynamic_field_ikk").html("");
      add_kolom_ikk(1);
      console.log(id);
      $("#tambah_ikk-modal").find("input[name='id_fokus']").val(id);
      $("#tambah_ikk-modal").find("input[name='id_aspek_fokus']").val(data.data[0].id_aspek);
      $('#tambah_ikk-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function simpan_ikk(id){
  var total_file = 0;
  var form_data = new FormData();

  var id = $("#tambah_ikk-modal").find("input[name='id_fokus']").val();
  var id_aspek = $("#tambah_ikk-modal").find("input[name='id_aspek_fokus']").val();
  $(".name_ikk").each(function(){
   if($(this).val() != null)
   {
     total_file = total_file + 1;
     form_data.append("keterangan_ikk"+total_file,$(this).val());
   }
 });

  form_data.append("id_fokus", id);
  form_data.append("id_aspek", id_aspek);

  $.ajax({
    dataType: "json",
    type:"POST",
    url: "ikk-31/insert-ikk",
    cache: false,
    contentType: false,
    processData: false,
    data:form_data,
    success : function (data, status)
    {
      if(data.status != "error")
      {
            $("#form_add_ikk")[0].reset(); // reset form on modals
            $('.modal').modal("hide");
            location.reload();
            toastr.success(data.msg, "Success Alert", {timeOut: 5000});
            toastr.success("Item Created Successfully.", "Success Alert", {timeOut: 5000});
          }
          else{
            toastr.error(data.msg, "Error Alert", {timeOut: 5000});
          }
        }
      })
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
  console.log('tes');
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

function get_gambar(){
  var id_ikk=$("#id_post").val();
    // console.log(id);
    $.ajax({
      url : "../BeritaFotoController/get_gambar",
      method : 'POST',
      data : {id_ikk: id_ikk},
      async : true,
      dataType : "json",
      success: function(data){
        var i = 1;
        $("#data_gambar").empty();
        kolom_ikk=data.length;
        $.each(data, function(key, value) {
          update_kolom_ikk(i++,value);
        });
      }
    });
    return false;
  }

  function update_kolom_ikk(kolom_ikk,value)
  {
    var button_ikk = "";
    if(kolom_ikk > 1)
    {
      if(typeof value.imgpath !== "undefined"){
        button_ikk = "<button type='button' name='delete' id='"+value.id+"' class='btn btn-danger btn-lg delete'><i class='fa fa-trash-o'></i></button>";
      }
      else{
        button_ikk = "<button type='button' name='remove' id='"+kolom_ikk+"' class='btn btn-danger btn-lg remove'>x</button>";
      }
    }
    else
    {
      button_ikk = "<button type='button' name='add_update' id='add_update' class='btn btn-success btn-lg'>+</button>";
    }
    if(typeof value.imgpath !== "undefined"){
      output = "<tr id='row"+kolom_ikk+"'>";
      output += "<td><div class='row'><div class='col-md-12'><input type='hidden' class='form-control id_ikk' name='id_ikk"+kolom_ikk+"' id='id_ikk"+kolom_ikk+"' value='"+value.id+"'/><input type='text' name='keterangan_ikk"+kolom_ikk+"' placeholder='Nama ikk' class='form-control name_ikk' value='"+value.caption+"'/></div></div></td>";
      output += "<td align='center'>"+button_ikk+"</td></tr>";
    }
    else{
      output = "<tr id='row"+kolom_ikk+"'>";
      output += "<td><div class='row'><div class='col-md-12'><input type='hidden' class='form-control id_ikk' name='id_ikk"+kolom_ikk+"' id='id_ikk"+kolom_ikk+"'/><input type='text' name='keterangan_ikk"+kolom_ikk+"' placeholder='Nama ikk' class='form-control name_ikk' /></div></div></td>";
      output += "<td align='center'>"+button_ikk+"</td></tr>";
    }

    $("#data_gambar").append(output);
    $("#kolom_ikk").val(kolom_ikk);
  }

  function add_kolom_ikk(count_ikk)
  {
    var button_ikk = "";
    if(count_ikk > 1)
    {
      button_ikk = "<button type='button' name='remove' id='"+count_ikk+"' class='btn btn-danger btn-lg remove'>x</button>";
    }
    else
    {
      button_ikk = "<button type='button' name='add_more' id='add_more' class='btn btn-success btn-lg'>+</button>";
    }
    output = "<tr id='row"+count_ikk+"'>";
    output += "<td><div class='row'><div class='col-md-12'><input type='text' name='keterangan_ikk"+count_ikk+"' placeholder='Nama ikk' class='form-control name_ikk' /></div></div></td>";
    output += "<td align='center'>"+button_ikk+"</td></tr>";
    $("#dynamic_field_ikk").append(output);
  }


  $(document).on("click", "#add_more", function(){
    count_ikk = count_ikk + 1;
    kolom_ikk=kolom_ikk+1;
    add_kolom_ikk(count_ikk);
    // update_kolom_ikk(kolom_ikk, {});
  });

  $(document).on("click", "#add_update", function(){
    count_ikk = count_ikk + 1;
    kolom_ikk=kolom_ikk+1;
    update_kolom_ikk(kolom_ikk, {});
  });

  $(document).on("click", ".remove", function(){
    count_ikk = count_ikk - 1;
    var row_id_ikk = $(this).attr('id');
    $("#row"+row_id_ikk).remove();
  });

  function hapus_ikk(id){
    $.ajax({
      dataType: 'json',
      url: 'ikk-31/ambil-data-by-id-ikk/'+id,
      success: function ( data) {
        var nama_ikk = data.data[0].nama_ikk;
        $.confirm({
          title : 'Hapus Data',
          content : 'Apakah Anda Yakin Untuk Menghapus : '+nama_ikk,
          buttons: {
            hapus: {
              btnClass: 'btn-blue',
              text:'Hapus',
              action: function(){
                $.ajax({
                  dataType: 'json',
                  type:'POST',
                  url: 'ikk-31/remove_ikk/'+id,
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