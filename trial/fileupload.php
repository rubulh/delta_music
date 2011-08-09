<html>
<head>

</head>
<?php
if(!isset($_POST['submit']))
{
	?>
<body>
<form enctype='multipart/form-data' method="POST" action="">
<input type="file"  name="filename">
<input type="submit" value="submit" name="submit">

</form>
</body>
<?php
}
else {
var_dump($_FILES);

$tempoary=$_FILES['filename']['tmp_name']; 
if(!move_uploaded_file($tempoary,
'/var/www/uploaded/one')){echo"<br>success";}

}
?>
</html>