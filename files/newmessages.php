<?php 

require_once("/var/www/take/files/thekey.php");
require_once("/var/www/take/files/functions/trackker.php");
require_once("/var/www/take/files/functions/randomstring.php");
//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
session_start();
//trackker();
//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>
<?php
//only for users
//code_to extract the registration timestamp of the user
$connection_message=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
$email_id_message=$_SESSION['email_id'];
$query_to_extract="select registration_timestamp, username,friends from users_basic where email_id='$email_id_message'";
$result_to_extract=mysqli_query($connection_message,$query_to_extract)or die(mysqli_error($connection_message));
$answer_to_extract=mysqli_fetch_array($result_to_extract);
$registration_timestamp_message=$answer_to_extract['registration_timestamp'];
$username_message=$answer_to_extract['username'];
$all_friends_together_string=$answer_to_extract['friends'];
$database_message=$username_message.'___'.$email_id_message.'___'.$registration_timestamp_message;

$database_connected_message=mysqli_select_db($connection_message,$database_message);

?>
<?php
//sanitise the get string
//check if more than one variables are set in the get string if yes chuck the rest
$thecounterforgetstring=0;
foreach($_GET  as $thegetstring=>$valueofthegetstring)
{
//take care that the user tries not to pass additional arguments
//so if more than one varibles in get string;
//relapse to zero;
//if the user tries to pass an array or an associative array as the first or any argument
//relapse the get string to empty
//
	if(is_array($thegetstring))
		{$_GET="";}
	if($thecounterforgetstring!=0)
	{$_GET="";}
//does this need reconsideration
	if(!($_GET[$thegetstring]=='all' ||$_GET[$thegetstring]=='sent' ||$_GET[$thegetstring]=='recieved'))
	{$_GET[$thegetstring]="";}
	$thecounterforgetstring+=1;
	if(($_GET[$thegetstring]=='all')||($_GET[$thegetstring]=='')||($_GET==''))
	{$whichtabtoopenmessages=0;}	
	else if($_GET[$thegetstring]=='sent')
	{$whichtabtoopenmessages=1;}
	else if($_GET[$thegetstring]=='recieved')
	{$whichtabtoopenmessages=2;}
	
	
}


//construct the function which shall get the array out of a databse fetch array command and thereby construct the firt div which has a part of the message sender'reciever time and date 
//and whether read or not
//it shall have a view button which shall lead to opening of a div showing the entire message and the reply textfield
//make sure that the clicking of the button first triggers the closing of all such  divs already open and thereby then open the specific div
//trick class name and id name
function construct_the_message_div($the_message_array)
{
global $THEPATHTOEACHUSER;//from thekey.php

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
$thelink_tosender=$THEPATHTOEACHUSER.'?profile='.$the_profile_string_sender;

$thelink_toreciever=$THEPATHTOEACHUSER.'?profile='.$the_profile_string_reciever;
var_dump($the_profile_string_reciever);
$themessage_div=<<<messagediv
<b><a href="$thelink_tosender">$the_message_array_sender</a>----------><a href="$thelink_toreciever">$the_message_array_reciever</a></b>
<br>
<b>$the_message_array_date_sent&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$the_message_array_time_24</b>
<p>
$the_message_array_message
</p>
<p><a href='newmessages.php?click=reply&to=$the_profile_string_reciever'><button id='reply'>reply</button></a></p>
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
					success:function(){$("div#messagesentconfirmation").show();$("div#messagesentconfirmation").mouseenter(function(){$("div#messagesentconfirmation").hide();});$("div#messagesuccessfullysent").show();$("div#messagesuccessfullysent").mouseenter(function(){$("div#messagesuccessfullysent").hide();});}});
					
					return false;
					
					});
					
					
					
					});
</script>
<style>
body{background-image:url(<?=$IMAGE?>/basic.png);}
#complete{float:right;
          
          width:83%;
          height:100%;
          overflow:scroll;
          border-style:groove;
	       }
#container{float:center;
           overflow:scroll;
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
			background-color:#666699;
			opacity:0.7;}  
#panelbar{width:100%;
			height:10%;
			border-style:groove;
			border-bottom:0;
			
			}

