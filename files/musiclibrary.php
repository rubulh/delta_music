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
$THEEMAILIDINSESSION=$_SESSION['email_id'];
 $connection_welcome=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
  $query_THE_LEAD=mysqli_query($connection_welcome,"select profile_string from users_basic where email_id='$THEEMAILIDINSESSION'")or die(mysqli_error($connectiom_welcome));
 $fetch_the_lead=mysqli_fetch_array($query_THE_LEAD);
 $profile_string_this_is=$fetch_the_lead['profile_string'];

trackker();
?>
<?php

//code_to extract the registration timestamp of the user
$connection_musiclibrary=mysqli_connect($_SERVER['HTTP_HOST'],$sqlusername,$sqlpassword,$databasename);
//$which_host=$_SERVER['HTTP_HOST'];
//echo "$which_host.$sqlusername.$sqlpassword.$databasename";die();
//here i use the general use database
$email_id_me=$_SESSION['email_id'];//email_id unique
$query_to_me="select registration_timestamp, username,myplaylist_string from users_basic where email_id='$email_id_me'";//echo "thdhd";
$result_to_me=mysqli_query($connection_musiclibrary,$query_to_me);//or die(mysqli_error($connection_musiclibrary));
$answer_to_me=mysqli_fetch_array($result_to_me);
$registration_timestamp_me=$answer_to_me['registration_timestamp'];
$username_me=$answer_to_me['username'];
$database_me=$username_me.'___'.$email_id_me.'___'.$registration_timestamp_me;
$myplaylist_string_ml=$answer_to_me['myplaylist_string'];//general use database



/*
the function shall
1.make the div
2.with song name
3.the person who added
4.likes dislikes
5.rating
6.3butons play download view commets
7.as soon as some body clicks the play button i open the 3mu file in a separate window;
8.download ll prompt for the download destination
9.view comments ll immediately hide thea part of the div and open a new div that shall have the comments order by latest now
10.a comment textbox;where i need to run hrml enetity decode as well as
11.late i shall limit the number of commnets
12.note that for pagination i need to set the comment idvs very carefully
13.

011] [error] [client ::1] PHP Warning:  Division by zero in /var/www/take/files/musiclibrary.php on line 62, referer: http://localhost/take/files/musiclibrary.php







*/

