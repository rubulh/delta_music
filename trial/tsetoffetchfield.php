<?php

require_once("/var/www/take/files/thekey.php");

// ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
$cn=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,phptest)or die('connection');
$query="SELECT roll FROM login_data WHERE emailid='anokenko@gmail.com'";
$res=mysqli_query($cn,$query)or die('query');
$ans=mysqli_fetch_field($res)or die('fetch');
var_dump($ans);
?>







