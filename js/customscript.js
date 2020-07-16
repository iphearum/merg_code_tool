 var rootUrl = window.location.origin;
 function togglePassword() {
    var password = document.getElementById('oldpass');
    var newpassword = document.getElementById('newpass');
    var renewpassword = document.getElementById('renewpass');
    var arr_control = [password,newpassword,renewpassword];
    for (var i=0; i<arr_control.length; i++) {
        if (arr_control[i].type == 'text') {
            arr_control[i].type = 'password';
        } else {
            arr_control[i].type = 'text';
        }
    }          
}
jQuery(function($) {
  $(".input_img").mousedown(function(){
        var controlName = $(this).attr("forInput");
        var control = document.getElementById(controlName);
        control.type = 'text';
  });
   $(".input_img").mouseout(function(){
        var controlName = $(this).attr("forInput");
        var control = document.getElementById(controlName);
        control.type = 'password';
  });
    $('.ajax').on('change', function() {
        var parentID = this.value; 
          $.ajax({
            type: 'POST',
            url: rootUrl +'/wp-content/themes/wpresidence/ajax_functions.php',
            data: { parentID : parentID }, 
            success: function(data) {
               $(".fill_by_ajax").html(data);
            }
          });

    });
    
  function ignoreCutCopyPaste() {
      $("[data-ignorepaste]").bind("cut copy paste", function (e) {   
            e.preventDefault();
      });
  }
  ignoreCutCopyPaste();


});