function allsong_complete_desc($complete_song_extracted)//pass the fetched array
{
	{
	//open up the entire array here
	$the_m3upath_of_song=$complete_song_extracted['play_path'];
	$title_of_song=$complete_song_extracted['song_title'];
	$total_likes=$complete_song_extracted['likes_count'];
	$total_dislikes=$complete_song_extracted['dislikes_count'];
	$total_rating_song=$complete_song_extracted['total_rating'];
	$number_of_raters=$complete_song_extracted['count_raters'];
	if($number_of_raters!=0)
	$average_rating_song=ceil($total_rating_song/$number_of_raters);
	else $average_rating_song=0;
	$song_added_by=$complete_song_extracted['added_by'];
	$count_of_downloads=$complete_song_extracted['times_download'];
	$artist_of_song=$complete_song_extracted['artist'];
	$album_of_song=$complete_song_extracted['album'];
	$language_of_song=$complete_song_extracted['language'];
	$genre_of_song=$complete_song_extracted['genre'];
	$all_comments_together=$complete_song_extracted['all_comments'];
	$song_id_allsongs=$complete_song_extracted['kick_song_index'];
	$anchorcompletedforthe_song=$complete_song_extracted['the_anchor'];
    $added_by_profile_string_forthe_song=$complete_song_extracted['added_by_profile_string'];
	}

//construct the initial div for each user

$thebriefsongdetails=<<<BRIEFSONGDETAILS
	<div  class='rollupdiv'>
	<p>$title_of_song&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RATING:$average_rating_song&nbsp;LIKES:$total_likes&nbsp;&nbsp;DISLIKES:$total_dislikes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ADDEDBY:$song_added_by</p>
	<p>ARTIST:$artist_of_song&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ALBUM:$album_of_song&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LANGUAGE:$language_of_song&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GENRE:$genre_of_song</p>
	<p><a href="$the_m3upath_of_song" target="_blank"><button id="play">play</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='downloadhandler.php?anchor=$anchorcompletedforthe_song' target='_blank'><button class="button_download" id="$anchorcompletedforthe_song">download</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="like">like</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="rate">rate</button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="viewcomments" id="$anchorcompletedforthe_song">view-comments</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
	
	
	<div class='amihidden' id="$anchorcompletedforthe_song"><button class="hidecomments" id="$anchorcompletedforthe_song">hidecomments</button>
	<p>$title_of_song&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RATING:$average_rating_song&nbsp;LIKES:$total_likes&nbsp;&nbsp;DISLIKES:$total_dislikes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ADDEDBY:$song_added_by</p>
	<p>ARTIST:$artist_of_song&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ALBUM:$album_of_song&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LANGUAGE:$language_of_song&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GENRE:$genre_of_song</p>
	
	<p>
	
	COMMENTS<BR>
BRIEFSONGDETAILS;
echo $thebriefsongdetails;
$array_of_comments=explode("(`%^&#`)",$all_comments_together);
	foreach($array_of_comments as $maincomment)
		{
			$maincomment_all=explode("(`%^@*`)",$maincomment);
			$maincomment_commentator=$maincomment_all[0];
			$maincomment_date_time=$maincomment_all[1];
			$maincomment_comment=$maincomment_all[2];//the comment
			echo "<b>$maincomment_date_time</b>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;<b>$maincomment_commentator</b><br>
			<i>$maincomment_comment</i>"; 
		}

echo "</p>";
//the comment form
echo "
 <textarea cols=30 rows=4 name='thistext' id='$anchorcompletedforthe_song'>
</textarea>
 <button class='button_comment'  id='$anchorcompletedforthe_song'>comment</button>  
 " ;
//submit without reloading
 //later i can keep this chart in a different doc  and load this chart i n  this div
echo "</div>";echo "</div>";
//here is the jquery
 ?>
<script>
   $(document).ready(function(){$(".button_download").click(function(){location.reload();});
					$(".button_comment").click(function(){
 					var myid=$(this).attr('id');
					var commentpassed=$('textarea#'+myid).val();
    					var downloadsentstring='anchor='+myid+'&comment='+commentpassed;
 					
    					$.ajax({
    					type:'POST',url:'comment_setter.php',
    					data:downloadsentstring,
    					success:function(){$("#commented").show();}});
    					
    					return false;
    					});
      					
   					$("button.viewcomments").click(function(){var thisdiv=$(this).attr('id');$("div#"+thisdiv).show();});
   					$( "button.hidecomments").click(function(){$("div.amihidden").hide();location.reload();});
   				//	$( "#button_rate").click(function(){$("div.paginate.ver").hide();$("#fullratediv").show();});
   					});

</script>

 <?php 
}

//databse me is the user specific database
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
			height:8%;
			border-style:groove;
			background-color:#666699;
			
			margin-bottom:6px;
			opacity:0.7;
			letter-spacing:2px;} 
.liblinks{text-decoration:none;}
.partsection{width:95%;
				background-color:#9999CC;
				
				height:5%;
				margin-bottom:1px;
				border-style:groove;
				border-color:#9966CC;
				color:silver;
				font-style:bold;
				font-weight:900;
				text-align:left;
				padding-left:30px;
				text-decoration:none;
				padding-top:6px;
				letter-spacing:3px;
				}
.comment_song_wise_ml{width:900px;
			    overflow:scroll;
				display:none;
				}
.eachsongdesc{
		  width:95%;
		  height:13%;
		  background-color:#666699;
		  opacity:0.7;

		margin-bottom:3px;
		border-style:groove;
		border-color:#000083;
		color:silver;
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

.paginate{
		position:absolute;
		overflow:hidden;
		width:100%;
		height:80%;
		border-top:groove;
	   }
.pagiitemss{position:absolute;
		height:9999999em;
		margin:0px;
		
		}
.rollupdiv{
		padding:4px;
		margin-top:2px;
		height:180px;
		font-size:0.6em;
	     }
.amihidden{display:none;width:900px;height:300px;position:absolute;left:20px;top:30px;overflow:scroll;background-color:yellow;color:black;}
#downloadstartingstarting{display:none;width:80%;height:80%;background-color:red;position:absolute;left:40px;top:40px;}
</style>
<script>
/*$(document).ready(function(){$('button.viewcomments').click(function(){var thisid=$(this).attr('id');
	$('div#'+thisid+'.').css('display','block');});
$('.hidecomments').click(function(){var thisid=$(this).attr('id');
	$('div#'+thisid).hide();location.reload();});*/
});

