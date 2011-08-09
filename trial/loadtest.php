<html>
<head>
<script src="http://localhost/take/jquery/jquery.tools.min.js"></script>
<style>
#cental{width:300px;height:400px;background-color:red;}
#appear{width:100px;height:100px;background-color:yellow;display:none;}
</style>
</head>
<body>
<div id="central">
<button id="go">go</button>
</div>

<div id="appear">
this
</div>
<script type="text/javascript" >
//$(document).ready(function(){$("#central").load(function(){$("#go").click();});});
$(document).ready(function(){$("#go").click(function(){$("#appear").css("display","block");});});
</script>

</body>
</html>