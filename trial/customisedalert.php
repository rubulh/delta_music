<html>
<head>
<script type="text/javascript" >
function display(id,left,top)
{
document.getElementById(id).style.left=left+'px';

document.getElementById(id).style.top=top+'px';

document.getElementById(id).style.display='block';
}
</script>
<style>
body{background-color:black;
}
#me{width:200px;
    height:400px;
    margin:auto;
    position:absolute;
    background-color:olive;
	}
#alertbox{display:none;
           position:absolute;
           width:300px;
           height:300px;
           background-color:red;
	
	        color:yellow;
	     }
</style>
</head>
<body>
<div id="alertbox">
<p>
this is a stylish alert box;;
<br>
see that this looks better
<br>
------
<br>
</p>


</div>
<div id="me">
<form>
<input type="text" name="me" value="click next"size=45 onblur="display('alertbox',333,444)">
<input type="submit" name="submit" value="here" >
</form>
</div>
<script type="text/javascript" >

</script>
</body>
</html>