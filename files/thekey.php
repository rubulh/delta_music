<?php

//edit this file before submission so that all the variables are by default set to DEFAULTS;;

$REQUEST='http://'.$_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['PHP_SELF']));//CHANGE THIS PHP_SELF IS NOT SEURE
$FILE=$REQUEST.'/files';
$IMAGE=$REQUEST.'/images';
$JQUERY=$REQUEST.'/jquery';
$PATH_TO_RECORDS='/var/www/take';
$SONGDESTINATION='/var/www/take/songdestination/';//neccessary to add this '/''
$THEM3UFOLDER='/var/www/take/all_m3u';////WRITE IT
$THEALLSONGANCHOR=$FILE.'/musiclibrary.php?librarypath=allsongs#';
$THEPATH_TO_EACH_USER=$FILE.'/viewprofile.php';
//one might need to change it
//EDIT THIS PART BEFORE SUBMISSION
//note that the current script name in register user trackker and the login scripts also uses this 
$sqlusername="root";
$sqlpassword="maa";
$databasename="application";
$seconddatabasename="application1";
//var_dump($REQUEST);
?>


