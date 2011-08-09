<?php 
require_once("/var/www/take/files/thekey.php");

//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>
<?php
//code_to extract the registration timestamp of the user
$connection_request=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
$email_id_request=$_SESSION['email_id'];//email_id unique
$query_to_request="select registration_timestamp, username,friends from users_basic where email_id=$email_id_message";
$result_to_request=mysqli_query($connection_request,$query_to_request);
$answer_to_me=mysqli_fetch_array($result_to_request);
$registration_timestamp_request=$answer_to_request['registration_timestamp'];
$username_request=$answer_to_request['username'];
$allfriends_string_request=$answer_to_request['friends'];
$database_request="$username_request-$email_id_request--$registration_timestamp_request";

$database_connected_request=mysqli_select_db($connection_request,$database_request);

?>
<html>
<head>
<script src="<?=$JQUERY?>/jquery.tools.min.js"></script>
<style>
body{background-image:url(<?=$IMAGE?>/basic.png);}
#complete{float:right;
          
          width:83%;
          height:100%;
          overflow:hidden;
          border-style:groove;
	       }
#container{float:center;
           overflow:hidden;
           width:100%;
           height:82%;
          
           margin-top:0px;
           margin-bottom:1px;
           margin-left:0px;
           margin-right:0px;
           }	       
#headbar{width:100%;
			float:center;
			height:7%;
			border-style:groove;
			background-color:#9999CC;
			opacity:0.7;}  
#panelbar{width:100%;
			height:10%;
			border-style:groove;
			border-bottom:0;
			
			}

.panel{width:85%;
		height:94%;
		
		border:0;
		
		
		}
.paneltabs{width:14%;
				height:76%;
				border-style:ridge;
				float:left;
				background-color:#666699;
				opacity:0.7;
				border-left-color:gray;
				border-right-color:gray;
				border-bottom:0;
				//border-left:none;
				text-align:center;
				padding-top:14px;
				//border-bottom-color:#666699;
			}
div.paneltabs.current{background-color:#666699;opacity:1.0;border-bottom:0;height:77%;border-style:inset;}				
.panes{
		width:100%;
		height:99%;
		//border-style:ridge;
		//border-color:#6666CC;
		
		}
.panes div{display:none;
				}
.panecontents{width:100%;
					height:100%;
					border-style:dotted;
					border-color:silver;
					border-left:none;
					border-right:none;
					border-top:none;
					background-color:#666699;
					//opacity:0.8;
					text-align:left;
					}								         
.anchoraccordionlinksnavigation{text-decoration:none;}
.accordionlinksnavigation{width:20%;height:40%;margin-left:2px;margin-right:3px;float:left;border-style:dotted;}							         
#accordion{
	
	width:2000px;
	margin-top:2px;
	margin-bottom:5px;
	padding-right:7px;
	height:18%;
	float:left;
	border-top-style:groove;
	border-top-color:silver;
	overflow:hidden;
	}
#accordion img {
	float:left;
	margin-right:-1px;
	margin-left:5px;
	margin-top: 2px;
	cursor:pointer;
	opacity:0.5;
	filter: alpha(opacity=50);
	}
	
	
#accordion img.current {
	cursor:default;
	opacity:1;
	filter: alpha(opacity=100);
}

.insideaccordion{
	width:0px;
	float:left;	
	display:none;		
	margin-right:10px;
}
</style>
</head>
<body>
<div id="complete">
	<div id="container">
		<div id="headbar">
		<pre><b> requests</b>											you are logged in as<?="$username_request"?></pre> 
		</div>
		<div id="panelbar">
			<div class="panel">
					<div class="paneltabs">all requests</div>
					<div class="paneltabs">song requests</div>
					<div class="paneltabs">friend request</div>
               			
			</div>
		</div>
		
<?php




		
		
