function preview(id)
{
  $.ajax({
    dataType: 'json',
    url: 'visitor/detail-galeri/'+id,
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
      $('#exampleModal1').modal('show');
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
