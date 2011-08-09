<?php 
require_once("/var/www/take/files/thekey.php");

//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>

<?php
session_start();
//var_dump($_COOKIE);
//var_dump($_COOKIE['authkey']);exit();


$the_current_timestamp_downloadhandler=time();
$thesong_key=$_GET['anchor'];
//get the file path
//put it for download
//update users database downloaded-timestamp
//update song databse downloads+1;
$connection_downloadhandler=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
//select general databse
//extract song download path
//and download times
$basicdatabase_select_downloadhandler=mysqli_select_db($connection_downloadhandler,$databasename);
$query_extract_song_details="select download_path,times_download,kick_song_index from allsongs where the_anchor='$thesong_key'";
$result_extract_song_details=mysqli_query($connection_downloadhandler,$query_extract_song_details)or die(mysqli_error($connection_downloadhandler));
$answer_extract_song_details=mysqli_fetch_array($result_extract_song_details);
//var_dump($answer_extract_song_details);echo "ioioioio1<br><br>";
$the_download_path=$answer_extract_song_details['download_path'];
$the_times_downloaded=$answer_extract_song_details['times_download'];
$apparent_song_key=$answer_extract_song_details['kick_song_index'];
$the_times_downloaded+=1; 








//var_dump($_SESSION);var_dump($_COOKIE);exit();
$query_update_song_details="update allsongs set times_download='$the_times_downloaded' where the_anchor='$thesong_key'";
$result_update_song_details=mysqli_query($connection_downloadhandler,$query_update_song_details)or  die(mysqli_error($connection_downloadhandler));
//var_dump($query_update_song_details);echo "ioioioio2<br><br>";
$answer_update_song_details=mysqli_affected_rows($connection_downloadhandler);
//echo "<br><br>";var_dump($answer_update_song_details);
// var_dump($answer_update_song_details);exit();
// if(!$answer_update_song_details==1){
// 						setcookie('authkey','',time()-60*60);//returns bool
// 						setcookie('clue','',time()-60*60);//returns bool
// 						session_destroy();
// 						$_SESSION=array();
// 						header("Location:$FILE/error_message.php? ");
// 						//whisks to error message.php  where error is shown that something went updating the song details and putting the times downloaded
// 						exit();
// 						}


if($_SESSION['clue']=='users')
{

$email_id_downloadhandler=$_SESSION['email_id'];
//this code block acts sonly for the user 
//so
//change the databse to user specific database
//for that extract the registration timestamp from the users_basic table
$query_extract_user_details="select registration_timestamp ,username from users_basic where email_id='$email_id_downloadhandler'";
$result_extract_user_details=mysqli_query($connection_downloadhandler,$query_extract_user_details)or die(mysqli_error($connection_downloadhandler));;
$answer_extract_user_details=mysqli_fetch_array($result_extract_user_details);
//echo "<br><br>";var_dump($answer_extract_user_details);echo "ioioioio3<br><br>";
$username_extract_user_details=$answer_extract_user_details['username'];
$registration_timestamp_downloadhandler=$answer_extract_user_details['registration_timestamp'];
$the_user_db_downhandler=$username_extract_user_details.'___'.$email_id_downloadhandler.'___'.$registration_timestamp_downloadhandler;
//why need times played
$select_user_specific_db_downhandler=mysqli_select_db($connection_downloadhandler,$the_user_db_downhandler)or die(mysqli_error($connection_downloadhandler));;
$extract_the_times_played_from_all_songs="select times_played from mysongs where all_songs_kick_song_index='$apparent_song_key'";
$result_the_times_played_from_all_songs=mysqli_query($connection_downloadhandler,$extract_the_times_played_from_all_songs)or die(mysqli_error($connection_downloadhandler));
$answer_the_times_played_from_all_songs=mysqli_fetch_array($result_the_times_played_from_all_songs);
//var_dump($answer_the_times_played_from_all_songs);echo "ioioioio9<br><br>";
$the_times_played_from_all_songs=$answer_the_times_played_from_all_songs['times_played'];
//echo "<br><br>";var_dump($answer_the_times_played_from_all_songs);
$the_times_played_from_all_songs+=1;
$query_update_into_mysongs="update mysongs set timestamp_played='$the_current_timestamp_downloadhandler' ,times_played='$the_times_played_from_all_songs',downloaded=1,downloaded_timestamp='$the_current_timestamp_downloadhandler' where all_songs_kick_song_index='$apparent_song_key'";
$result_update_into_mysongs=mysqli_query($connection_downloadhandler,$query_update_into_mysongs)or die(mysqli_error($connection_downloadhandler));
$answer_update_into_mysongs=mysqli_affected_rows($connection_downloadhandler);
//echo "gjsgjgjsgghkshhks";echo "ahkjhka"';
//var_dump($answer_update_into_mysongs);echo "ioioioio978<br><br>";
$query_set_downloaded_and_downloaded_in_mysongs="update mysongs set downloaded=1,downloaded_timestamp='$the_current_timestamp_downloadhandler' where all_songs_kick_song_index='$apparent_song_key'";
//var_dump($query_set_downloaded_and_downloaded_in_mysongs);
$result_set_downloaded_and_downloaded_in_mysongs=mysqli_query($connection_downloadhandler,$query_set_downloaded_and_downloaded_in_mysongs)or die(mysqli_error($connection_downloadhandler));
$answer_set_downloaded_and_downloaded_in_mysongs=mysqli_affected_rows($connection_downloadhandler); //echo "<br>this os hshshshsh";
		{//var_dump($answer_set_downloaded_and_downloaded_in_mysongs);
			//statements to confirm it worked echo "gjsgjgjsgghkshhks";
				//echo "gjsgjgjsgghkshhks67686";
		}
/*
	
if(!$answer_set_downloaded_and_downloaded_in_mysongs==1)
	{
	
						setcookie('authkey','',time()-60*60);//returns bool
						setcookie('clue','',time()-60*60);//returns bool
						session_destroy();
						$_SESSION=array();
						header("Location:$FILE/error_message.php?down=35");
						//whisks to error message.php  where error is shown that something went updating the userspecific sonfg details and putting the times played and the last played timestamp
						exit();
	}
	*/
}

if(file_exists($the_download_path))
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($the_download_path));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($the_download_path));
    ob_clean();
    flush();
    readfile($the_download_path);

}


 ?>