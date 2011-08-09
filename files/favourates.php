<?php 
require_once("/var/www/take/files/thekey.php");

//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>
<?php
//code_to extract the registration timestamp of the user
$connection_me=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
$email_id_me=$_SESSION['email_id'];//email_id unique
$query_to_me="select registration_timestamp, username from users_basic where email_id=$email_id_message";
$result_to_me=mysqli_query($connection_message,$query_to_me);
$answer_to_me=mysqli_fetch_array($result_to_me);
$registration_timestamp_me=$answer_to_me['registration_timestamp'];
$username_me=$answer_to_me['username'];
$database_me="$username_me-$email_id_me--$registration_timestamp_me";

$database_connected_me=mysqli_select_db($connection_me,$database_me);

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

.panel{width:65%;
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
div.subpanel{width:20px;height:20px;border-color:blue;border-style:dotted;background-color:red;}

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
		<pre><b> FAVOURATES</b>											you are logged in as<?="$username_me"?></pre> 
		</div>
		<div id="panelbar">
			<div class="panel">
					<div class="paneltabs">my</div>
					<div class="paneltabs">friends</div>
					<div class="paneltabs">all</div>
					
			</div>
		</div>
		
<?php




		
		
?>		
		<div class="panes">
			<div class="panecontents">
				<div class="subpanel">fsghgsajhkhh
					<div class="subpanelitems"></div>
					<div class="subpanelitems"></div>
					<div class="subpanelitems"></div>
					<div class="subpanelitems"></div>
				
			   </div>
				 <div>
				 </div>
			
			</div>
			
			
			
			<div class="panecontents">
				<div class="subpanel">
					<div class="subpanelitems1"></div>
					<div class="subpanelitems1"></div>
					<div class="subpanelitems1"></div>
				</div>
				<div>
				</div>

			</div>
			
			<div class="panecontents">
				<div class="subpanel">
					<div class="subpanelitems1"></div>
					<div class="subpanelitems1"></div>
					<div class="subpanelitems1"></div>
				</div>
				<div>
				</div>
			</div>
		</div>
		
		<script>


$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("div.panel").tabs("div.panes > div");
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

</div>

</body>
</html>
