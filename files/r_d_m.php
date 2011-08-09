<?php
//THE R_D_M.PHP  script

if(!isset($_POST['submit']))
{
header("Location:$FILE/d_m.php");
//if the user tries to visit by typing the url
}
?>

<?php
require_once("/var/www/d_m_after/files/thekey.php");
require_once("/var/www/d_m_after/files/functions/randomstring.php");
require_once("/var/www/d_m_after/files/functions/profilestring.php");
require_once("/var/www/d_m_after/files/functions/email_checker.php");
require_once("/var/www/d_m_after/files/functions/register_user.php");
require_once("/var/www/take/d_m_after/functions/login_user.php");
require_once("/var/www/take/d_m_after/functions/trackker.php");

// one has to see if it can be done without direct file and folder names
?>



<?php


session_start();





$connection_common_rdm=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$common_database);
//common connection
$authkey_timestamp=time();
$authkey_session_id=session_id();
$salt1=randomstring();
$salt2=randomstring();
$total_authkey=$salt1.$authkey_session_id.$salt2.$authkey_timestamp;
$standardauthkey=md5($total_authkey);
//just confirming that any other value of huh does not get through
//and that the session variables does not get set for any other huh value;;;



if(!(($_POST['huh']=='users')||($_POST['huh']=='register')))
	{
	header("Location:$FILE/error_message.php?down=25");
	$close_connection=mysqli_close($connection_common_dm);
	exit();
	//whisks to error message.php  where error is shown that something went wrong ;;as the huh variable was set to neither users nor guests nor register
	}



//session variable hash set  by login user


$authkey_cookie_setter=setcookie('authkey',$standardauthkey,time()+60*60*5);//returns bool
// authkey cookie lasts 5 hours
//authkey set before the login validated
//should i change it??
if(!$authkey_cookie_setter)
{
				$authkey_cookie_setter=setcookie('authkey',"",time()-60*60*5);
				$_SESSION=array();
				session_destroy();
				header("Location:$FILE/error_message.php?down=13");
				//whisks to error message.php  where error is shown that something went wrong setting the authkeycookie
				$close_connection=mysqli_close($connection_common_dm);
				exit();
				//WRITE INTO THE ERROR LOG
}





if($_POST['huh']=='users')//for a login
{
	//validate
	{

		if(!(filter_var($_POST['email_id'],FILTER_VALIDATE_EMAIL)))
			 {
				session_destroy();
				$_SESSION=array();
				header("Location:$FILE/d_m.php?attempt=1");
				//attempt 1 is for invalid email id entered
			 }
      
	}
	
	
	
	//sanitise
	{
	
			
		$_POST['email_id']=mysqli_real_escape_string($connection_common_rdm,$_POST['email_id']);
		$_POST['password']=mysqli_real_escape_string($connection_common_rdm,$_POST['password']);
		$startUp_user_email_id=$_POST['email_id'];
		$startUp_password=$_POST['password'];
	}
	//not yet validated
	


	//LOGIN USER   this validates the user with an email and a password
	//writes into the database (what)
	//it returns true for a sucess
	
	if(!(login_user()))
	{
				session_destroy();
				$_SESSION=array();
				header("Location:$FILE/d_m.php?attempt=5");
				//whisks to loginpage 
				//passwords did not match
				exit();
	}
	//if control comes this far for sure the thing login is validated-for a login
	//and for registration ---the registration has been successfull
	else
	{
	header("Location:$FILE/welcome.php");
	exit();
	}

}


if($_POST['huh']=='register')//registration
{


	//server-side validation
	{
	if(!((filter_var($_POST['email_id'],FILTER_VALIDATE_EMAIL)) && filter_var($_POST['username'],FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^([a-zA-Z]{1,2})([a-zA-Z0-9_]*)\s?([a-zA-Z0-9_]{4,10})$/")))))
		{
			session_destroy();
			$_SESSION=array();
			header("Location:$FILE/d_m.php?attempt=4");
////if invalid email password or username entered whisk to login page --code 4 is for used email_id
			exit();

		}


	}


//sanitise
	{
	
	$_POST['email_id']=mysqli_real_escape_string($connection_common_dm,$_POST['email_id']);
	$_POST['username']=mysqli_real_escape_string($connection_common_dm,$_POST['username']);
	$_POST['password']=mysqli_real_escape_string($connection_common_dm,$_POST['password']);
	//note no equality of passwords needed
	}
	
 if(email_checker())
	{
			session_destroy();
			$_SESSION=array();
			header("Location:$FILE/d_m.php?attempt=3");
			//code three for the email id alredy existing in the database
	            	exit();
	}

 else
	{
	register_user();
	}




//login	
	if(!(login_user()))
	{
				session_destroy();
				$_SESSION=array();
				header("Location:$FILE/d_m.php?attempt=5");
				//whisks to loginpage 
				//passwords did not match
				exit();
	}
	//if control comes this far for sure the thing login is validated-for a login
	//and for registration ---the registration has been successfull
	else
	{
	header("Location:$FILE/welcome.php");
	exit();
	}


}
?>

