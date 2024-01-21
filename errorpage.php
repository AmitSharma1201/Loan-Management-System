<?php
echo "<h2>ERROR page:</h2>";
$err=$_REQUEST['err'];
switch($err)
{
	case 101:echo "server connection error"; break;
	default:echo "error:$err"; break;
	
}
?>