<html>
<head>
<script type="text/javascript" src="http://localhost/take/jquery/jquery.tools.min.js">
</script>
<?php
require_once("/var/www/take/files/functions/randomstring.php");

?>

<script type="text/javascript" >
$(document).ready(function(){$('#butt').click(function(){location.reload()});});
</script>
</head>
<body>
<div>
<?php var_dump(randomstring());?>
</div>

<button id="butt">click</button>
</body>
</html>