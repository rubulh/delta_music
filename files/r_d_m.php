<?php
if(!isset($_POST['submit']))
{
header("Location:$FILE/d_m.php");
//this takes care that if the user tries to visit this page by typing the url he gets whisked to the start up page
//i hav to do this almost everywhere
}
?>

<?php
require_once("/var/www/take/files/thekey.php");
require_once("/var/www/take/files/functions/randomstring.php");
require_once("/var/www/take/files/functions/profilestring.php");
require_once("/var/www/take/files/functions/email_checker.php");
require_once("/var/www/take/files/functions/register_user.php");
require_once("/var/www/take/files/functions/nick_checker.php");
require_once("/var/www/take/files/functions/login_user.php");
require_once("/var/www/take/files/functions/trackker.php");

// one has to see if it can be done without direct file and folder names
?>
<?php



?>
<?php
session_start();
$authkey_timestamp=time();
$authkey_session_id=session_id();
$salt1=randomstring();
$salt2=randomstring();
$total_authkey=$salt1.$authkey_session_id.$salt2.$authkey_timestamp;
$standardauthkey=md5($total_authkey);
//just confirming that any other value of huh does not get through
//and that the session variables does not get set for any other huh value;;;
if(!(($_POST['huh']=='guest')||($_POST['huh']=='users')||($_POST['huh']=='register')))
{
header("Location:$FILE/error_message.php?down=25");exit();
//whisks to error message.php  where error is shown that something went wrong ;;as the huh variable was set to neither users nor guests
}

$_SESSION['email_id']=$_POST['email_id'];


$authkey_cookie_setter=setcookie('authkey',$standardauthkey,time()+60*60*5);//returns bool
//cookie lasts to 5 hours
if(!$authkey_cookie_setter)
{
				$authkey_cookie_setter=setcookie('authkey',"",time()-60*60*5);
				$_SESSION=array();
				session_destroy();
				header("Location:$FILE/error_message.php?down=13");
				//whisks to error message.php  where error is shown that something went wrong setting the cookie
				exit();
}

if($_POST['huh']=='users')
{
//validate
	{

	if(!(filter_var($_POST['email_id'],FILTER_VALIDATE_EMAIL)))
		 {
			session_destroy();
			$_SESSION=array();
			header("Location:$FILE/d_m.php?attempt=1");
		 }
      //if in correct login whisk to login page --code 1 is for invalid email
	}
//sanitise
	{
	$connection_user=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
	$_POST['email_id']=mysqli_real_escape_string($connection_user,$_POST['email_id']);
	$_POST['password']=mysqli_real_escape_string($connection_user,$_POST['password']);
	$startUp_user_email_id=$_POST['email_id'];
	$startUp_password=$_POST['password'];
	}
	$extract_the_username_user_startup=mysqli_query($connection_user,"select username from users_basic where email_id='$startUp_user_email_id' and password='$startUp_password'")or die(mysqli_error($connection_user));
//redundancy
//check the correctness of login
	/*if(!(login_validator()))
		  { 	
			session_destroy();
			$_SESSION=array();
			header("Location:$FILE/d_m.php?attempt=2");
			exit();
		  }
		*/	//if in correct login whisk to login page--code 2 is for incorrect combo
	
//login_the userit vaidatesemail_id here
	$startup_fetch_username=mysqli_fetch_array($extract_the_username_user_startup);
	if($startup_fetch_username['username'])//redundant
	{
	$_POST['username']=$startup_fetch_username['username'];
	login_user();
	}
	else
	{
				session_destroy();
			      $_SESSION=array();
				header("Location:$FILE/d_m.php?attempt=5");
				//whisks to loginpage 
				//passwords did not match
				exit();
	}
//track
	//trackker();	

//whisk
	{
		
		$_SESSION['clue']='users';//necessary for the trackker script to work and set permissions
		
		
			header("Location:$FILE/welcome.php");
		//if everything goes right whisk user to the welcome page
	
	}
}

if($_POST['huh']=='guest')
{

	//validate
	{

	if(!((filter_var($_POST['email_id'],FILTER_VALIDATE_EMAIL)) && filter_var($_POST['nick'],FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^([a-zA-Z]{1,2})([a-zA-Z0-9_]+)$/")))))

		{
			session_destroy();
			$_SESSION=array();	
			header("Location:$FILE/d_m.php?attempt=5");
			////if invalid email password or nick entered whisk to login page --code 5 is for used invalid nick or useremail
		}
	}
//sanitise
	{
		$connection_guest=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
		$_POST['email_id']=mysqli_real_escape_string($connection_guest,$_POST['email_id']);
		$_POST['nick']=mysqli_real_escape_string($connection_guest,$_POST['nick']);
		//should i bother for html
	}
//check_nick
	 if(!nick_checker())
	{
			session_destroy();
			$_SESSION=array();	
	header("Location:$FILE/d_m.php?attempt=6");
		//if in nick already used whisk to login page --code 6 is for nick currently in use
	}
	
	 else
	{
		//nick setter
		nick_setter();
	}

//track
	//trackker();

//whisk
	{
	//whisk
	
		
		$SESSION['clue']='guests';//necessary for the trackker script to work and set permissions
		
		
			header("Location:$FILE/welcome.php");
		//if everything goes right whisk user to the welcome page
	

	
	}
}

if($_POST['huh']=='register')
{
$connection_register=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
//validate
	{
	if(!((filter_var($_POST['email_id'],FILTER_VALIDATE_EMAIL)) && filter_var($_POST['username'],FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^([a-zA-Z]{1,2})([a-zA-Z0-9_]*)\s?([a-zA-Z0-9_]{4,10})$/")))))
		{
			session_destroy();
			$_SESSION=array();
			header("Location:$FILE/d_m.php?attempt=4");
////if invalid email password or username entered whisk to login page --code 4 is for used email_id
			exit();

		}

	$_POST['email_id']=mysqli_real_escape_string($connection_register,$_POST['email_id'])or die(mysqli_error($connection_register)) ;

	}


//sanitise
	{
	
	$_POST['email_id']=mysqli_real_escape_string($connection_register,$_POST['email_id']);
	$_POST['username']=mysqli_real_escape_string($connection_register,$_POST['username']);
	$_POST['password']=mysqli_real_escape_string($connection_register,$_POST['password']);
	//note no equality oof passwords needed
	}
	
 if(email_checker())
	{
			session_destroy();
			$_SESSION=array();
			header("Location:$FILE/d_m.php?attempt=3");
	            exit();
	}
//if in email_id already used whisk to login page --code 3 is for used email_id
 else
	{
	register_user();
	}

//login
	$_SESSION['clue']='users';
	login_user();
	//var_dump($_COOKIE);exit();
//echo"hsgs";
	
//trakker
	//trackker();
//whisk
	{
		
			$_SESSION['clue']='users';//necessary for the trackker script to work and set permissions
		
		
			header("Location:$FILE/welcome.php");
		//if everything goes right whisk user to the welcome page
	
	}
}
?>