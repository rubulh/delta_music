<!--this is the register function script 
it
1.puts the username password in the users_basic table
the other table that is the users_logged in table ll be populated by the logger function,run immediately after this function
2.makes a file in the folder under the arrangement
registrations->year->month->day
helps keep track of the number of people registered at any day
3.in each day it ll put the registered user under ths syntax
REGISTERED{name,email_id,ip,time_stamp_registered,user_agent}
4.simultaneously it ll put this name in the file
registered->(email_id)(name)(timestamp_of_registration)
 which keeps a record of the logged in users their ips ever used useragents and session ids(by the help of trackker and unlogger and the logout script) in the same pattern;;
5 .notable that once the user has registered i ll automatically log him in using the logger() function
6.so the pattern in the second file ll be followed by a logged statement 
and 
7.each change in the session id ll be updated in the second text file
-->

<!--everything shall be sanitised before it reaches this point-->
<?php
require_once("/var/www/take/files/thekey.php");

// ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>

<?php
function registerer($name_registerer,$email_id_registerer)
{
$ip__registerer=$_SERVER['REMOTE_ADDR'];
$user_agent__registerer=$_SERVER['USER_AGENT'];
$timestamp__registerer=time();
$date__registerer=date('d-m-Y');
$login_time_24__registerer=date('H-i-s');
$day_week_year__weekday=date('z-W-Y--(D)');
$session_id__registerer='just_registered';
$conn__registerer=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename)or die('incorrect');
    {
     //to put into the users_basic table
    $query_new_registration__registerer="insert into users_basic (name,email_id,login_timestamp,logout_timestamp,login_time_24,logout_time_24,day_week_year_weekday,ip,user_agent,session_id,session_id_bygone,involved,komparer,xinator) values('$name_registerer','$email_id_registerer',$timestamp__registerer,$timestamp__registerer,'$login_time_24__registerer','$login_time_24__registerer','$day_week_year__weekday','$session_id__registerer','$session_id__registerer',0,0,0,0)";
    $result_new_registration__registerer=mysqli_query($conn__registerer,$query_new_registration__registerer);
    	if(mysqli_affected_rows($conn__registerer)==1)
      	{//here i set theregistration in todays file
             $string_registrations__registerer="\nREGISTERED__{"$login_time_24__registerer"}__{"$timestamp__registerer"}__{"$name_registerer"}__{"$email_id_registerer"}__{"$ip__registerer"}__{"$user_agent__registerer"}__{"$session_id__registerer"}\n";
		
             $the_line_breaker=">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
             $overall_string_registrations__registerer="$the_line_breaker.$string_registrations__registerer.$the_line_breaker";
		 //this is the string to be appended in registrations;
             if(!(file_exists('$PATH_TO_RECORDS'))){$main_directory_created__registerer(mkdir("$PATH_TO_RECORDS/records"));}
		 //see if the records folder exists if not create it
             if(!(file_exists('$PATH_TO_RECORDS/records/users'))){$users_directory_created__registerer=mkdir("$PATH_TO_RECORDS/records/users");}
		//see if the users folder exists if not create it
             if(!(file_exists('$PATH_TO_RECORDS/records/users/central'))){$central_directory_created__registerer=mkdir("$PATH_TO_RECORDS/records/users/central");}
             //see if the central folder exists if not create it
             if(!(file_exists('$PATH_TO_RECORDS/records/users/central/registrations'))){$registrations_directory_created__registerer=mkdir("$PATH_TO_RECORDS/records/users/central/registrations");}
             //see if the registrations folder exists if not create it
              $year__registerer=date('Y');
             if(!(file_exists("$PATH_TO_RECORDS/records/users/central/registrations/$year__registerer"))){$year_register_directory_created__registerer=mkdir("$PATH_TO_RECORDS/records/users/central/registrations/$year__registerer");}
             //see if the current year folder exists if not create it
              $month__registerer=date('F');
             if(!(file_exists("$PATH_TO_RECORDS/records/users/central/registrations/$month__registerer"))){$month_register_directory_created__registerer=mkdir("$PATH_TO_RECORDS/records/users/central/registrations/$month__registerer");}
             //see if the current month folder exists if not create it
             $true_date__registerer=date('d');
             $resource_to_append_registrations_date__registerer=fopen("$PATH_TO_RECORDS/records/users/central/registrations/$true_date__registerer","a+");
             //if the current date fileopen in append mode
		 //so that even if does not exist create it
		//if exists write at the end of the  file
		$bytes_append_registrations_date__registerer=fwrite($resource_to_append_registrations_date__registerer,"$overall_string_registrations__registerer");
		if($bytes__append_registrations_date__registerer>0){;//put any statement here so as to confirm it really happened;
										  }
            if(!(file_exists("$PATH_TO_RECORDS/records/users/central/registered"))){$registered_directory_created__registerer=mkdir("$PATH_TO_RECORDS/records/users/central/registered/");}
             //see if the registered year folder exists if not create it 
		$user_complete_information="$email_id_registerer---($name_registerer)--($timestamp__registerer)";
		//create the file unique for each user
		 $resource_to_create_unique_userfile__registerer=fopen("$PATH_TO_RECORDS/records/users/central/registered/$user_complete_information","w+");
		//opening in write mode as no such file existed before  
		//as the filename is unique email_id---(username)--(registration tmestamp)
		$bytes_write_registered_uniquefile__registerer=fwrite("$resource_to_create_unique_userfile__registerer","$overall_string_registrations__registerer.'\n'$the_line_breaker");
  		//writing the registered users detail in thefile 
             if($bytes_write_registered_uniquefile__registerer>0){;//put any statement so as to so confirm the action;
										    }
		}
    }

}


?>
