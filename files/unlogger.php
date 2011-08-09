<?php
require_once("/var/www/take/files/thekey.php");

// ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>
<!--
in any event of the changing of either of the database tables i have to edit this file really carefully-->
<!--
1.gets all the rows from the server and extracts the latest session id
2.checks if the session id exists in the flat-fle in the server location
3.if yes continue;
4.if it doesnot exist remove the entry from thr chart_logged in
5.at the same time update the logout_timestamp and time and involved in the basic table
6.also the involved field is updated only if unlogger or logout gets executed
7.this script writes into the date specific chart updaeting the logout time
for the user it updates the registered folder user specific file by entering the final logout time for each session
for theuser it writes the final logout time into the date specific file
for nicks it writes the date specific file
in the nick date specific file it adds the logout time ip etc
for nicks it adds the logout time nad related entries in the fields of guests
for nicks it removes the entire row after checking if the session id is no longer available in the server from nick_loggedin
the session id shall be updated by every request but not the lgout time and timestamp which shall be updated only by the logout or unlogger scripts and involved counter shall only be updated by the unlogger or the logout scripts
-->
<?php
function unlogger($chart)
{
$remove_it_by_cookie=0;
$the_current_timestamp=time();
$conn_unlogger=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
$table_unlogger=$chart.'_logged_in';//name of the table 
$query_unlogger="select * from $table_unlogger";
$res_unlogger=mysqli_query($conn_unlogger,$query_unlogger);
   while(NULL!==($row_unlogger=mysqli_fetch_row($res_unlogger)))
       {
	//get the last session id from the database for each row;
	//compare if the id exists in the server;
	//if not delete the row
	//also write the new time in the table chart_basic and also log it in a separate file
	//note that the index for the fetch row result is taken as integers so any change in structure of the table and this script has to be edited with utmost care;
	 
		$session_id_unlogger=$row_unlogger['session_id'];//session_id -field data
		$cookie_expiry_unlogger=$row_unlogger['cookie_expires'];//session_id -field data
		if($cookie_expiry_unlogger<$the_current_timestamp){$remove_it_by_cookie=1;}
		$file_unlogger=ini_get('session.save_path')."/sess_".$session_id_unlogger;
			//if the file exists in the session do nothing
		     if((file_exists( $file ))&&($remove_it_by_cookie==1))
			    {
			    continue;

			    }
			//if the session id doesnot exist in the server remove the entire row from the
			//chart logged in database
		     else
			    {
			$query_logout_the_user="remove from $table_unlogger where nick=$row_unlogger[4] and session_id=$session_id_unlogger";
			$result_logout_the_user_unlogger=mysqli_query($conn_unlogger,$query_logout_the_user);	
					if(mysqli_affected_rows($conn_unlogger)==1)
						{
							//if the result is upadated on the databse update the chart_basic field w
							$table_update_unlogger=$chart.'_basic';// we do here is set the logout timestamp and logout time 24 and 
							//another important stp is updating the involved filed for that i get the involved filed first from the chart basic 
							//and then update it by adding time logged in in this session which is time()-logintime and upadet the involved filed in thechart basic
							// update the $chart_basicrt.'_basic';
							$new_logout_time_unlogger=time();
							$new_logout_time_24_unlogger=date('H-i-s');
								   {
									//here i extract the involved field value from the chart_basic and update it in the sense that i add the logout_time-login_time to the current value of involved field
								    $query_get_involved_unlogger="select * from $table_update_unlogger where session_id=$session_id_unlogger";
								    $result_get_involved_unlogger=mysqli_query($conn_unlogger,$query_get_involved_unlogger);
								     $row_to_get_the_involved_unlogger=mysqli_fetch_row($result_get_involved_unlogger);
								     $involved_fetched_from_row_unlogger=$row_to_get_the_involved_unlogger[12];
								     $login_timestamp_from_row_unlogger=$row_to_get_the_involved_unlogger[3];
									$ip_unlogger=$_SERVER['REMOTE_ADDR'];
									$user_agent_unlogger=$_SERVER['USER_AGENT'];
									$
								     $new_involved_counter_unlogger+=($new_logout_time_unlogger-$login_timestamp_from_row_unlogger);
								    }
							 $query_update_chart_basic="update $table_update_unlogger set logout_timestamp=$new_logout_time_unlogger , logout_time_24=$new_logout_time_24_unlogger ,involved=$new_involved_counter_unlogger where session_id=$session_id_unlogger and nick=$row_unlogger[4]";
							 //here i update the involved logout timestamp logout_time-24 and all other filels in the chart basic 
							 
							//once done go to the next iteration
						}
			    }





       }
}
//i ma still to set the logging to external file
//in fact to edit the file which logs people ever logged in and writes a in a file
//get the file contents
//get the last sorted result
//edit the logout session
//
$string_logout_unlogger="\nLOGOUT__{"$new_logout_time_24_unlogger"}__{"$new_logout_time_unlogger"}__{"$name_registerer"}__{"$email_id_registerer"}__{"$ip__registerer"}__{"$user_agent__registerer"}__{"$session_id__registerer"}\n";
?>
