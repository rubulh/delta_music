<?php
session_start();

$name=$_SESSION['name'];
$email=$_SESSION['email'];
echo"<br>%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%<br>";
echo"<br>%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%";
echo"<br>first kick<br>";
var_dump($_COOKIE);
echo"<br>";
$id=session_id();
var_dump($id);
session_regenerate_id();
echo"<br>%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%<br>";
echo"<br>%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%";
echo "<br>{-$name-}<br>{-$email-}<br>";
var_dump($_COOKIE);
echo"<br>the latest id";
$id=session_id();
var_dump($id);
echo"<br>%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%";
echo"<br>%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%<br>";

?>
