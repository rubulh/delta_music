<html>
<head>
<script src="http://localhost/take/jquery/jquery.tools.min.js"></script>
</head>
<body>
<?php


?>
<form id="mainform" method="POST">
<input type="text" name="name" value="name here" id="name">
<input type="text" name="email" value="email here" id="email">
<input type="submit" name="submit" value="submit" id="owe">
</form>
<script>
$(document).ready(function()
{
$(function() {  
 $("#owe").click(function() {  
 var name = $("input#name").val();
 var email = $("input#email").val();  

var dataString = 'name='+ name + '&email=' + email ;  
//alert (dataString);return false;  
$.ajax({  
  type: "POST",  
  url: "http://localhost/take/files/d_m.php",  
  data: dataString,  
  success: function() {$('#mainform').unload("slow").load("http://localhost/take/files/d_m.php").fadeIn("slow");
   
  }  
});  
return false; 
 
  });  
}); 
});
</script>
<?php
/*
 $('#mainform').append("<div id='message'></div>");  
    $('#message').append("<h2>Contact Form Submitted!</h2>")  
    .append("<p>We will be in touch soon.</p>")  
   .hide().fadeIn(1500, function() {  
      $('#message').append("<br><b>done AND <?=$_SERVER['REQUEST_TIME']?></b>");  
    }); 
*/
?>


</body>
</html>
