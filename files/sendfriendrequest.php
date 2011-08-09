<?php 
require_once("/var/www/take/files/thekey.php");
//require_once("/var/www/take/files/functions/trackker.php");
require_once("/var/www/take/files/functions/randomstring.php");
//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
session_start();
//trackker();
?>

<?php
//add a row in all requests
//fr_out add self
//fr_in add recipient

$the_current_user_sfr=$_SESSION['email_id'];
$the_friend_sfr=$_POST['friendreqto'];
$connection_sfr=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);;
//add to current user out
$the_friend_sfr=mysqli_real_escape_string($connection_sfr,$the_friend_sfr);
$current_timestamp_sfr=time();
//get current user details
$query_get_details_current_user="select username,profile_string from users_basic where email_id='$the_current_user_sfr'";
var_dump($query_get_details_current_user);
$result_get_details_current_user=mysqli_query($connection_sfr,$query_get_details_current_user);//or die(mysqli_error($connection_sfr));
$answer_get_details_current_user=mysqli_fetch_array($result_get_details_current_user);
$username_answer_get_details_current_user=$answer_get_details_current_user['username'];
$profile_string_answer_get_details_current_user=$answer_get_details_current_user['profile_string'];
//get the request user details
$query_extract_from_friend_req_sfr="select username,registration_timestamp,fr_out,email_id from users_basic where profile_string='$the_friend_sfr'";
$result_extract_from_friend_req_sfr=mysqli_query($connection_sfr,$query_extract_from_friend_req_sfr)or die(mysqli_error($connection_sfr));;
$answer_extract_from_friend_req_sfr=mysqli_fetch_array($result_extract_from_friend_req_sfr);
$username_answer_extract_from_friend_req_sfr=$answer_extract_from_friend_req_sfr['username'];
$email_id_answer_extract_from_friend_req_sfr=$answer_extract_from_friend_req_sfr['email_id'];
$registration_timestamp_answer_extract_from_friend_req_sfr=$answer_extract_from_friend_req_sfr['registration_timestamp'];
$friend_user_database=$username_answer_extract_from_friend_req_sfr.'___'.$email_id_answer_extract_from_friend_req_sfr.'___'.$registration_timestamp_answer_extract_from_friend_req_sfr;

//to userspecific database
$change_to_user_specific_db=mysqli_select_db($connection_sfr,$friend_user_database)or die(mysqli_error($connection_sfr));;
$date_sfr=date("d-M-Y");
$time_24_sfr=date("G-i-s");//echo "thshihis";;
//write in all requests
$query_write_in_all_requests="insert into allrequests (category,timestamp_request,time_24,date,username_requester,email_id_requester,profile_string_requester) values('friend_request','$current_timestamp_sfr','$date_sfr','$time_24_sfr','$username_answer_get_details_current_user','$the_current_user_sfr','$profile_string_answer_get_details_current_user')";
$result_write_in_all_requests=mysqli_query($connection_sfr,$query_write_in_all_requests)or die(mysqli_error($connection_sfr));;//echo "thshihis";;
if(mysqli_affected_rows($connection_sfr))
{
//confirm

}
$query_put_in_all_noitifications="insert into all_notifications (notification_by,notification_by_profile_string,notification_by_email,notification_category,notification_details,notification_timestamp,notification_time_24,notification_date) values('$username_answer_get_details_current_user','$profile_string_answer_get_details_current_user','$the_current_user_sfr','friend_request','','$current_timestamp_sfr','$time_24_sfr','$date_sfr')";
$result_put_in_all_noitifications=mysqli_query($connection_sfr,$query_put_in_all_noitifications)or die(mysqli_error($connection_sfr));
if(mysqli_affected_rows($result_put_in_all_noitifications))
{;;}//confirm
//add to friend_in
//change to general database
$back_to_general_database=mysqli_select_db($connection_sfr,$databasename);
$query_get_sfr_fr_in="select fr_in from users_basic where email_id='$email_id_answer_extract_from_friend_req_sfr'";
$answer_get_sfr_fr_in=mysqli_query($connection_sfr,$query_get_sfr_fr_in)or die(mysqli_error($connection_sfr));
$result_get_sfr_fr_in=mysqli_fetch_array($answer_get_sfr_fr_in);
var_dump($result_get_sfr_fr_in);
$theold_fr_in=$result_get_sfr_fr_in['fr_in'];
$thenew_fr_in=$the_current_user_sfr.'(`#$&^@!--`)'.$theold_fr_in;//(`#$&^@!--`)
var_dump($thenew_fr_in);
$query_update_fr_in="update users_basic set fr_in='$thenew_fr_in' where email_id='$email_id_answer_extract_from_friend_req_sfr'";;

$result_update_fr_in=mysqli_query($connection_sfr,$query_update_fr_in)or die(mysqli_error($connection_sfr));
if(mysqli_affected_rows($connection_sfr))
	{
	//confirm
	}



//add to fr_out
$query_get_sfr_fr_out="select fr_out from users_basic where email_id='$the_current_user_sfr'";
$answer_get_sfr_fr_out=mysqli_query($connection_sfr,$query_get_sfr_fr_out)or die(mysqli_error($connection_sfr));;
$result_get_sfr_fr_out=mysqli_fetch_array($answer_get_sfr_fr_out);
$theold_fr_out=$result_get_sfr_fr_out['fr_out'];
$thenew_fr_out=$email_id_answer_extract_from_friend_req_sfr.'(`#$&^@!--`)'.$theold_fr_out;
$query_update_fr_out="update users_basic set fr_out='$thenew_fr_out' where email_id='$the_current_user_sfr'";;

$result_update_fr_out=mysqli_query($connection_sfr,$query_update_fr_out)or die(mysqli_error($connection_sfr));;
if(mysqli_affected_rows($connection_sfr))
	{
	//confirm
	}

?>