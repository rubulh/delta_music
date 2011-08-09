<?php
session_start();
$ans=setcookie('authkey','d214225cb46cefc2eec2f19e1b481d5a',mktime('22'))or die();                                                                    
$_SESSION['clue']='users';
$_SESSION['email_id']='fgagaggaha@wse.com';
  ?>

<form method="POST" action="http://localhost/take/files/downloadhandler.php">
<input type="text" name="SONGNUMBER" size="200" maxlength="200">

</form>

  <?php
  
  
  var_dump($_SESSION);var_dump($_COOKIE);
    ?>