<?php 
require_once("/var/www/take/files/thekey.php");

//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>

<?php
//remove the row from all requests
//from fr_sent
//fr_recieved
//transfer the email id to friends
session_start();
$the_current_email_rfr=$_SESSION['email_id'];
$the_friend_requester_email=$_POST['requestfrom'];
$connection_rfr=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);;
//get the friend name_email_from_allrequests
//place_friend name-in friends-both chart
//remove_from all reuests
//remove from fr_in
//remove from fr_outc where

//remove from frout
$query_remove_from_fr_out="select fr_out from users_basic where email_id=$the_friend_requester_email";
$result_remove_from_fr_out=mysqli_query($connection_rfr,$query_remove_from_fr_out);
$answer_remove_from_fr_out=mysqli_fetch_array($result_remove_from_fr_out);
$old_fr_out_rfr=$answer_remove_from_fr_out['fr_out'];
$new_fr_out=str_replace($the_current_email_rfr.'(<{`@`+=&&@^&)','(<{`@`+=&&@^&)',$old_fr_out_rfr);
$query_update_fr_out="update users_basic set fr_out=$new_fr_out where email_id=$the_friend_requester_email";
$result_update_fr_out=mysqli_query($connection_rfr,$query_update_fr_out);
if(mysqli_affected_rows($result_update_fr_out))
	{
	//confirm
	}
//remove from fr in
$query_remove_from_fr_in="select fr_in from users_basic where email_id=$the_current_email_rfr";
$result_remove_from_fr_in=mysqli_query($connection_rfr,$query_remove_from_fr_in);
$answer_remove_from_fr_in=mysqli_fetch_array($result_remove_from_fr_in);
$old_fr_in_rfr=$answer_remove_from_fr_in['fr_in'];
$new_fr_in=str_replace($the_friend_requester_email.'(<{`@`+=&&@^&)','(<{`@`+=&&@^&)',$old_fr_in_rfr);
$query_update_fr_in="update users_basic set fr_in=$new_fr_in where email_id=$the_current_email_rfr";
$result_update_fr_in=mysqli_query($connection_rfr,$query_update_fr_in);
if(mysqli_affected_rows($result_update_fr_in))
	{
	//confirm
	}
}







$query_get_the_reciever_database="select username,profile_string,registration_timestamp from users_basic where email_id=$the_current_email_rfr";
$result_get_the_reciever_database=mysqli_query($connection_rfr,$query_get_the_reciever_database);
$answer_get_the_reciever_database=mysqli_fetch_array($result_get_the_reciever_database);
$username_answer_get_the_reciever_database=$answer_get_the_reciever_database['username'];
$profile_string_answer_get_the_reciever_database=$answer_get_the_reciever_database['profile_string'];
$registration_timstamp_get_the_reciever_database=$answer_get_the_reciever_database['registration_timestamp'];
$database_reciever="$username_answer_get_the_reciever_database-$the_friend_requester_email--$registration_timstamp_get_the_reciever_database";;
$change_database_rfr=mysqli_select_db($connection_rfr,$database_reciever)
$remove_from_allrequests_rfr="delete from allrequests where category='friendrequests' and email_id=$the_current_email_rfr";
$resultremove_from_allrequests_rfr=mysqli_query($connection_rfr,$remove_from_allrequests_rfr);
if(mysqli_affected_rows($connection_rfr))
{
//confirm
}
?>