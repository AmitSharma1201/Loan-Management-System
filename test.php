<?php 
require_once("connection.php");
?>
<html>
<head>
<?php
include_once("link.php");
?>
</head>
<?php
echo " 
    <body>
        <div class='container'>";
		include_once("head.php");
		include_once("mainmenu.php");
		echo "<div class='row'>
		     <div class='col-md-3'>";
		include("left.php");
		echo "</div>";
		echo "<div class='col-md-6'>";
		echo " <div class='panel panel-$theme'>
                        <div class='panel-heading'> $theme </div> 
                        <div class='panel-body minheight'>";
						echo "hello";
						
						echo "</div>
                    </div>";
		
		echo "</div>";

		echo "<div class='col-md-3'>";
		include("right.php");
		echo "</div>";

		echo "</div>";
		include_once("footer.php");
		include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
?>
</html>