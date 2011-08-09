<?php
include_once("/var/www/take/files/functions/randomstring.php");

?>

<html>
<head>
<script type="text/javascript" src="http://localhost/take/jquery/jquery.tools.min.js">

</script>
</head>
<body>
<?php
$random=randomstring();
?>
<div id='<?=$random?>' style="width:300px;height:300px;margin:top;background-color:red;">
"<?=var_dump($random);
?>"
</div>
<?php
?>
<script type="text/javascript" >
$(document).ready(function(){var one=$("div").attr('id');$('div#'+one).mouseover(function(){$(this).css("background-color","yellow");});});
</script>.
</body>
</html>