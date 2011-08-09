	while(false!=($session_id_array_unlogger=mysqli_fetch_array($result_query)))
		{
		$session_id_unlogger=$session_id_array_unlogger['session_id'];
			$file_in_server_unlogger=ini_get('session.save_path')."/sess_".$session_id_unlogger;
			//if the file exists in the session do nothing
		     if(file_exists( $file_in_server_unlogger ))
			    {
			    continue;

			    }
			else
				{
					{
							{
							//extract nick/username and email id
							
							  $query_extract_details="select * from $real_table_name where session_id='$session_id_unlogger'";
							  $result_extract_details=mysqli_query($connection_unlogger,$query_extract_details)or die(mysqli_error());
							  $array_extract_details=mysqli_fetch_array($result_extract_details);
							   $email_id_unlogger=$array_extract_details['email_id'];
								if($chart=='users')
									{
									$mainname_unlogger=$array_extract_details['username'];
									$index_for_table_logged_in=$array_extract_details['kick_logged_in'];
									$query_extract_the_registration_timestamp="select registration_timestamp from users_basic where email_id='$email_id_unlogger'";
									$result_extract_the_registration_timestamp=mysqli_query($connection_unlogger,$query_extract_the_registration_timestamp);
									$answer_extract_the_registration_timestamp=mysqli_fetch_array($connection_unlogger,$result_extract_the_registration_timestamp);
									$user_registration_timestamp=$answer_extract_the_registration_timestamp['registration_timestamp'];
									

									$file_name_to_user_update_unlogger="$PATH_TO_RECORDS/records/users/central/registered/$email_id_unlogger'___'$mainname_unlogger'___'$user_registration_timestamp";
									$user_specific_string_unlogger="\nUNLOGGED____{$time_24_unlogger}__{$timestamp_unlogger}__{$mainname_unlogger}__{$email_id_unlogger}__{$ip_unlogger}__{$user_agent_unlogger}__{$session_id_unlogger}_{$current_script_unlogger}__{$the_referer_script_unlogger}\n";
										$user_specific_string_unlogger="\n".$the_line_breaker.$user_specific_string_unlogger.$the_line_breaker.$the_line_breaker."\n";
	
									$resource_to_update_user_log=fopen($file_name_to_user_update,"a+");
									$bytes_to_update_user_log=fwrite($resource_to_update_user_log,$user_specific_string_unlogger);
										if($bytes_to_update_user_log)
												{
												session_destroy();
												$_SESSION=array();
													header("Location:$FILE/error_message.php?down=16");
													//whisks to error message.php where error is shown that something went wrong writing the unlogging activity in the user specific file
													exit();
												}
					
										}
								if($chart=='guests')
									{
									$mainname_unlogger=$array_extract_details['nick'];
									$index_for_table_logged_in=$array_extract_details['kick_logged_in'];
									$query_extract_the_login_timestamp="select login_timestamp from guests_basic where email_id='$email_id_unlogger'";
									$result_extract_the_login_timestamp=mysqli_query($connection_unlogger,$query_extract_the_login_timestamp);
									$answer_extract_the_login_timestamp=mysqli_fetch_array($connection_unlogger,$result_extract_the_login_timestamp);
									$guest_login_timestamp=$answer_extract_the_login_timestamp['login_timestamp'];
									

									$fallguests_name_to_user_update_unlogger="$PATH_TO_RECORDS/records/users/central/allguests/$year_unlogger";
									if(!file_exists($fallguests_name_to_user_update_unlogger))
									{
									$year_made=mkdir($fallguests_name_to_user_update_unlogger);
									$the_counter_two=10;
									}
									$fallguests_name_to_user_update_unlogger="$PATH_TO_RECORDS/records/users/central/allguests/$year_unlogger/$month_unlogger";
									if(!file_exists($fallguests_name_to_user_update_unlogger))
									{
									$year_made=mkdir($fallguests_name_to_user_update_unlogger);
									$the_counter_two=10;
									}
									$fallguests_name_to_user_update_unlogger="$PATH_TO_RECORDS/records/users/central/allguests/$year_unlogger/$month_unlogger/$true_date_unlogger";
									if(!file_exists($fallguests_name_to_user_update_unlogger))
									{
									$year_made=mkdir($fallguests_name_to_user_update_unlogger);
									$the_counter_two=10;

									}

									$guest_file_name_unlogger=$email_id_unlogger.'___'.$mainname_unlogger.'___'.$guest_login_timestamp;
									$complete_guest_date_by_file=$fallguests_name_to_user_update_unlogger.'/'.$guest_file_name_unlogger;
									$resource_to_write_date_by_guest=fopen($complete_guest_date_by_file,"a+");
									$guest_specific_string_unlogger="\nUNLOGGED____{$time_24_unlogger}__{$timestamp_unlogger}__{$mainname_unlogger}__{$email_id_unlogger}__{{$ip_unlogger}__{$user_agent_unlogger}__{$session_id_unlogger}_{$current_script_unlogger}__{$the_referer_script_unlogger}\n";
										$guest_specific_string_unlogger="\n".$the_line_breaker.$guest_specific_string_unlogger.$the_line_breaker.$the_line_breaker."\n";
	
									
									$bytes_to_update_guest_date_by_log=fwrite($resource_to_write_date_by_guest,$guest_specific_string_unlogger);
										if($bytes_to_update_guest_date_by_log)
												{
												session_destroy();
												$_SESSION=array();
													header("Location:$FILE/error_message.php?down=17");
													//whisks to error message.php where error is shown that something went wrong writing the unlogging activity in the user specific file
													exit();
												}
					
										
									}
							
							
  							 }								
					//remove the row from the table.logged_in
					$query_remove_row_from_chart="delete from $real_table_name where session_id=$session_id_unlogger";
						
					$result_remove_row_from_chart=mysqli_query($connection_unlogger,$query_remove_row_from_chart);

							if(mysqli_affected_rows($connection_unlogger))
						 	{
							continue;
						 	}
							
							else
							{
							header("Location:$FILE/error_message.php?down=14");
							//whisks to error message.php  where error is shown that something went wrong querying the database and removing the obsolete session_id row
							exit();							
							}
					}
				

						   		
					 {

	    				 //create the file folder setup if doenot exist already
					//imperative to create as the login and logout can be across 2400hrs specifically for the first such case in a day
				
              			$year_unlogger=date('Y');
             			if(!(file_exists("$PATH_TO_RECORDS/records/$tables/central/activity/$year_unlogger")))
						{$year_register_directory_created_unlogger=mkdir("$PATH_TO_RECORDS/records/$tables/central/activity/$year_unlogger");
						$the_continual=10;
						}
             //see if the current year folder exists if not create it

              $month_unlogger=date('F');
             		if(!(file_exists("$PATH_TO_RECORDS/records/$tables/central/activity/$year_unlogger/$month_unlogger")))
						{$month_register_directory_created_unlogger=mkdir("$PATH_TO_RECORDS/records/$tables/central/activity/$year_unlogger/$month_unlogger");
						$the_continual=10;
						}
             //see if the current month folder exists if not create it
		
		 $true_date_unlogger=date('d-m-Y');
		 $resource_to_append_date_unlogger=fopen("$PATH_TO_RECORDS/records/$tables/central/activity/$year_unlogger/$month_unlogger/$true_date_unlogger","a+");
             //see if the current date file exists
		// if doenot exist create it
		//open in append mode
		
			 $string_unlogged_date_activity_unlogger="\nUNLOGGED____{$time_24_unlogger}__{$timestamp_unlogger}__{$mainname_unlogger}__{$email_id_unlogger}__{$authkey_unlogger}__{$ip_unlogger}__{$user_agent_unlogger}__{$session_id_unlogger}_{$current_script_unlogger}__{$the_referer_script_unlogger}\n";
		/*
								$string_log_user_specific="\nLOGGED__{$time_24_trackker}__{$current_timestamp}__{$mainname_basic_trackker}__{$email_id_trackker}__{$authkey_session_id_trackker}__{$ip_trackker}__{$user_agent_trackker}__{$current_requested_script_trackker}__{$the_invoking_http_referer_trackker}\n";
								*/
             
		$the_complete_unlog_string="\n".$the_line_breaker.$string_unlogged_date_activity_unlogger.$the_line_breaker.$the_line_breaker."\n";
		if($the_continual==10){$the_complete_unlog_string="\nCONTINUED\n".$the_complete_unlog_string;}
		$bytes_write_activity_unlogger=fwrite($resource_to_append_date_unlogger,$the_complete_unlog_string);

					if(!$bytes_write_activity_unlogger)
			{      
				
				setcookie('authkey','',time()-60*60);//returns bool
				setcookie('clue','',time()-60*60);//returns bool
				session_destroy();
				$_SESSION=array();
				header("Location:$FILE/error_message.php?down=15");
				//whisks to error message.php  where error is shown that something went wrong writing the new unlogging in the activity
					exit();
			
			}
		
				}




					
					
				}
		}
