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
/*$THEEMAILIDINSESSION=$_SESSION['email_id'];
$connection_welcome=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
 $query_THE_LEAD=mysqli_query($connection_welcome,"select profile_string from users_basic where email_id='$THEEMAILIDINSESSION'")or die(mysqli_error($connectiom_welcome));
$fetch_the_lead=mysqli_fetch_array($query_THE_LEAD);
$profile_string_this_is=$fetch_the_lead['profile_string'];
*/

trackker();

//only for users
//code_to extract the registration timestamp of the user
$connection_message=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
$email_id_message=$_SESSION['email_id'];
$query_to_extract="select registration_timestamp, username,friends,profile_string from users_basic where email_id='$email_id_message'";
$result_to_extract=mysqli_query($connection_message,$query_to_extract)or die(mysqli_error($connection_message));
$answer_to_extract=mysqli_fetch_array($result_to_extract);
$registration_timestamp_message=$answer_to_extract['registration_timestamp'];
$username_message=$answer_to_extract['username'];
$all_friends_together_string=$answer_to_extract['friends'];
$the_my_unique_profile_string=$answer_to_extract['profile_string'];
$database_message=$username_message.'___'.$email_id_message.'___'.$registration_timestamp_message;

$database_connected_message=mysqli_select_db($connection_message,$database_message);

?>

<?php

function construct_the_message_div($the_message_array)
{
global $the_my_unique_profile_string;
global $THEPATH_TO_EACH_USER;//from thekey.php

	{
	 //extract the entire array
	$the_message_array_sender=$the_message_array['sender'];
	$the_message_array_reciever=$the_message_array['reciever'];
	$the_message_array_message=$the_message_array['message'];
	$the_message_array_time_24=$the_message_array['time_24'];
	$the_message_array_date_sent=$the_message_array['date_message'];
	$the_message_array_read=$the_message_array['checked'];
	$email_id_different_1=$the_message_array['reciever_email_id'];//stores the sender or user email id '''whatevre is differenet from that in the session
	$email_id_different_2=$the_message_array['sender_email_id'];//stores the sender or user email id '''whatevre is differenet from that in the session
	if($email_id_different_1==$_SESSION['email_id']){$email_id_different=$email_id_different_2;}
	if($email_id_different_2==$_SESSION['email_id']){$email_id_different=$email_id_different_1;}
	$the_profile_string_sender=$the_message_array['sender_profile_string'];
	$the_profile_string_reciever=$the_message_array['reciever_profile_string'];
	}
$thelink_tosender=$THEPATH_TO_EACH_USER.'?profile='.$the_profile_string_sender;
if($the_my_unique_profile_string==$the_profile_string_sender){$the_different_profile_string=$the_profile_string_reciever;}
if($the_my_unique_profile_string==$the_profile_string_reciever){$the_different_profile_string=$the_profile_string_sender;}
$thelink_toreciever=$THEPATH_TO_EACH_USER.'?profile='.$the_profile_string_reciever;
//
//var_dump($thelink_tosender,$thelink_toreciever);
$themessage_div=<<<messagediv
<b><a href="$thelink_tosender">$the_message_array_sender</a>----------><a href="$thelink_toreciever">$the_message_array_reciever</a></b>
<br>
<b>$the_message_array_date_sent&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$the_message_array_time_24</b>
<p>
$the_message_array_message
</p>
<p><a href='demomessages.php?go=createnew&to=$the_different_profile_string'><button id='reply'>reply</button></a></p>
messagediv;
echo $themessage_div;
}



?>
<html>
<head>

<script src="<?=$JQUERY?>/jquery.tools.min.js"></script>
<script>
$(document).ready(function(){$(".replybutton").click(function(){
					var theotheremail=$(this).attr('id');
					var themessage=$('textarea#'+theotheremail).val();
					
					var themessagestring='sendto'+theotheremail+'&message'+themessage;
					$.ajax({
					type:'POST',url:'<?=$FILE?>/downhandler.php',
					data:themessagestring,
					success:function(){$("div#messagesuccessfullysent").show();$("div#messagesuccessfullysent").mouseenter(function(){$("div#messagesuccessfullysent").hide();});}});
					
					return false;
					//	POSTION THE MESSAGE SUCCESFULLY SNET DIV ABSOLUTELY
					//i might need to clear up the fom fields
					});
					$("#sendnewmessage").click(function(){
					//var theotheremail=$(this).attr('id');
					var themessage=$('textarea').val();
					var recipient=$('select').val();
					var themessagestring='sendto='+recipient+'&message='+themessage;

					$.ajax({
					type:'POST',url:'<?=$FILE?>/message_handler.php',
					data:themessagestring,
					success:function(){$("#messagesentconfirmation").css('display','block');$("div#messagesentconfirmation").mouseenter(function(){$("div#messagesentconfirmation").hide();});$("div#messagesuccessfullysent").show();$("div#messagesuccessfullysent").mouseenter(function(){$("div#messagesuccessfullysent").hide();});}});
					
					return false;
					
					});
					
					
					
					});
