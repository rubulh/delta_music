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
// $THEEMAILIDINSESSION=$_SESSION['email_id'];
// $connection_welcome=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
//  $query_THE_LEAD=mysqli_query($connection_welcome,"select profile_string from users_basic where email_id='$THEEMAILIDINSESSION'")or die(mysqli_error($connectiom_welcome));
// $fetch_the_lead=mysqli_fetch_array($query_THE_LEAD);
// $profile_string_this_is=$fetch_the_lead['profile_string'];


trackker();
?>


<?php

$email_id_currently_logged_in=$_SESSION['email_id'];
//sanitise the get variable
//get if it is not a email_id
//echo no such user exists
//else take to this page
//
$permission_viewprofile=70;//arbit
$connection_viewprofile=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword);
$_GET['profile']=mysqli_real_escape_string($connection_viewprofile,htmlentities($_GET['profile']));
//$after_filter_get_string=filter_var($GET['email_id'],FILTER_VALIDATE_EMAIL);;;;;new idea hides the email
//if($after_filter_get_string!=$GET['email_id'])
//{
//header("Location:$FILE/error_message.php?down=24");
//}

//code_to extract the registration timestamp of the user
mysqli_select_db($connection_viewprofile,$databasename);
$profile_string_viewprofile=$_GET['profile'];
$query_to_extract_viewprofile="select registration_timestamp,username,email_id,friends,fr_in,fr_out from users_basic where profile_string='$profile_string_viewprofile'";
$result_to_extract_viewprofile=mysqli_query($connection_viewprofile,$query_to_extract_viewprofile)or die(mysqli_error($connection_viewprofile));
$answer_to_extract_viewprofile=mysqli_fetch_array($result_to_extract_viewprofile);
$registration_timestamp_viewprofile=$answer_to_extract_viewprofile['registration_timestamp'];
$username_viewprofile=$answer_to_extract_viewprofile['username'];
$email_id_viewprofile=$answer_to_extract_viewprofile['email_id'];
$friends_string_viewprofile=$answer_to_extract_viewprofile['friends'];
$fr_in_string_viewprofile=$answer_to_extract_viewprofile['fr_in'];
$fr_out_string_viewprofile=$answer_to_extract_viewprofile['fr_out'];
$friends_array_viewprofile=explode("(`#$&^@!--`)",$friends_string_viewprofile);
$fr_in_array_viewprofile=explode("(`#$&^@!--`)",$fr_in_string_viewprofile);
$fr_out_array_viewprofile=explode("(`#$&^@!--`)",$fr_out_string_viewprofile);
$user_specificdatabase_viewprofile=$username_viewprofile.'___'.$email_id_viewprofile.'___'.$registration_timestamp_viewprofile;

$database_change_viewprofile=mysqli_select_db($connection_viewprofile,$user_specificdatabase_viewprofile);
$query_get_common_user_details="select name,course,branch,year,about_me from usercomplete;";//single row table
$result_get_common_user_details=mysqli_query($connection_viewprofile,$query_get_common_user_details);
$answer_get_common_user_details=mysqli_fetch_array($result_get_common_user_details);
$name_result_get_common_user_details=$answer_get_common_user_details['name'];
$course_result_get_common_user_details=$answer_get_common_user_details['course'];
$branch_result_get_common_user_details=$answer_get_common_user_details['branch'];
$year_result_get_common_user_details=$answer_get_common_user_details['year'];
$about_me_result_get_common_user_details=$answer_get_common_user_details['about_me'];
?>
<!--

//user complete desc...copied
					$next_three_panes_result_fetched_name=$next_three_panes_result_fetched['name'];
					$next_three_panes_result_fetched_course=$next_three_panes_result_fetched['course'];
					$next_three_panes_result_fetched_branch=$next_three_panes_result_fetched['branch'];
					$next_three_panes_result_fetched_year=$next_three_panes_result_fetched['year'];
					$next_three_panes_result_fetched_dob=$next_three_panes_result_fetched['dob'];
					$next_three_panes_result_fetched_about_me=$next_three_panes_result_fetched['about_me'];

					$next_three_panes_result_fetched_email_id=$next_three_panes_result_fetched['email_id']-->
<?php
//permission setting variable
//if the email_id of the user of this page is equal to that in the session_email_id;
$email_id_viewer=$_SESSION['email_id'];
//var_dump($email_id_viewer,$email_id_viewprofile);
if($email_id_viewer==$email_id_viewprofile)
	{$permission_viewprofile=(99);//for self
	}
//hide the add as a friend div and also
//hide the edit edit links all over the place



