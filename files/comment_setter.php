<!--//this is the comment setter script-->
<?php 
require_once("/var/www/take/files/thekey.php");

//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>


<?php
session_start();
$connection_send_message=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
//one has to make sure that the page cannot be accessed by people by directly and nor without having http
//whisking alternatives//the message needs to be sanitised here
//as well in the original script using jquery
{
//first i do html entities and then real escape;;
//and while showing it to the user all of it needs to be decoded
foreach($_POST as &$array_get)
	{
		$array_get=htmlentities($array_get);
		$array_get=mysqli_real_escape_string($connection_send_message,$array_get);
	}
//can there be any issue;
}
$time_24_trackker=date('H-i-s');
$true_date_trackker=date('d-m-Y');


$message_sender=$_SESSION['email_id'];
$current_time_message=time();//timestamp
$date_today=date("d-M-Y");
$time_24_today=date("G-i-s");
$the_actual_message=$_POST['comment'];
$message_reciever=$_POST['anchor'];
//we haveto update two databases one for the sender and second for the reciever 
//first extract the registration timestamps
$query_get_reciever_details="select registration_timestamp, username from users_basic where email_id='$message_sender'";


$result_get_reciever_details=mysqli_query($connection_send_message,$query_get_reciever_details);
$answer_get_reciever_details=mysqli_fetch_array($result_get_reciever_details);
$registration_timestamp_reciever=$answer_get_reciever_details['registration_timestamp'];
$reciever_name=$answer_get_reciever_details['username'];
$database_for_the_reciever=$reciever_name.'___'.$message_reciever.'___'.$registration_timestamp_reciever;

$queryinsrt_into_all_songs=mysqli_query($connection_send_message,"select  all_comments from allsongs where the_anchor='$message_reciever'")or die(mysqli_error($connection_send_message));
$the_comments=mysqli_fetch_array($queryinsrt_into_all_songs);
$comment=$the_comments['all_comments'];
$new_comments=$reciever_name."(`%^@*`)".$true_date_trackker.$time_24_trackker."(`%^@*`)".$the_actual_message."(`%^&#`)".$comment;
$query_insert_there=mysqli_query($connection_send_message,"update allsongs set all_comments='$new_comments' where the_anchor='$message_reciever'");




/*
$reciever_database_selected=mysqli_select_db($connection_send_message,$database_for_the_reciever);
//set the read counter as 0 by default
//another idea is to use different color for the sent messages altogether
$insert_the_message_into_reciever="insert into allmessages (sender,reciever,reciever_email_id,message,time_24,timestamp,date_message) values($sender_name,$reciever_name,$message_reciever,$time_24_today,$current_time_message,$date_today)";
$result_the_message_into_reciever=mysqli_query($connection_send_message,$insert_the_message_into_reciever);
$answer_the_message_into_reciever=mysqli_affected_rows($connection_send_message);
	if($answer_the_message_into_reciever!=1)
		{
				$authkey_cookie_setter=setcookie('authkey',"",time()-60*60*5);
				session_destroy();
			        $_SESSION=array();
				header("Location:$FILE/error_message.php?down=32");
				//whisks to error message.php  where error is shown that something went wrong writing the error into the user specific datadase and all messages folder for the reciever 
		}*/



?>