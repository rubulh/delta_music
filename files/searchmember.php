<?php


session_start();
require_once("/var/www/take/files/thekey.php");
require_once("/var/www/take/files/functions/trackker.php");
require_once("/var/www/take/files/functions/randomstring.php");
require_once("/var/www/take/files/functions/profilestring.php");
require_once("/var/www/take/files/functions/unlogger.php");
require_once("/var/www/take/files/functions/restrictor.php")  ;
//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
//here i need some extra code so as to account and check for cookies sessions
/*
$THEEMAILIDINSESSION=$_SESSION['email_id'];
$connection_welcome=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
 $query_THE_LEAD=mysqli_query($connection_welcome,"select profile_string from users_basic where email_id='$THEEMAILIDINSESSION'")or die(mysqli_error($connectiom_welcome));
$fetch_the_lead=mysqli_fetch_array($query_THE_LEAD);
$profile_string_this_is=$fetch_the_lead['profile_string'];

*/
trackker();

$connection_search=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
?>
<form method='POST' action="">
<input type="text" value="query here" name="person">
<input type="submit" name="submit" value="submit">
</form>


<?php


if(isset($_POST))
{echo "<div>";
//$_POST['person']
$the_query=mysqli_real_escape_string($connection_search,$_POST['person'])	;
//var_dump($the_query);
$one="select  * from users_basic";
$query_db=mysqli_query($connection_search,$one) or die(mysqli_error($connection_search));
while(false!=($output=mysqli_fetch_array($query_db)))
{
//var_dump($output);
$name_output=$output['username'];
$profile_string_out=$output['profile_string'];
//var_dump(preg_match("/".$the_query."/",$name_output));
if(preg_match("/".$the_query."/",$name_output))
{
echo "<a href='viewprofile.php?profile=$profile_string_out'>$name_output</a><br>";

}	

	
	
}	
	
echo"</div>";	
}	



?>