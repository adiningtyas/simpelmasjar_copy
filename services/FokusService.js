var kolom_fokus=1;
var count_fokus = 1;

function reload_table()
{
  location.reload();
}

///////////////////////////////////////////////FUNGSI UNTUK TAMBAH FOKUS///////////////////////////////////////////////
///////////////////////////////////////////////FUNGSI UNTUK TAMBAH FOKUS///////////////////////////////////////////////
function tambah_fokus(id){
  $("#dynamic_field").html("");
  add_kolom_fokus(1);
  $("#tambah_fokus-modal").find("input[name='id_aspek']").val(id);
  $('#tambah_fokus-modal').modal('show');
  console.log(count_fokus);
}

function simpan_fokus(id){
  var total_file = 0;
  var form_data = new FormData();

  var id = $("#tambah_fokus-modal").find("input[name='id_aspek']").val();
  $(".name_fokus").each(function(){
   if($(this).val() != null)
   {
     total_file = total_file + 1;
         // console.log($(this).val());
         form_data.append("keterangan_fokus"+total_file,$(this).val());
       }
     });

  form_data.append("id_aspek", id);

  $.ajax({
    dataType: "json",
    type:"POST",
    url: "ikk-31/insert-fokus",
    cache: false,
    contentType: false,
    processData: false,
    data:form_data,
    success : function (data, status)
    {
      if(data.status != "error")
      {
            $("#form_add_fokus")[0].reset(); // reset form on modals
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

function edit_fokus(id){
  $.ajax({
    dataType: 'json',
    url: 'ikk-31/ambil-data-by-id-fokus/'+id,
    success: function ( data) {
      $("#edit_fokus-modal").find("input[name='id_edit_fokus']").val(data.data[0].id);
      $("#edit_fokus-modal").find("input[name='nama_fokus']").val(data.data[0].nama_fokus);
      $('#edit_fokus-modal').modal('show');
    },
    error: function ( data ) {
      console.log('error');
    }
  });
}

function edit_data_fokus()
{
  var id_fokus = $("#edit_fokus-modal").find("input[name='id_edit_fokus']").val();
  var nama_fokus = $("#edit_fokus-modal").find("input[name='nama_fokus']").val();

  if(nama_fokus == "")
  {
    toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
  }
  else {
    var form_data = new FormData();
    form_data.append('nama_fokus', nama_fokus);
    form_data.append('id_fokus', id_fokus);
    $.ajax({
      dataType: 'json',
      type:'POST',
      url: 'ikk-31/edit-data-fokus/'+id_fokus,
      cache: false,
      contentType: false,
      processData: false, 
      data:form_data,
      beforeSend: function () { $("#loading").show(); },
      success : function (data, status)
      {
        if(data.status != 'error')
        {
          $("#edit_fokus-modal").find("input[name='nama_fokus']").val('');
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

function get_gambar(){
  var id_fokus=$("#id_post").val();
    // console.log(id);
    $.ajax({
      url : "../BeritaFotoController/get_gambar",
      method : 'POST',
      data : {id_fokus: id_fokus},
      async : true,
      dataType : "json",
      success: function(data){
        var i = 1;
        $("#data_gambar").empty();
        kolom_fokus=data.length;
        $.each(data, function(key, value) {
          update_kolom_fokus(i++,value);
        });
      }
    });
    return false;
  }

  function update_kolom_fokus(kolom_fokus,value)
  {
    var button_fokus = "";
    if(kolom_fokus > 1)
    {
      if(typeof value.imgpath !== "undefined"){
        button_fokus = "<button type='button' name='delete' id='"+value.id+"' class='btn btn-danger btn-lg delete'><i class='fa fa-trash-o'></i></button>";
      }
      else{
        button_fokus = "<button type='button' name='remove' id='"+kolom_fokus+"' class='btn btn-danger btn-lg remove'>x</button>";
      }
    }
    else
    {
      button_fokus = "<button type='button' name='add_update' id='add_update' class='btn btn-success btn-lg'>+</button>";
    }
    if(typeof value.imgpath !== "undefined"){
      output = "<tr id='row"+kolom_fokus+"'>";
      output += "<td><div class='row'><div class='col-md-12'><input type='hidden' class='form-control id_fokus' name='id_fokus"+kolom_fokus+"' id='id_fokus"+kolom_fokus+"' value='"+value.id+"'/><input type='text' name='keterangan_fokus"+kolom_fokus+"' placeholder='Nama Fokus' class='form-control name_fokus' value='"+value.caption+"'/></div></div></td>";
      output += "<td align='center'>"+button_fokus+"</td></tr>";
    }
    else{
      output = "<tr id='row"+kolom_fokus+"'>";
      output += "<td><div class='row'><div class='col-md-12'><input type='hidden' class='form-control id_fokus' name='id_fokus"+kolom_fokus+"' id='id_fokus"+kolom_fokus+"'/><input type='text' name='keterangan_fokus"+kolom_fokus+"' placeholder='Nama Fokus' class='form-control name_fokus' /></div></div></td>";
      output += "<td align='center'>"+button_fokus+"</td></tr>";
    }

    $("#data_gambar").append(output);
    $("#kolom_fokus").val(kolom_fokus);
  }

  function add_kolom_fokus(count_fokus)
  {
    var button_fokus = "";
    if(count_fokus > 1)
    {
      button_fokus = "<button type='button' name='remove' id='"+count_fokus+"' class='btn btn-danger btn-lg remove'>x</button>";
    }
    else
    {
      button_fokus = "<button type='button' name='add_more' id='add_more' class='btn btn-success btn-lg'>+</button>";
    }
    output = "<tr id='row"+count_fokus+"'>";
    output += "<td><div class='row'><div class='col-md-12'><input type='text' name='keterangan_fokus"+count_fokus+"' placeholder='Nama Fokus' class='form-control name_fokus' /></div></div></td>";
    output += "<td align='center'>"+button_fokus+"</td></tr>";
    $("#dynamic_field").append(output);
  }


  $(document).on("click", "#add_more", function(){
    count_fokus = count_fokus + 1;
    kolom_fokus=kolom_fokus+1;
    add_kolom_fokus(count_fokus);
    // update_kolom_fokus(kolom_fokus, {});
  });

  $(document).on("click", "#add_update", function(){
    count_fokus = count_fokus + 1;
    kolom_fokus=kolom_fokus+1;
    update_kolom_fokus(kolom_fokus, {});
  });

  $(document).on("click", ".remove", function(){
    count_fokus = count_fokus - 1;
    var row_id_fokus = $(this).attr('id');
    $("#row"+row_id_fokus).remove();
  });
  
  function hapus_fokus(id){
    $.ajax({
      dataType: 'json',
      url: 'ikk-31/ambil-data-by-id-fokus/'+id,
      success: function ( data) {
        var nama_fokus = data.data[0].nama_fokus;
        $.confirm({
          title : 'Hapus Data',
          content : 'Apakah Anda Yakin Untuk Menghapus : '+nama_fokus,
          buttons: {
            hapus: {
              btnClass: 'btn-blue',
              text:'Hapus',
              action: function(){
                $.ajax({
                  dataType: 'json',
                  type:'POST',
                  url: 'ikk-31/remove_fokus/'+id,
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