foreach($fr_in_array_viewprofile as $fr_in_already_in_list)
	{
	if($fr_in_already_in_list==$email_id_viewer)
		{//respond to request
		$permission_viewprofile=(22);
		break;
		}
	}

foreach($fr_out_array_viewprofile as $fr_out_already_in_list)
	{
	if($fr_out_already_in_list==$email_id_viewer)
		{//friend requested already
		$permission_viewprofile=(55);
		break;
		}
	}
	
	

foreach($friends_array_viewprofile as $friends_already_in_list)
	{
	if($friends_already_in_list==$email_id_viewer)
		{//already in friends list
		$permission_viewprofile=(11);
		break;
		}
	}

//if self==99
//if in friends=11
//respond to req=22
//requested but no response=55
//general=70
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
			height:30%;
			border-style:groove;
			background-color:#9999CC;
			}
#image{width:17%;
	height:90%;
	border-style:dotted;
	float:left;
	}
#theusernameanddetails{width:79%;
	height:90%;
	border-style:dotted;
	float:right;}
#name{width:100%;
	height:30%;
	border-style:dotted;}
#somedetails{width:100%;
	height:67%;
	border-style:dotted;}
#panelbar{width:100%;
			height:10%;
			border-style:groove;
			border-bottom:0;
			
			}

.panel{width:70%;
		height:94%;
		
		border:0;
		
		
		}
