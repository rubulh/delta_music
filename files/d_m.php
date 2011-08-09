<?php 
require_once("/var/www/take/files/thekey.php");
require_once("/var/www/take/files/functions/unlogger.php");
$cnnection_d_m=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
session_start();
//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
if((isset($_COOKIE['authkey']))){require_once("/var/www/take/files/functions/restrictor.php" );}

if((isset($_COOKIE['authkey']))&&(isset($_SESSION)))
{
$check_email_id=$_SESSION['email_id'];
$authkey_in_cookie=$_COOKIE['authkey'];
$query_evaluate=mysqli_query($cnnection_d_m,"select * from users_logged_in where email_id='$check_email_id' and authkey='$authkey_in_cookie'");
if(mysqli_fetch_array($query_evaluate))
{
header("Location:http://localhost/take/files/me.php");
exit();
}





}
//unlogger();
?>

<!--;include_path = ".:/usr/share/php"-->
<html>
<head>
<script src="<?=$JQUERY?>/jquery.tools.min.js"></script>  
<script>
//$(document).ready(function(){$("#dialogue").click(function(){$("#accordion").load('theloader.php');});});
</script>
<style>
body{background-image:url(<?=$IMAGE?>/basic.png);}


#complete{float:right;
          border-style:dotted;
          width:83%;
          height:100%;
          overflow:hidden;
	       }
#images{width:97%;
        height:48%;
        border-style:dotted;
        margin:28px 14px 20px 20px;
	     float:center;
	      background-color:#000083;
	      opacity:0.3;
	     }
.intro{width:30%;
       float:left;
       height:97%;
       border-style:dotted;
	    margin-left:14px;
	    margin-right:13px;
	   
	   }
#dialogue{width:97%;
          border-style:dotted;
          margin-top:10px;
          height:20%;
	       float:center;
	       margin-bottom:10px;
	       margin-left: 10px;
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
<div id="images">
<div class="intro">play</div>
<div class="intro">organise</div>
<div class="intro">share</div>

</div>
<div id="dialogue">
delta music is an utility that lets you play and share music organisedly;;it helps you upload and download music and at the same time one can 
you can socialise with your folks 
</div>




<div id="accordion">
   	<img src="<?=$IMAGE?>/formaccordionguest.png" class="tabes" alt="guest" >  
      <div class="insideaccordion" style="width:410px;height:100px;margin-top:5px;background-color:#666699;">
       <p style="font-size:6px;margin-top:-30px">
       <PRE>
      <form>
	<input type="text" name="nick" value="nick here"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="email" value="email here">
	</form> 
       </PRE>       
       </p>      
      </div>
   
    <img src="<?=$IMAGE?>/formaccordionsignin.png" class="tabes" alt="sign-in" >  
      <div class="insideaccordion" style="width:410px;height:100px;margin-top:5px;background-color:#666699;">
       <p style="font-size:7px;margin-top:-45px;">
         <pre>
	<form method="POST" action="r_d_m.php">
	<input type="hidden" name="huh" value="users">
	<input type="text" name="email_id" value="email_id here">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="password" name="password" value="password here">
	<input type="submit" name="submit" value="submit">
	</form> 
      
        </pre>                   
       </p>      
      </div>
      
     <img src="<?=$IMAGE?>/formaccordionsignup.png" class="tabes" alt="sign-up" >  
      <div class="insideaccordion" style="width:410px;height:100px;margin-top:5px;background-color:#666699;">
       <p style="font-size:10px;margin-top:-45px;">
        <pre>
	<form method="POST" action="r_d_m.php">
	<input type="hidden" name="huh" value="register">
	<input type="text" name="username" value="username here">
	<input type="text" name="email_id" value="email_id here">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="password" name="password" value="password here">
	<input type="submit" name="submit" value="submit">
	</form> 
      
        </pre>  
                    
       </p>      
      </div>

</div>
</div>
<!--
<div id="getstarted" style="width:18%;float:left;height:89%;border-style:dotted;font-size:38px;padding-top:12px;color:#9966FF">&nbsp get<br>started</div>
-->


           <script> 
                $(function() {
 
                       $("#accordion").tabs(".insideaccordion", {
	                   tabs: '.tabes', 
	                    effect: 'horizontal'
                        });
                });
           </script>
<script type="text/javascript" >
/*
function check(a)
{
regusername=/^([a-zA-z0-9_]{5,13})$/
regnick=/^([a-zA-z0-9_]{5,13})$/
regemail_id=^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$
//just for taking care that my email regex doesnot create problems
//you can change this to filter particular type of email ids 
//http://www.regxlib.com/UserPatterns.aspx?authorId=72c90958-29ac-48c3-b975-d2bb91006a22
if(a=='guest')
  {
     if((document.guest.nick.value.search(regnick)==-1) && (document.guest.email_id.value.search(regemail_id)==-1)) 
 	    {
 	    return false;	
 	    }
 	  else {return true;}
  }
  
if(a=='user')
   {
    if(  (document.user.pass.value.search(regpassword)==-1)&& (document.user.email_id.value.search(regemail_id)==-1)) 
 	    {
 	    return false;	
 	    }
 	  else return true;

if(a=='register')
   {
    if(  ((document.register.username.value.search(regusername)==-1)&& (document.register.email_id.value.search(regemail_id)==-1))&& ((document.register.password.value.search(regemail_id)==-1) &&(document.register.password.value!=document.register.password_.value)) )
 	    {
     	
 	    return false;	
 	    }
 	  else return true;
    	
   }
}
*/
</script>


</body>
</html>
<!-- what i have to add is the next to input field error showing  -->