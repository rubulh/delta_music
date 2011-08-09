<html>

<?php
require_once("/var/www/take/files/functions/randomstring.php");

?>
<head><TITLE></TITLE>
<script src="http://localhost/take/jquery/jquery.tools.min.js">
$(document).ready(function(){$("div#two").mouseover(function(){$("div#two").css("background-color","olive");});$("#one").click(function(){$("#one").html("this");}))};
</script>

</head>
<body>
<div>
<div id="one" style="width:100px;height:200px;margin:auto;background-color:yellow;">
<?php
$one=randomstring();
echo $one;
?>

</div>
<div id="two" style="width:100px;height:200px;margin:auto;background-color:silver;">
<?php
$two=randomstring();
echo $two;
?>

</div>
</body>

</html>