</script>
</head>
<body>
<div id='downloadstrating'>
click ok

</div>
<?php
//sanitise the entire get string 
//for mysqli_real_escape string
//html characters
//also take care that one might try to pass multiple values or arrays in the get string
//anything except the keywords
//change the get string to null

//keywords
//allsongs
//album
//artist
//languages
//genres
//lastplayed
//mostplayed
//uploaded
//downloaded
//myplaylists
?>
<div id="complete">
    <div id="container">
	 <?php
// ($_COOKIE);
	 if($_GET['librarypath']=='myplaylists')
			{
		//the database used here is the user specific database but the name of the table name has to be extracted from the users basic
		//the string
		//which i shall explode to get the different table names in the user specific database
			//echo "me";
//and as the user visits this page i shall keep the playlists names in a  cookie;that helps in case user tries to make a new playlist and name clashes with that of the old one;
//

		$sub_chart_name_header="MY PLAYLISTS";
		//get the list
		echo "<div id='headbar'>
		<pre><b>LIBRARY >>>$sub_chart_name_header</b>									you are logged in as $username_me</pre> 
		</div>";
echo "<div style='width:100%;height:90%;background-color:#9999CC;border-style:groove;border-color:#9966CC;color:silver;font-style:bold;font-weight:900;text-align:left;padding-left:0px;text-decoration:none;padding-top:20px;letter-spacing:3px;'>";
		if($myplaylist_string_ml=="")
		{
$noplaylistscreated=<<<noplaylistshavebeencreated
<h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;you have not created any playlist
</h1>


noplaylistshavebeencreated;
echo "$noplaylistscreated";
		}
	     else
		{
		$myplaylistname_array_ml=explode("(`%^&#`)",$myplaylist_string_ml);
			foreach($myplaylistname_array_ml as $nameofmyplaylists_ml)
			{
			echo "<div class='verticalscrollable' style='width:100%;height:8%;background-color:#9999CC;border-style:groove;border-color:#9966CC;color:grey;font-style:bold;font-weight:700;text-align:left;padding-left:30px;text-decoration:none;letter-spacing:1px;'>";
			echo "$nameofmyplaylists_ml";
		      echo "</div>";
			}



		}
$createnewplaylist=<<<createnewplaylist
<h2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;create a new playlist here

<button title="create_new_playlist" type="button" name="create_new_playlist"  value="create_new_playlist" style="color:black;"> CREATE NEW PLAYLIST</button>

</h2>
</div>
<div id="">

</div>



createnewplaylist;

echo "$createnewplaylist";
			}
			
			
			
