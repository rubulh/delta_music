<?php
echo 'this';

//THIS IS FINE
session_start();
$SESSION['ABC']="THIS";
                                                       
var_dump($SESSION);
session_destroy();

?>
