<?php
if(!isset($_POST['submit']))
{
?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
<input type=text name=name value=namehere>
<input type=text name=email value=emailhere>
<input type=submit name=submit value=submit>
</form>


<?php


}
else
{

var_dump($_SERVER);
}
?>