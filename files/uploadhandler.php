


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
$THEEMAILIDINSESSION=$_SESSION['email_id'];
$connection_welcome=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
 $query_THE_LEAD=mysqli_query($connection_welcome,"select profile_string from users_basic where email_id='$THEEMAILIDINSESSION'")or die(mysqli_error($connectiom_welcome));
$fetch_the_lead=mysqli_fetch_array($query_THE_LEAD);
$profile_string_this_is=$fetch_the_lead['profile_string'];


trackker();
?>
<?php
$the_current_time_uploadehandler=time();
$the_current_time_24_uploadhandler=date('H-i-s');
$true_date_time_uploadhandler=date('d-m-Y');
	{
$title_uploadhandler=$_POST['song_title'];
$album_uploadhandler=$_POST['album'];
$language_uploadhandler=$_POST['language'];
$genre_uploadhandler=$_POST['genre'];
$artist_uploadhandler=$_POST['artist'];	
	//validate nad snitse the ntire thing here post string;
	}


$the_email_id_in_session=$_SESSION['email_id'];
$authkey_uploadhandler=$_COOKIE['authkey'];


//to evaluate working
//  var_dump($_FILES);
if(!file_exists($SONGDESTINATION))
{$THE_FINAL_DESTINATION_DIRECTORY=mkdir($SONGDESTINATION);}
$filename=$_FILES['uploadedsong']['name'];
$destination=$SONGDESTINATION.$filename;
if(!isset($_FILES['uploadedsong']['tmp_name'])){exit("THE FILE COULD NOT BE UPLOADED ;TRY AGAIN LATER");}           
else{$moved=move_uploaded_file($_FILES['uploadedsong']['tmp_name'],$destination);}
if($moved)
{
//first create the m3u
//should i chmod it here
$complete_music_file_directory=realpath($destination);
//$complete_music_file_directory=mysqli_real_escape_string($connection_upload_handler,$complete_music_file_directory);
$document_root_uploadehandler=$_SERVER['DOCUMENT_ROOT'];
//$complete_music_file_directory=mysqli_real_escape_string($connection_upload_handler,$document_root_uploadehandler);
//$thepath_to_uploaded_song=preg_replace("/^$document_root_uploadehandler/","http://localhost","$complete_music_file_directory");//WORKS??
//var_dump($complete_music_file_directory);echo "<br><br>";
//var_dump($document_root_uploadehandler);echo "<br><br>";
//var_dump($thepath_to_uploaded_song);echo "<br><br>";

//the m3u target is derived from the key.php
/*
$folder_for_m3u=$THEM3UFOLDER;
$thesalt_to_song_m3u=md5(randomstring().$the_current_time_uploadehandler);
//creating the filename forthe m3u random enough
$link_with_id=
$filename_for_m3u=basename($complete_music_file_directory).$thesalt_to_song_m3u;
$complete_name_for_m3u='/var/www/practice/all_m3u/'.$filename_for_m3u.'.m3u';
$iiii=mkdir('/var/www/practice/all_m3u');var_dump($iiii);
echo "<br>";echo "<br>";var_dump($complete_name_for_m3u);echo "<br>";var_dump($destination);echo "<br>";
$complete_name_for_m3u=$destination;
var_dump(file_exists('/var/www/practice/all_m3u'));echo "<br>";var_dump(realpath($complete_name_for_m3u));echo"<br>";
$resource_to_create_m3u=fopen($complete_name_for_m3u,"w+")or die('not_created');
var_dump($resource_to_create_m3u);echo "<br>";
$bytes_written_m3u=fwrite($resource_to_create_m3u,$destination);
var_dump($bytes_written_m3u);echo "<br>";*/
if(!file_exists('/var/www/take/all_m3u'))
{
$dir_made=mkdir('/var/www/take/all_m3u');
}
$url_destination=preg_replace('/^\/var\/www\//','http://localhost/',$destination);
// "<br><br>";var_dump($url_destination);
$the_filename_for_m3u=randomstring().randomstring().time().$destination;
$the_encrypted_filename=md5($the_filename_for_m3u);
$the_total_filename=$the_encrypted_filename.'.m3u';
$m3u_path_on_the_directory="http://localhost/take/all_m3u/$the_total_filename";
$open_file_to_keep_the_path=fopen('/var/www/take/all_m3u/'.$the_total_filename,'w+');//or die('wrong');
$write_bytes_inthe_m3u_file=fwrite($open_file_to_keep_the_path,$url_destination);
//var_dump($url_destination,$write_bytes_inthe_m3u_file,$the_total_filename);exit();
//if($write_bytes_inthe_m3u_file){exit('check');}




if(!$write_bytes_inthe_m3u_file)
	{
						/*setcookie('authkey','',time()-60*60);//returns bool
						setcookie('clue','',time()-60*60);//returns bool
						session_destroy();
						$_SESSION=array();
						header("Location:$FILE/error_message.php?down=36");
						//whisks to error message.php  where error is shown that something went creating tthe m3u
						exit();*/
	}
//write the download path song m3u path etc and the netered detailsin the general databse -allsongs table
$connection_upload_handler=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
$query_extract_user_details_uploadhandler="select registration_timestamp ,username,profile_string from users_basic where email_id='$the_email_id_in_session'";
//echo "<br>";var_dump($query_extract_user_details_uploadhandler);echo "<br>";
$result_extract_user_details_uploadhandler=mysqli_query($connection_upload_handler,$query_extract_user_details_uploadhandler)or die(mysqli_error($connection_upload_handler));/*echo "shhs";*/
$answer_extract_user_details_uploadhandler=mysqli_fetch_array($result_extract_user_details_uploadhandler);
//var_dump($answer_extract_user_details_uploadhandler);//echo "<br>";
$username_extract_user_details_uploadhandler=$answer_extract_user_details_uploadhandler['username'];
$registration_timestamp_uploadhandler=$answer_extract_user_details_uploadhandler['registration_timestamp'];
$profile_string_uploadhandler=$answer_extract_user_details_uploadhandler['profile_string'];
$the_session_user_db_uploadhandler="$username_extract_user_details_uploadhandler-$the_email_id_in_session--$registration_timestamp_uploadhandler";



$another_randomstring=randomstring();
$another_randomstring_complete=md5($another_randomstring.$the_current_time_uploadehandler.$another_randomstring);
$theanchor_to_the_song_in_the_allsongs_chart=$another_randomstring_complete;

//$username_extract_user_details_uploadhandler-$the_email_id_in_session--$registration_timestamp_uploadhandler";
$complete_name_for_m3u='http://localhost/'.$the_total_filename;
$query_insert_details_general_allsongs="insert into allsongs (song_title,album,artist,genre,language,play_path,the_anchor,download_path,added_by,added_by_profile_string) values('$title_uploadhandler','$album_uploadhandler','$artist_uploadhandler','$genre_uploadhandler','$language_uploadhandler','$m3u_path_on_the_directory','$theanchor_to_the_song_in_the_allsongs_chart','$destination','$username_extract_user_details_uploadhandler','$profile_string_uploadhandler')";//echo "^&*^&*^*^&*^*^okay";
	//var_dump($query_insert_details_general_allsongs);/*echo "```````````````````````````````````shhs";*/
$result_insert_details_general_allsongs=mysqli_query($connection_upload_handler,$query_insert_details_general_allsongs)or die(mysqli_error($connection_upload_handler));
$answer_insert_details_general_allsongs=mysqli_affected_rows($connection_upload_handler);
if(!$answer_insert_details_general_allsongs)
	{     
	/*setcookie('authkey','',time()-60*60);//returns bool
						setcookie('clue','',time()-60*60);//returns bool
						session_destroy();
						$_SESSION=array();
						header("Location:$FILE/error_message.php?down=37");
						//whisks to error message.php  where error is shown that something went wrong writing the uploaded file details in the general use db and all songs table
						exit();
	*/}

//extract the primary key
$query_extract_primary_key="select kick_song_index from allsongs where song_title='$title_uploadhandler' and play_path='$m3u_path_on_the_directory'";
echo "<br><br>";var_dump($query_extract_primary_key);
$result_extract_primary_key=mysqli_query($connection_upload_handler,$query_extract_primary_key)or die(mysqli_error($connection_upload_handler));
$answer_extract_primary_key=mysqli_fetch_array($result_extract_primary_key);
$the_primary_key_extracted=$answer_extract_primary_key['kick_song_index'];


$query_get_each_user="select username,email_id,registration_timestamp,friends from users_basic";
$result_get_each_user=mysqli_query($connection_upload_handler,$query_get_each_user)or die(mysqli_error($connection_upload_handler));
while(false!=($answer_get_each_user=mysqli_fetch_array($result_get_each_user)))
	{
	$username_get_each_user=$answer_get_each_user['username'];
	$email_get_each_user=$answer_get_each_user['email_id'];
	$registration_timestamp_get_each_user=$answer_get_each_user['registration_timestamp'];
	$all_friends_common_string=$answer_get_each_user['friends'];
	$the_user_db_uploadhandler=$username_get_each_user.'___'.$email_get_each_user.'___'.$registration_timestamp_get_each_user;
	
	//if the email id inthe array is equal to that in the cooie set the row uploaded =1 
			{//query the  user specific database and set the fields
				$the_each_user_specific_databse_selected=mysqli_select_db($connection_upload_handler,$the_user_db_uploadhandler)or die(mysqli_error($connection_upload_handler));;
				$query_insert_uploaded_song="insert into mysongs (all_songs_kick_song_index) values('$the_primary_key_extracted')";var_dump($query_insert_uploaded_song);
				$result_insert_uploaded_song=mysqli_query($connection_upload_handler,$query_insert_uploaded_song)or die(mysqli_error($connection_upload_handler));//echo "1111111111111111shhs";
				//var_dump($result_insert_uploaded_song);echo "<br>";
				//if(!mysqli_affected_rows($answer_the_times_played_from_all_songs)){;;;}
				echo "<br><br>";var_dump(mysqli_affected_rows($connection_upload_handler));
			}
	}
//extract the particular user details
//and update the song uploaded and uploaded timestamp
//$back_to_general_database=mysqli_select_db($connection_upload_handler,$databasename);


$select_session_user_specific_db_uploadhandler=mysqli_select_db($connection_upload_handler,$the_session_user_db_uploadhandler);
$update_uploaded_song_detail_session_user="update mysongs set uploaded=1,uploaded_timestamp='$the_current_time_uploadehandler' where all_songs_kick_song_index ='$the_primary_key_extracted'";
$result_uploaded_song_detail_session_user=mysqli_query($connection_upload_handler,$update_uploaded_song_detail_session_user)or die(mysqli_error($connection_upload_handler));/*echo "5t675757676786";*/
//var_dump($result_uploaded_song_detail_session_user);echo "5t675757676786";
$answer_uploaded_song_detail_session_user=mysqli_affected_rows($connection_upload_handler);
if(!$answer_uploaded_song_detail_session_user)
	{
// 		setcookie('authkey','',time()-60*60);//returns bool
// 						setcookie('clue','',time()-60*60);//returns bool
// 						session_destroy();
// 						$_SESSION=array();
// 						header("Location:$FILE/error_message.php?down=38");
// 						//whisks to error message.php  where error is shown that something went wrong updating the session user o have the uploaded=1 mark
// 					exit();
// 		
	}
//explode the friends string to get the friend email id;
//with each of friend email_id extract the friend databse name
//and then in the all notifications insert the category timestamp from song anchor time_24 date_
//change to general use database
$back_to_general_database_again=mysqli_select_db($connection_upload_handler,$databasename);

$get_friends_one_by_one=explode("(`#$&^@!--`)",$all_friends_common_string);
foreach($get_friends_one_by_one as $one_friend_email)
	{
		//get the friend databasename
		//insert the thimngs in allnotifications
		$query_get_friends_details="select username,registration_timestamp from users_basic where email_id='$one_friend_email'";
		$result_get_friends_details=mysqli_query($connection_upload_handler,$query_get_friends_details)or die(mysqli_error($connection_upload_handler));//echo ";';'';;';';';;'";
		$answer_get_friends_details=mysqli_fetch_array($result_get_friends_details);
		$friend_username=$answer_get_friends_details['username'];
		$friend_registration_timestamp=$answer_get_friends_details['registration_timestamp'];
		$friend_databasename=$friend_usernam.'___'.$one_friend_email.'___'.$friend_registration_timestamp;
		//change to the databse
		$the_friend_database_selected=mysqli_select_db($connection_upload_handler,$friend_databasename);
		//insert into all notifications;;
		//i make the anchor to each song base on the ids given to the div containing song deatils and the ame div shall be useful in
		//notified song ll contain the anchor
		//click the anchor link and u shall be led to the song
		//if anchor is present for nay song i shall mark the sdiv with a different color using a counter
				
$query_insert_notification_into_friend="insert into all_notifications (notification_timestamp,notification_time_24,notification_date,notification_by_email,notification_by,notification_category,notification_details,notified_song,notified_song_title) values('$the_current_time_uploadehandler','$the_current_time_24_uploadhandler','$true_date_time_uploadhandler','$the_email_id_in_session','$username_extract_user_details_uploadhandler','songupload','','$theanchor_to_the_song_in_the_allsongs_chart','$title_uploadhandler')";
		
		$result_insert_notification_into_friend=mysqli_query($connection_upload_handler,$query_insert_notification_into_friend);
		
		$answer_insert_notification_into_friend=mysqli_affected_rows($connection_upload_handler);
			if(!$answer_insert_notification_into_friend)
				{
					/*	setcookie('authkey','',time()-60*60);//returns bool
						setcookie('clue','',time()-60*60);//returns bool
						session_destroy();
						$_SESSION=array();
						header("Location:$FILE/error_message.php?down=37");
						//whisks to error message.php  where error is shown that something went wrong writing the new notfication into all friends;;
						exit();
				*/}
	}
}
?>
<html>
<head>

</head>
<body>
<div>
<h1>THE FILE HAS BEEN SUCCESFULLY UPLOADED</h1>
<h2>file name:"<?=$filename?>"</h2>
<h2>song title:"<?=$_POST['song_title']?>"</h2><br>
<h2>album,:"<?=$_POST['album']?>"</h2><br>
<h2>artist,:"<?=$_POST['artist']?>"</h2><br>
<h2>language:"<?=$_POST['language']?>"</h2><br>
<h2>genre:"<?=$_POST['genre']?>"</h2>

</div>
</body>
</html>