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
if(isset($_SESSION))
{
$THEEMAILIDINSESSION=$_SESSION['email_id'];
$connection_welcome=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
 $query_THE_LEAD=mysqli_query($connection_welcome,"select profile_string from users_basic where email_id='$THEEMAILIDINSESSION'")or die(mysqli_error($connectiom_welcome));
$fetch_the_lead=mysqli_fetch_array($query_THE_LEAD);
$profile_string_this_is=$fetch_the_lead['profile_string'];
}

trackker();
?>



<html>
<head>
<script src="<?=$JQUERY?>/jquery.tools.min.js"></script>
<style>
body{background-image:url(<?=$IMAGE?>/basic.png);}
#complete{float:right;
          border-style:dotted;
          width:83%;
          height:100%;
          overflow:hidden;
	       }
#allimages{float:center;
           overflow:hidden;
           width:98%;
           height:79%;
           border-style:dotted;
           margin-top:5px;
           margin-bottom:2px;
           margin-left:10px;
           margin-right:10px;
           }
.demos{width:100%;
      overflow:hidden;
      height:40%;
      border-style:dotted; 
	}
.demoimages{width:23%;
            height:85%;
            float:left;
            margin-left:8px;
            margin-right:7px;
            margin-top:7px;
	         border-style:dotted;
	         background-color:#000083;
	         opacity:0.3;
	          color:#333366;
	         text-align:center;
	         }
#welcomenote{width:100%;
             height:18%;
             border-style:dotted;
	         }
#navigation{
	        width:97%;
	        height:15%;
	        border-style:dotted;
           margin:9px 2px 0px 2px;
           background-color:#666666;
           opacity:0.5;   
           padding-left:99px;
           padding-right:65px;
           border-style:ridge;
           border-color:#000083;
           overflow:hidden;
	        }
.links{
	   width:7%;
	   height:50%;
	   
	   background-color:#000083;
	   
	   float:left;
	   margin-left:8px;
	   margin-top:17px;
	   margin-right:8px;
	   border-style:ridge;
	   border-color:gray;
	   color:white;
	   text-align:center;
	   font-variant:small-caps;
	   border-width:5px;
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
<div id="allimages">
<div id="firstrow" class="demos">
<div class="demoimages"><h1>play</h1></div>
<div class="demoimages"><h1>customise</h1></div>
<div class="demoimages"><h1>organise</h1></div>
<div class="demoimages"><h1>download-upload</h1></div>
</div>
<div id="welcomenote">
<h1> now do a lot more with delta music</h1>
</div>
<div id="lastrow" class="demos">
<div class="demoimages"><h1>share</h1></div>
<div class="demoimages"><h1>socialise</h1></div>
<div class="demoimages"><h1>remain updated</h1></div>
<div class="demoimages"><h1>lots new to come</h1></div>
</div>
</div>
<!--
<div id="navigation">
<a href="#"><div class="links">name</div></a>
<a href="#"><div class="links">wall</div></a>
<a href="#"><div class="links">messages</div></a>
<a href="#"><div class="links">music library</div></a>
<a href="#"><div class="links">playlists</div></a>
<a href="#"><div class="links">my playlists</div></a>
<a href="#"><div class="links">favourates</div></a>
<a href="#"><div class="links">account</div></a>
<a href="#"><div class="links">logout</div></a>
</div>
-->
	<div id="accordion">
   	<img src="<?=$IMAGE?>/menavigation.png" class="tabes" alt="me" >  
      <div class="insideaccordion" style="width:410px;height:107px;margin-top:3px;background-color:#666699;">
       <p style="font-size:10px;">
       <pre>
       <a href="me.php" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation" style="margin-left:19px;">me</div></a>     
      <a href="viewprofile.php?profile=<?=$profile_string_this_is?>" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">profile</div></a>
	<a href="membersearch.php" class="anchoraccordionlinksnavigation"><div class="accordionlinksnavigation">membersearch</div></a>           
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
		<a href="http://localhost/take/files/functions/logout.php">logout</a> 
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
<script type="text/javascript" >
</div>

</body>
</html>