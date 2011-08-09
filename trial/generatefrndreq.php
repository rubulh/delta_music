<?php
session_start();
$_SESSION['email_id']="tiasha@tiasha.com";
$_SESSION['clue']="users";

?>

<html>


<form method="POST" action="http://localhost/take/files/comment_setter.php">
<input type="text" name="comment">
<input type="text" name="anchor" value="487633b9f688bc1ae444c4f69391b3d6">
<input type="submit" name="submit" value="submit">
</form>
</html>