
<?php
$myname=$_POST['name'];
$myemail=$_POST['email'];
$connection=mysqli_connect('localhost','root','maa','alltest');
$query="insert into table2 (name,email) values('$myname','$myemail')";
$result=mysqli_query($connection,$query);
$answer=mysqli_affected_rows($connection);


?>

