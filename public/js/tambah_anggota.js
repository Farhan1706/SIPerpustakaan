(function($) {
  'use strict';
  var form = $("#example-form");
  form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onFinished: function(event, currentIndex) {
      $.ajax({
          type        : 'POST', 
          url         : 'tambah_anggota.php', 
          data        : form, 
          dataType    : 'json',
          success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              if(dataResult.statusCode==200){
              Swal.fire({title: 'Penambahan Anggota Berhasil',text: '',icon: 'success', showConfirmButton: false, timer: 1500
                }).then((result) => {
                  window.location = './data_anggota';
                })					
              }
              else if(dataResult.statusCode==201){
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Terjadi Kesalahan!'
                  })
              }
              
            }
      });
    }
  });
  
})(jQuery);