//the database used here is the general use database
	else if(isset($_GET['librarypath']))
	   {
		    {
			if($_GET['librarypath']=='allsongs')
			{
		$sub_chart_name_header="ALL SONGS";
		$query_allsongs_ml="select * from allsongs order by song_title asc";
			}
			else if($_GET['librarypath']=='album')
			{
		$sub_chart_name_header="ALBUMS";
		$query_allsongs_ml="select * from allsongs order by album asc";
			}
			else if($_GET['librarypath']=='artist')
			{
		$sub_chart_name_header="ARTISTS";
		$query_allsongs_ml="select * from allsongs order by artist asc";
			}
			else if($_GET['librarypath']=='languages')
			{
		$sub_chart_name_header="LANGUAGES";
		$query_allsongs_ml="select * from allsongs order by language asc";
			}
			else if($_GET['librarypath']=='genres')
			{
		$sub_chart_name_header="GENRES";
		$query_allsongs_ml="select * from allsongs order by album asc";
			}
			
//here i got to change the entire database name to user specific database
//common table

			else if($_GET['librarypath']=='lastplayed')
			{$database_connected_me=mysqli_select_db($connection_musiclibrary,$database_me);//changing to user specific databse
		$sub_chart_name_header="LAST PLAYED";
		$query_get_allsongs_index_from_mysongs="select 
all_songs_kick_song_index from mysongs order by timestamp_played desc";
		$result_get_allsongs_index_from_mysongs=mysqli_query($connection_musiclibrary,$query_get_allsongs_index_from_mysongs);
		$or_the_string_ml="kick_song_index='abcde'";//dummy to get started
		while(false!=($answer_get_allsongs_index_from_mysongs=mysqli_fetch_array($result_get_allsongs_index_from_mysongs)))
			{
			$index_for_nth_song=$answer_get_allsongs_index_from_mysongs['all_songs_kick_song_index'];
			$or_the_string_ml=$or_the_string_ml." or kick_song_index=".$index_for_nth_song;
			}
			//var_dump($or_the_string_ml);exit();
		//change the databse to the general database
		$database_general_database=mysqli_select_db($connection_musiclibrary,$databasename);
		$query_allsongs_ml="select * from allsongs where $or_the_string_ml";
		
			}
			else if($_GET['librarypath']=='mostplayed')
			{$database_connected_me=mysqli_select_db($connection_musiclibrary,$database_me);//changing to user specific databse
		$sub_chart_name_header="MOST PLAYED";
		$query_get_allsongs_index_from_mysongs="select all_songs_kick_song_index from mysongs order by times_played desc";
		$result_get_allsongs_index_from_mysongs=mysqli_query($connection_musiclibrary,$query_get_allsongs_index_from_mysongs);
		$or_the_string_ml="kick_song_index='abcde'";//dummy to get started
		while(false!=($answer_get_allsongs_index_from_mysongs=mysqli_fetch_array($result_query_all_songs_ml)))
			{
			$index_for_nth_song=$answer_get_allsongs_index_from_mysongs['all_songs_kick_song_index'];
			$or_the_string_ml=$or_the_string_ml." or kick_song_index=".$index_for_nth_song;
			}
		//change the databse to the general database
		$database_general_database=mysqli_select_db($connection_musiclibrary,$databasename);
		$query_allsongs_ml="select * from allsongs where $or_the_string_ml";
		
			}
			else if($_GET['librarypath']=='uploaded')
			{$database_connected_me=mysqli_select_db($connection_musiclibrary,$database_me)or die(mysqli_error($connection_musiclibrary));;//changing to user specific databse
		$sub_chart_name_header="UPLOADED";
		$query_get_allsongs_index_from_mysongs="select all_songs_kick_song_index from mysongs where uploaded=1 order by uploaded_timestamp";
		$result_get_allsongs_index_from_mysongs=mysqli_query($connection_musiclibrary,$query_get_allsongs_index_from_mysongs)or die(mysqli_error($connection_musiclibrary));
		$or_the_string_ml="kick_song_index='abcde'";//dummy to get started
		while(false!=($answer_get_allsongs_index_from_mysongs=mysqli_fetch_array($result_get_allsongs_index_from_mysongs)))
			{
			$index_for_nth_song=$answer_get_allsongs_index_from_mysongs['all_songs_kick_song_index'];
			$or_the_string_ml=$or_the_string_ml." or kick_song_index=".$index_for_nth_song; //var_dump($or_the_string_ml);
			}
		//change the databse to the general database
		$database_general_database=mysqli_select_db($connection_musiclibrary,$databasename);
		$query_allsongs_ml="select * from allsongs where $or_the_string_ml";
		}
			else if($_GET['librarypath']=='downloaded')
			{$database_connected_me=mysqli_select_db($connection_musiclibrary,$database_me);//changing to user specific databse
		$sub_chart_name_header="DOWNLOADED";
		$query_get_allsongs_index_from_mysongs="select all_songs_kick_song_index from mysongs where downloaded=1";
		$result_get_allsongs_index_from_mysongs=mysqli_query($connection_musiclibrary,$query_get_allsongs_index_from_mysongs);
		$or_the_string_ml="kick_song_index='abcde'";//dummy to get started
		while(false!=($answer_get_allsongs_index_from_mysongs=mysqli_fetch_array($result_query_all_songs_ml)))
			{
			$index_for_nth_song=$answer_get_allsongs_index_from_mysongs['all_songs_kick_song_index'];
			$or_the_string_ml=$or_the_string_ml." or kick_song_index =".$index_for_nth_song;
			}
		//change the databse to the general database
		$database_general_database=mysqli_select_db($connection_musiclibrary,$databasename);
		$query_allsongs_ml="select * from allsongs where $or_the_string_ml";
		}

		   }
//here i run the function that produces the entire songs
//paginated
		echo "<div id='headbar'>
		<pre><b>LIBRARY '<?=>>>$sub_chart_name_header?>'</b>									you are logged in as  '$username_me'</pre> 
		</div>";
		echo "<div>";
		$rollupdiv_counter=0;
		$result_query_all_songs_ml=mysqli_query($connection_musiclibrary,$query_allsongs_ml)or die(mysqli_error($connection_musiclibrary));
		echo "<div class='paginate ver'>";
			echo "<div class='pagiitemss'>";
			while(false!=($fetched_array=mysqli_fetch_array($result_query_all_songs_ml)))
				{	if($rollupdiv_counter%2==0){echo  "<div>";}//five on a scroll
					
					allsong_complete_desc($fetched_array);//rollup divs inside this
					if($rollupdiv_counter%2==0){echo  "</div>";}
					//if($rollupdiv_counter==0){$rollupdiv_counter=1;} confusion;;checkback
					$rollupdiv_counter+=1;
				}
				echo"<div>";//pagiitems
				if($rollupdiv_counter==0 ){echo "<h2>no songs in the playlist<br></h2>";}
$upload_another_song=<<<UPLOADANOTHERSONG
<div class='rollupdiv'>
<h2>upload a song</h2>
<form method="POST" action="uploadhandler.php" enctype='multipart/form-data'>
<input type='file' name='uploadedsong'>
&nbsp;&nbsp;&nbsp;
<input type='text' name='song_title' value='title'>
<input type='text' name='artist' value='artist'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='text' name='album' value='album'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='text' name='genre' value='genre'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='text' name='language' value='language'>


<br>
<input type='submit' name='submit' value='submit'>
</form>
</div>
UPLOADANOTHERSONG;
echo $upload_another_song;//that for form div calss rollup div


				echo"</div>";
			echo "</div>";
		echo "</div>";
		echo "</div>";





	  ?>
	 	
	  <?php
		}
	  else if (!isset($_GET['librarypath'])){
	      ?>
		<div id="headbar">
		<pre><b>LIBRARY</b>											you are logged in as<?="$username_me"?></pre> 
		</div>
		<div>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=allsongs" class="liblinks"><div class="partsection">ALL-SONGS</div></a>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=album" class="liblinks"><div class="partsection">ALBUMS</div></a>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=artist" class="liblinks"><div class="partsection">ARTISTS</div></a>
		<a href="l<?=$FILE?>/musiclibrary.php?librarypath=languages" class="liblinks"><div class="partsection">LANGUAGES</div></a>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=genres" class="liblinks"><div class="partsection">GENRES</div></a>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=lastplayed" class="liblinks"><div class="partsection">LASTPLAYED</div></a>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=mostplayed" class="liblinks"><div class="partsection">MOSTPLAYED</div></a>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=uploaded" class="liblinks"><div class="partsection">UPLOADED</div></a>
		<a href="d<?=$FILE?>/musiclibrary.php?librarypath=downloaded" class="liblinks"><div class="partsection">DOWNLOADED</div></a>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=myplaylists" class="liblinks"><div class="partsection">MY PLAYLISTS</div></a>
		<a href="<?=$FILE?>/favourates.php" class="liblinks"><div class="partsection">FAVOURATES</div></a>
		<a href="<?=$FILE?>/musiclibrary.php?librarypath=queue" class="liblinks"><div class="partsection">QUEUE</div></a>
		</div>
	  <?php
//allsongs
//album
//artist
//languages
//genres
//lastplayed
//mostplayed
//downloaded
//myplaylists
		}
	  ?>
	</div>
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
		<a href="localhost/take.files/functions/logout.php">logout</a> 
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

			$(function() {
				$(".paginate").scrollable({ vertical: true, mousewheel: true });	
					});


           </script>

</div>

</div>

</body>
</html>