?>		
		<div class="panes">
			<div class="panecontents">
			<!--<div class="mainpane" style="width:100%;height:100%;">-->
			   <div class="alltogether">
				
					
					<?php
						//..database is the user specific database
						$query_to_get_allrequest="select * from allrequests order by allrequests_timestamp";//should i limit
						$result_to_get_allrequest=mysqli_query($connection_request,$query_to_get_notifications);
						$counter_to_note_the_number_of_notifications=0;
							while(false!=($one_notification_array=mysqli_fetch_array($result_to_get_notifications)))
								{
									if((($counter_to_note_the_number_of_notifications)%5)==0){echo "<div>";}//five on a scroll
										//code to create the inside divs
										{
										//fields are
										/*
										notification_timestamp,
										notification_time_24,
										notification_date,
										notification_by_email,
										notification_by,
										notification_category,
										notification_details,
										notified_song--contains the id for anchor
										*/
										
										//not sure if as to put download in notification
										$one_notification_array_notification_timestamp=$one_notification_array['notification_timestamp'];
										$one_notification_array_notification_time_24=$one_notification_array['notification_time_24'];
										$one_notification_array_notification_date=$one_notification_array['notification_date'];
										$one_notification_array_notification_by_email=$one_notification_array['notification_by_email'];
										$one_notification_array_notification_by=$one_notification_array['notification_by'];
										$one_notification_array_notification_by=$one_notification_array['notification_by_profile_string'];
										$one_notification_array_notification_category=$one_notification_array['notification_category'];
										$one_notification_array_notification_details=$one_notification_array['notification_details'];
										//for a song uplad and download the details are empty
										//for a comment i have stored the comment
										$one_notification_array_notified_song=$one_notification_array['notified_song'];
										$one_notification_array_notified_song_title=$one_notification_array['notified_song_title'];
												{//construct the div here
												echo "
												<div class='smalldivnsiderollup'>
													<b>$one_notification_array_notification_date</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>$one_notification_array_notification_time_24</i><br><b>$one_notification_array_notification_by</b>";//one inside scroll
													$thelink_to_the_song_anchor="'$THEALLSONGANCHOR'.'$one_notification_array_notified_song'";
													if($one_notification_array_notification_category=='upload'){echo "uploaded <a href='$thelink_to_the_song_anchor' style='font-weight:700;'>$one_notification_array_notified_song_title</a><br>";}

													if($one_notification_array_notification_category=='download'){echo "downloaded <a href='$thelink_to_the_song_anchor' style='font-weight:700;'>$one_notification_array_notified_song_title</a><br>";}



													if($one_notification_array_notification_category=='rate'){echo "rated <a href='$thelink_to_the_song_anchor' style='font-weight:700;'>$one_notification_array_notified_song_title</a>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;$one_notification_array_notification_details<br>";}

													if($one_notification_array_notification_category=='comment'){echo "commented on <a href='$thelink_to_the_song_anchor' style='font-weight:700;'>$one_notification_array_notified_song_title</a>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;$one_notification_array_notification_details<br>";}




												echo "</div>";//one at imside scroll

												}									 
	
									}
								
									if((($counter_to_note_the_number_of_notifications)%5)==0)
									{echo "</div>";}//five on a scroll

								}
							if($counter_to_note_the_number_of_notifications==0)
							{
							//this will never happen cause i ll add the first notification on the registration itself	
							}
			

					?>					
				
			   </div><!-- altogether -->
			<!--</div>--><!--mainpane-->
			</div><!-- panecontents -->
			
			
			
			<div class="panecontents" style="text-align:center;">
			<?php
			//..database is the user specific database
			$query_contacts="select * from usercomplete ";
			$query_next_three_panes=mysqli_query($connection_me,$query_contacts);
			//this single query gives all the next three panecontents
			/*
			fields for usercomplete-don't need email-id
			name
			course
			branch
			year
			dob
			about me??decode html
			contacts-phone//for now make it work
			email
			*/
				{
					//fetch and extract the values from the array
					$next_three_panes_result_fetched=mysqli_fetch_array($connection_me,$query_next_three_panes);
					$next_three_panes_result_fetched_name=$next_three_panes_result_fetched['name'];
					$next_three_panes_result_fetched_course=$next_three_panes_result_fetched['course'];
					$next_three_panes_result_fetched_branch=$next_three_panes_result_fetched['branch'];
					$next_three_panes_result_fetched_year=$next_three_panes_result_fetched['year'];
					$next_three_panes_result_fetched_dob=$next_three_panes_result_fetched['dob'];
					$next_three_panes_result_fetched_about_me=$next_three_panes_result_fetched['about_me'];

					$next_three_panes_result_fetched_email_id=$next_three_panes_result_fetched['email_id'];

				}