</script>

<style>
.anchoraccordionlinksnavigation{text-decoration:none;}
.accordionlinksnavigation{width:20%;height:40%;margin-left:2px;margin-right:3px;float:left;border-style:dotted;}							         
#accordion{
	
	width:2000px;
	margin-top:2px;
	margin-bottom:5px;
	padding-right:7px;
	height:27%;
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
#allmessages{width:100%;;height:100%;overflow:scroll;margin:auto;background-color:silver;}
#alllinks{height:10%;width:100%;border-style:groove;background-color:silver;}
.mylinks{height:100%;width:13%;border-style:groove;background-color:silver;float: left;}

</style>
</head>
<body>
<div id="complete" style="overflow:hidden;">
<div id="cointainer">
<div id="alllinks">
<div class="mylinks">
<a href="demomessages.php?go=all" >allmessages</a>
</div>
<div class="mylinks">
<a href="demomessages.php?go=sent" >sent</a>
</div>
<div class="mylinks">
<a href="demomessages.php?go=recieved" >recieved</a>
</div>
<div class="mylinks">
<a href="demomessages.php?go=createnew&to=000000000" >new message</a>
</div>
<div>
LOGGED IN AS <?=$username_message?>
</div>
</div>
<br>
<div id="allmessages">

<?php

if(!(($_GET['go']=='sent') ||($_GET['go']=='recieved')||($_GET['go']=='createnew')))
	{$_GET['go']="all";}


	$parameter_determiner=$_GET['go'];//var_dump($parameter_determiner);
if(($parameter_determiner=='sent')||($parameter_determiner=='recieved')||($parameter_determiner=='all'))
{
if($parameter_determiner=='sent'){$query_get_messages="select * from allmessages where sender_email_id='$email_id_message' ORDER BY timestamp desc";}
if($parameter_determiner=='recieved'){$query_get_messages="select * from allmessages where reciever_email_id='$email_id_message' ORDER BY timestamp desc";}
if($parameter_determiner=='all'){$query_get_messages="select * from allmessages ORDER BY timestamp desc";}
//echo "ghjgsjgj";
$result_get_messages=mysqli_query($connection_message,$query_get_messages)or die(mysqli_error($connection_message));

			
		
$count_on_number_of_messages=0;
while(false!=($answer_get_messages=mysqli_fetch_array($result_get_messages)))
{

echo "<div class='oneitem'>";
construct_the_message_div($answer_get_messages);
echo "</div>";


}
}
else if(($parameter_determiner=='createnew'))
{
$set_up=10;
if(isset($_GET['to']))
{
	$bak_too_general_database=mysqli_select_db($connection_message,$databasename);
$the_checker=$_GET['to'];
$query_get_email_for_the_profile_string="select email_id from users_basic where profile_string='$the_checker'";
$result_get_email_for_the_profile_string=mysqli_query($connection_message,$query_get_email_for_the_profile_string)or die(mysqli_error($connection_message));
$thesendto_email_fetched=mysqli_fetch_array($result_get_email_for_the_profile_string);
//var_dump($thesendto_email_fetched);
$thesendto_email=$thesendto_email_fetched['email_id'];
//var_dump($all_friends_together_string);
//var_dump($thesendto_email);
//$bak_too_general_database=mysqli_select_db($connection_message,$);
if(!isset($thesendto_email)){$thesendto_email='is this an email';$set_up=1;}
}
 if($set_up==1){echo "<h2>select friend</h2>";}?>
<form>
			to <select name="sendtonew" id="messsagesentto">
				
				<?php     //var_dump($set_up);
				$friends_array_writemessage=explode("(`#$&^@!--`)",$all_friends_together_string);//var_dump(preg_match("/$thesendto_email/",$all_friends_together_string));
						if(preg_match("/$thesendto_email/",$all_friends_together_string)){echo "yes";echo "<option value='$thesendto_email'>$thesendto_email</option>";}
						else{
							echo "<option value='def' >select_friend</option>";
						foreach($friends_array_writemessage as $my_friend_n)
						{
						echo "<option value='$my_friend_n'>$my_friend_n</option>";	
						
						}}
				?>
			
			</select>			<br>
			the message		<br>
			<textarea rows="8" cols="50" name="message">
			
			
			</textarea>		<br>
			<button name="submit" id="sendnewmessage">send message</button>
			</form>		
			<p id="messagesentconfirmation" style="display:none;">the message has been sent</p>	
			</div>



<?php
}

?>	









?>

</div>
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
</div>
<script type="text/javascript" >
     $(function() {
 
                      $("#accordion").tabs(".insideaccordion", {
 	                   tabs: '.tabes', 
 	                    effect: 'horizontal'
                         });
                 });

</script>
</body>
</html>