.paneltabs{width:17%;
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
		height:70%;
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
			<div id="image">i ll add later</div>
			<div id="theusernameanddetails">
			<div id="name"><?=$username_viewprofile?></div>
			<div id="somedetails"><?php  echo"$course_result_get_common_user_details&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$branch_result_get_common_user_details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$year_result_get_common_user_details";   ?></div>
			</div>
			
		</div>
		<div id="panelbar">
			<div class="panel">
					<div class="paneltabs">info</div>
					<div class="paneltabs">about <?=$username_viewprofile?></div>
               <div class="paneltabs">friends</div>
             	
<?php 

//if self==99
//if in friends=11
//respond to req=22
//requested but no response=55
//general=70

	if($permission_viewprofile==(11) ||$permission_viewprofile==(99)) {//nothing required
																							}
	if($permission_viewprofile==(70)) {echo "<div class='paneltabs'>friend_request</div>";}
	if($permission_viewprofile==(55)) {echo "<div class='paneltabs'>respond_to_request</div>";}
	if($permission_viewprofile==(22)) {echo "<div class='paneltabs'>friend_requested already</div>";}
?>
			</div>
		</div>
	
		<div class="panes">
			<div class="panecontents" style="text-align:center;">
<?php
echo"<br><br>Name:$name_result_get_common_user_details<br><br>Course:$course_result_get_common_user_details<br><br>Branch:$branch_result_get_common_user_details<br><br>Year:$year_result_get_common_user_details";

?>
			</div>
			<div class="panecontents">
<?php
echo "<br><br>$about_me_result_get_common_user_details";
//var_dump($permission_viewprofile);
?>
			</div>
			<div class="panecontents" style="overflow:scroll;">
            
<?php				//var_dump($friends_array_viewprofile);
				$counter_to_keep_number_of_friends_viewprofile=0;
				$back_to_general_database_viewprofile=mysqli_select_db($connection_viewprofile,$databasename);//change to general database
				foreach($friends_array_viewprofile as $one_friend_email_viewprofile)
				{
				
				$query_get_friend_email_and_profile_string_viewprofile="select username, profile_string from users_basic where email_id='$one_friend_email_viewprofile'";
				$result_get_friend_email_and_profile_string_viewprofile=mysqli_query($connection_viewprofile,$query_get_friend_email_and_profile_string_viewprofile);
				
				$friend_get_the_string_viewprofile=mysqli_fetch_array($result_get_friend_email_and_profile_string_viewprofile);
					{$friend_get_the_string_username_viewprofile=$friend_get_the_string_viewprofile['username'];
					 $friend_get_the_string_profile_string_viewprofile=$friend_get_the_string_viewprofile['profile_string'];
					$make_the_link_to_friend=$THEPATH_TO_EACH_USER.'?profile='.$friend_get_the_string_profile_string_viewprofile;
					if(($counter_to_keep_number_of_friends_viewprofile)%5==0){echo "<div>";}//rollupdiv
						?>
						<div class='smalldivnsiderollup'>
						<a href="<?='$make_the_link_to_friend'?>"><?=$friend_get_the_string_username_viewprofile?></a>
						</div><!--small div insiderollup-->
						<?php
					if(($counter_to_keep_number_of_friends_viewprofile)%5==0){echo "</div>";}//rollupdiv
					$counter_to_keep_number_of_friends_viewprofile+=1;
					}
				}
	?>			
								
		</div><!--panecontents-->
			<?php
				
				//if self==99
				//if in friends=11
				//respond to req=22
				//requested but no response=55
				//general=70

	if($permission_viewprofile==(11) ||$permission_viewprofile==(99)) {//nothing required
																							}
	if($permission_viewprofile==(70)) {echo "<div class='panecontents'>";//echo "kick";
			
				echo "<h2>send a friend request to $username_viewprofile</h2>";
					//echo "<button class='sendfriend_request' id='$profile_string_viewprofile'>send request</button>";
					echo "<input type='button' value='send request' class='sendfriend_request' id='$profile_string_viewprofile'>";
					
			
			
			
			
			echo "</div>";
			}
	if($permission_viewprofile==(55)) {echo "<div class='panecontents'>";
			
				echo " <h2>respond to friend request of $username_viewprofile</h2>";
					echo "<button class='accept_request' id='$profile_string_viewprofile'>accept request</button>";
					echo "<button class='reject_request' id='$profile_string_viewprofile'>reject request</button>";
				
			
			
			
			
			echo "</div>";}
	if($permission_viewprofile==(22)) {echo "<div class='panecontents'>";
			
				echo "<h2>already friend requested $username_viewprofile</h2>";
					
					
			
					
			
			
			
			
			echo "</div>";}

		
			?>
				
		</div><!--panes-->
		</div>
		<script>
$(document).ready(function(){$('.sendfriend_request').click(function(){var sendto=$(this).attr('id');var request='friendreqto='+sendto;$.ajax({type:'POST',url:'sendfriendrequest.php',data:request,success:function(){document.write(request);}});return});})
$(document).ready(function(){$('.accept_request').click(function(){var accfrom=$(this).attr('id');var request='friendaccfrom='+accfrom;$.ajax({type:'POST',url:'acceptfriendrequest.php',data:request,success:function(){location.reload();}});});});
$(document).ready(function(){$('.reject_request').click(function(){var rejfrom=$(this).attr('id');var request='friendrejfrom='+rejfrom;$.ajax({type:'POST',url:'rejectfriendrequest.php',data:request,success:function(){location.reload();}});});});
$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("div.panel").tabs("div.panes > div");
});
</script>		
 
	
	<div id="accordion">
   	<img src="<?=$IMAGE?>/menavigation.png" class="tabes" alt="me" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p style="font-size:10px;">
       <pre>
       <a href="me.php" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">me</div></a>     
      <a href="viewprofile.php?profile=<?=$profile_string_this_is?>" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">profile</div></a>
	<a href="songrequests.php" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">songrequests</div></a>           
	</pre>       
       </p>      
      </div>
   
    <img src="<?=$IMAGE?>/musiclibrarynavigation.png" class="tabes" alt="musiclibrary" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p style="font-size:10px;">
         <pre>
		 <a href="musiclibrary.php" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">library</div></a>     
     		 <a href="musiclibrary.php?librarypath=mostplayed" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">favourates</div></a>
		<a href="musiclibrary.php?librarypath=myplaylists" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="height:35%;">myplaylists</div></a>   
        </pre>                   
       </p>      
      </div>

	<img src="<?=$IMAGE?>/messagesnavigation.png" class="tabes" alt="messages" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p style="font-size:10px;">
         <pre>
		 <a href="demomessages.php?go=all" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">all</div></a>     
     		 <a href="demomessages.php?go=sent" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">sent</div></a>
		<a href="demomessages.php?go=recieved" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="height:35%;">recieved</div></a>   
        </pre>                   
       </p>      
      </div>
      
     <img src="<?=$IMAGE?>/accountnavigation.png" class="tabes" alt="account" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p>
       	<pre>
		 <a href="editprofile.php" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">settings</div></a>     
     		 <a href="primarycontacts.php" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">contacts</div></a>
		<!-- <a href="" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="height:35%;">change<br>password</div></a> -->   
        </pre>  
                    
       </p>      
      </div>
	<img src="<?=$IMAGE?>/logoutnavigation.png" class="tabes" alt="logout" >
	  
      <div class="insideaccordion" style="width:410px;height:100px;margin-top:5px;background-color:#666699;">
       <p>
       	<pre>
		<a href="logout.php">logout</a> 
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
<script> 
// execute your scripts when DOM is ready. this is a good habit
$(function() {		
		
	// initialize scrollable with mousewheel support
	$(".paginate").scrollable({ vertical: true, mousewheel: true });	
	
});
</script>
</div>

</div>

</body>
</html>