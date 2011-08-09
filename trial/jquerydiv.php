<html>
<head><TITLE></TITLE>

<script src="http://localhost/take/jquery/jquery.tools.min.js"></script>
</head>
<body>
<button id="appear">
appear
</button>
<div id="blink" style="width:200px;height:200px;display:none;background-color:red;margin:auto;">
this is the div
</div>
<script>
$(document).ready(function(){$("#appear").click(function(){$("#blink").animate("display","block");});
					$("#blink").mouseenter(function(){$("#blink").css("display","none");});});

</script>
</body>
</html>