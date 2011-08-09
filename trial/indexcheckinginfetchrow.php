<?php
require_once("/var/www/take/files/thekey.php");

// ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>
<?php
$connection=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,'calendar');
$query="select * from vision";
$result=mysqli_query($connection,$query);
$row1=mysqli_fetch_row($result);
{
?>
<br>
###############################################################################################
######################################################################
<br>
<?php
var_dump($row1);
$theres=$row1['subject'];
var_dump($theres);
}



?>
