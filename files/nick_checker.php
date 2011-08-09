<!-- this script checks if the nick name requested has already been logged in, if yes it reverts back to the first page and asks for another nick
if it returns {true} nick cannot be used 
returns {false} nick is okay
> go on..
-->



// ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>

<?php
/* sanitise the post nick before it comes through */
function nick_checker($newnick)
{
$conn_nick_checker=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
$request_nick=$newnick;
$query_nick_checker="select * from guest_logged where nick='$request_nick'";
//one might need to change the table name
$res_nick_checker=mysqli_query($conn_nick_checker,$query_nick_checker);
$row_nick_checker=mysqli_fetch_row($res_nick_checker);
if(!($row_nick_checker==NULL)){ return true;}
else {return false;}

}
?>
