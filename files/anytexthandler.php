<?php
require_once("/var/www/take/files/thekey.php");

// one has to see if it can be done without direct file and folder names
?>
<!--note that any guest must not get acces to this page as guests will not be allowed to comment 
i need a funtion that shall rstrict the gusest to recahing certain and most pages
 script must take care of the clue parameter is safe-->


<!--in any case i need the email id of the user so i extract it here-->
<!--for to extract the email id of the reciever in case of message i shall extract the email-d of the reciever later-->




<?php
session_start();
$user_email_id_text_handler=$_SESSION['email_id'];
$connection_anytexthandler=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
{
$_POST['typeoftext']=mysqli_real_escape_string($connection_anytexthandler,htmlentities($_POST['typeoftext']));
if(!($_POST['typeoftext']=='comment' || $_POST['typeoftext']='message'))
	{
	
	exit();
		
	//should it be a exit here or a header or to remove all cookies and sessions
	//i got to think
	}
//validate and sanitise the $post type of text variable here
//note that
//any value other than comment or message and the user shall be redirected to the loginpage 
//even if the variable is not set set exit or do what
//????login page should i change that??
}
//note that the comments must be changed from html to safe and back from safe to html 
//before being rendered before the user
//mysqli_real_escape_string
//to use htmlentities
//use this mysql_real_escape_String(htmlentities($str)

{
//extract the email id of te user from the general use fdatabse

$query_extract_user_details="select username,registration_timestamp from users_basic where email_id=$user_email_id_text_handler";
$result_extract_user_details=mysqli_query($connection_anytexthandler,$query_extract_user_details);
$answer_extract_user_details=mysqli_fetch_array($result_extract_user_details);
$username_anytexthandler=$answer_extract_user_details['username'];
$registrationtimestamp_anytexthandler=$answer_extract_user_details['registration_timestamp'];
$database_me_anytexthandler="$username_anytexthandler-$user_email_id_text_handler--$registrationtimestamp_anytexthandler";
$date_entry_anytexthandler=date("d-F-Y ");
$time_entry_anytexthandler=date("H:i:s ");
$date_time_string_entry_anytexthandler="on $date_entry_anytexthandler at $time_entry_anytexthandler";


}




if($_POST['typeoftext']=='comment')
{
$index_of_the_song_being_commented=$_POST['songindex'];
//already sanitised and validated
$mycomment_anytexthandler=$_POST['mycomment'];
//contruct the new comment string to be inserted
$construct_comment_string="{`#+*><`}$date_time_string_entry_anytexthandler(`#^$><`)$username_anytexthandler(`#^$><`)$mycomment_anytexthandler";
//get the already existing comment string in the song row 
//no need to change tha database
$query_get_the_song_comment_from_database="select all_comments from all_songs where kick_song_overall=$index_of_the_song_being_commented";
$result_get_the_song_comment_from_database=mysqli_query($connection_anytexthandler,$query_get_the_song_comment_from_database);
$answer_get_the_song_comment_from_database=mysqli_fetch_array($result_get_the_song_comment_from_database);
$the_former_comment_on_the_database=$answer_get_the_song_comment_from_database['all_comments'];
$appended_new_comment_for_the_field=$construct_comment_string.$the_former_comment_on_the_database;
//update the row with the new comment

$query_put_the_new_comment="update all_songs set all_comments=$appended_new_comment_for_the_field where kick_song_overall=$index_of_the_song_being_commented";
$result_put_the_new_comment=mysqli_query($connection_anytexthandler,$query_put_the_new_comment);
$answer_put_the_new_comment=mysqli_affected_rows($connection_anytexthandler);

//now the original page to show the new comment must be reloaded  and done;
}

?>