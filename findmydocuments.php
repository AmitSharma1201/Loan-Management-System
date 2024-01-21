<?php 
require_once("connection.php");
?>
<html>
<head>
<style>
background-co
</style>
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
						//echo "
						$table_name="client";
						if($user_type=="staff")
							$table_name="emp1";

	
						
						
						
						
	$sql1="select signature_path,adharcard_path,pancard_path,image_path from client where id=$login_id";
	

				$query= mysqli_query($con,$sql1);
						$row_data=mysqli_fetch_row($query);
					//print_r($row_data);
					$num_col=mysqli_num_fields($query);
						echo "<table class='table'>";
						for($i=0;$i<$num_col;$i++)
						{
							$temp=mysqli_fetch_field($query);
							$col_name=$temp->name;
							echo "<tr><th>$col_name</th><td><a href='$row_data[$i]' class='btn btn=$theme'>view</a></td></tr>";
						}
echo"</table>";						
						
													
																							
																	
						
						echo "</div>
                    </div>";
		
		echo "</div>";

		echo "<div class='col-md-3'>";
		include("right.php");
		echo "</div>";

		echo "</div>";
	//	include_once("footer.php");
	//	include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
?>
</html>