.panel{width:90%;
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
#messagesuccessfullysent{width:200px;height:200px;position:absolute;left:70px;top:90px;display:none;}

.paginate{
		position:absolute;
		overflow:hidden;
		width:100%;
		height:66%;
		border-top:groove;
				background-color:#666699;
	   }
.pagiitems{position:absolute;
		height:9999999em;
		margin:0px;
		width:99%;
		}
.oneitem{
		padding:4px;
		margin-top:2px;
		height:180px;
		font-size:0.6em;
	     }

</style>
</head>
<body>
<div id="messagesuccessfullysent"></div>
<div id="complete">
	<div id="container">
		<div id="headbar">
		<pre><b>  MESSAGES</b>											you are logged in as<?="$username_message"?></pre> 
		</div>
		<div id="panelbar">
			<div class="panel">
					<div class="paneltabs" id="allpaneltab"><a href='newmessages.php?click=all'>all</a></div>
					<div class="paneltabs" id="allpaneltab"><a href='newmessages.php?click=sent'>sent</a></div>
					<div class="paneltabs" id="allpaneltab"><a href='newmessages.php?click=recieved'>recieved</a></div>
					<div class="paneltabs" id="allpaneltab"><a href='newmessages.php?click=unread'>unread</a></div>
               			<div class="paneltabs" id="allpaneltab"><a href='newmessages.php?click=new'>new message</a></div>
			</div>
		</div>
<script>

</script>
<?php
if(($parameter_determiner=='sent')||($parameter_determiner=='recieved')||($parameter_determiner=='all')||($parameter_determiner=='unread'))
{
if($parameter_determiner=='sent'){$query_get_messages="select * from all messages where sender_email_id='$the_email_id_in_cookie'";}
if($parameter_determiner=='recieved'){$query_get_messages="select * from all messages where reciever_email_id='$the_email_id_in_cookie'";}
if($parameter_determiner=='all'){$query_get_messages="select * from all messages";}
if($parameter_determiner=='unread'){$query_get_messages="select * from all messages where checked='0'";}
$result_get_messages=mysqli_query($connection_message,$query_get_messages);
echo "<div class='paginate vertical'>
			
			<div class='pagiitems'>";
$count_on_number_of_messages=0;
while(false!=($answer_get_messages=mysqli_fetch_array($result_get_messages)))
{
if(($count_on_number_of_messages%5)==0){echo "<div>";}
echo "<div class='oneitem'>";
construct_the_message_div($answer_get_messages);
echo "</div>";
if(($count_on_number_of_messages%5)==0){echo "</div>";}

}
}
else if(($parameter_determiner=='new'))
{$set_up=10;
if(isset($_GET['to']))
{
$the_checker=$_GET['to'];
$query_get_email_for_the_profile_string="select email_id from users_basic where profile_string='$the_checker'";
$result_get_email_for_the_profile_string=mysqli_query($connection_message,$query_get_email_for_the_profile_string);
$thesendto_email_fetched=mysqli_fetch_array($result_get_email_for_the_profile_string);
$thesendto_email=$thesendto_email_fetched['email_id'];
if(!isset($thesendto_email)){$thesendto_email='is this an email';$set_up=1;}
}
?>
<div id='panes'>
<?php if($set_up=1){echo "<h2>incorrect string passed</h2>";}?>
<form>
			to <select name="sendtonew" id="messsagesentto">
				<option value="def" >select_friend</option>
				<?php
				$friends_array_writemessage=explode("(`#$&^@!--`)",$all_friends_together_string);
						if(preg_match("/^$thesendto_email$/",$all_friends_together_string)){echo "<option value='$thesendto_email'>$thesendto_email</option>";}
						else{
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
			<p id="messagesentconfirmation"><h2>the message has been sent</h2></p>	
			</div>



<?php
}

?>	
			
				
				</div>
			
			<?php
			
// 			$select_userdatabase=mysqli_select_db($connection_message,$database_message);//change databse name here at the end
// 			
// 			$query_extract_allmessages="select * from allmessages ORDER BY timestamp";
// 			$result_extract_allmessages=mysqli_query($connection_message,$query_extract_allmessages)or var_dump(mysqli_error($connection_message));
// 			$count_all_messages=0;
// 				
// 				while(false!=($array_answer=mysqli_fetch_array($result_extract_allmessages)))
// 				{//var_dump($array_answer);
// 				if(($count_all_messages)%5==0){echo "<div>";}//rollup	
// 					echo "<div class='rollupdiv'>";//echo "shsj";
// 					construct_the_message_div($array_answer);
// 					echo "</div>";
// 				if(($count_all_messages)%5==0){echo "</div>";}//rollup
// 				$count_all_messages+=1;
// 				}
// 				if(!$count_all_messages)
// 				{
// 					echo"<pre>there are no messages to display</pre>";
// 				}
// 			
// 				//	else if($count_allmessages==20)
// 			//	{
// 		//			echo"<div>show older messages</div>";
// 		//		}
// 		//should i do this ??
?>			
					
		<script>


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
<script> 
// execute your scripts when DOM is ready. this is a good habit
$(function() /*{
				$(".vertical").scrollable({ vertical: true, mousewheel: true });	
					});*/
</script>
</div>
</div>
</div>

</body>
</html>