$theoutputininfopane=<<<INFOPANEOUTPUT
<br><br><br><br>
<b>Name:$next_three_panes_result_fetched_name</b><br><br><br>
<b>Course:$next_three_panes_result_fetched_course</b><br><br><br>
<b>Branch:$next_three_panes_result_fetched_branch</b><br><br><br>
<b>Year:$next_three_panes_result_fetched_year</b><br><br><br>
<a href="$FILE/view.php">view profile</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="$FILE/editprofile.php">edit profile</a>
INFOPANEOUTPUT;
echo $theoutputininfopane;
			?>


			</div><!--panecontents-->
			
			<div class="panecontents">
			<div class="altogether">
				<?php
					$query_get_friend_request="select * from allrequests where category=friendrequests ordeer by timestamp_request desc";
					$result_get_friend_request=mysqli_query($connection_request,$query_get_friend_request);
					$counter_number_of_friend_request=0;
					while(false!=($answer_get_friend_request=mysqli_fetch_array($result_get_friend_request)))
						{
						$name_answer_get_friend_request=$answer_get_friend_request['username_requester'];
						$email_id_answer_get_friend_request=$answer_get_friend_request['email_id_requester'];
						$time_24_answer_get_friend_request=$answer_get_friend_request['time_24'];
						$date_answer_get_friend_request=$answer_get_friend_request['date'];
						$profile_string_request_senderanswer_get_friend_request=$answer_get_friend_request['sender_profile_string'];
						if(($counter_number_of_friend_request)%5==0)echo "<div>";//rollup
							echo "<div class='smalldivnsiderollup'>";
							$the_link_to_sender_profile_page=$THEPATHTOEACHUSER.'?profile='.$profile_string_request_senderanswer_get_friend_request;
							?>
							
							<a href="<?=$the_link_to_sender_profile_page?>"><?=$name_answer_get_friend_request?></a> friend requested you<br>
							<button class='acceptfriendrequest' id='<?=$profile_string_request_senderanswer_get_friend_request?>'> accept</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class='rejectfriendrequest' id='<?=$profile_string_request_senderanswer_get_friend_request?>'>reject</button>
							</div><!--small div insiderollup-->
							<?php
							echo'</div>';
						if(($counter_number_of_friend_request)%5==0)echo "</div>";//rollup
						$counter_number_of_friend_request+=1;
						}
				?>
			</div><!--altogether-->
			</div><!--panecontents-->

			
			</div><!-- panes-->
		
		<script>


$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("div.panel").tabs("div.panes > div");
});

$(document).ready(function(){$('.acceptfriendrequest').click(function(){var sendfro=$(this).attr('id');var confirmreq='requestfrom='+sendfro;$.ajax({type:"POST",URL:acceptfriendrequest.php,data:confirmreq,success:function(){$('#confirmedrequest').show();$('#confirmedrequest').mouseover(function(){(this).hide();});};});});

$('.rejectfriendrequest').click(function(){var sendfro=$(this).attr('id');var rejectreq='requestfrom='+sendfro;$.ajax({type:"POST",URL:rejectfriendrequest.php,data:rejectreq,success:function(){$('#rejectedrequest').show();$('#rejectedrequest').mouseover(function(){(this).hide();});};});});

});
</script>		
 
	</div>
	<div id="accordion">
   	<img src="<?=$IMAGE?>/menavigation.png" class="tabes" alt="me" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p style="font-size:10px;">
       <pre>
       <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">me</div></a>     
      <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">profile</div></a>
	<a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">songrequests</div></a>           
	</pre>       
       </p>      
      </div>
   
    <img src="<?=$IMAGE?>/musiclibrarynavigation.png" class="tabes" alt="musiclibrary" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p style="font-size:10px;">
         <pre>
		 <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">library</div></a>     
     		 <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">favourates</div></a>
		<a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="height:35%;">myplaylists</div></a>   
        </pre>                   
       </p>      
      </div>

	<img src="<?=$IMAGE?>/messagesnavigation.png" class="tabes" alt="messages" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p style="font-size:10px;">
         <pre>
		 <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">all</div></a>     
     		 <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">sent</div></a>
		<a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="height:35%;">recieved</div></a>   
        </pre>                   
       </p>      
      </div>
      
     <img src="<?=$IMAGE?>/accountnavigation.png" class="tabes" alt="account" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p>
       	<pre>
		 <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">settings</div></a>     
     		 <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">contacts</div></a>
		<a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="height:35%;">change<br>password</div></a>   
        </pre>  
                    
       </p>      
      </div>
	<img src="<?=$IMAGE?>/logoutnavigation.png" class="tabes" alt="logout" >  
      <div class="insideaccordion" style="width:410px;height:100px;margin-top:5px;background-color:#666699;">
       <p>
       	<pre>
		<a href="">logout</a> 
     	   </pre>  
                    
       </p>      
      </div>
</div>
           <script> 
                $(function() {
 
                       $("#accordion").tabs(".insideaccordion", {
	                   tabs: '.tabes', 
	                    effect: 'horizontal'
                        });
                });
           </script>



</div>

</body>
</html>
