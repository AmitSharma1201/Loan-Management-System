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
                        <div class='panel-heading'> Profile Page </div> 
                        <div class='panel-body minheight'>";
//						echo $user_type;

						//	$table_name="client";
						if($user_type=="staff"){
							$table_name="emp1";
							$sql="select * from $table_name where id=$login_id";
	

						$query= mysqli_query($con,$sql);
						$row_data=mysqli_fetch_row($query);
//						print_r($row_data);
						$num_col=mysqli_num_fields($query);
						echo "<table class='table'>";
						for($i=0;$i<$num_col;$i++)
						{
							$temp=mysqli_fetch_field($query);
							$col_name=$temp->name;
							if($i<6)
							echo "<tr><th>$col_name</th><td>$row_data[$i]</td></tr>"; 
							else if($i==6)
	                      	echo "<tr><th>$col_name</th><td><a href='$row_data[$i]'>View resume</a> </td></tr>";
						  else if($i<11)
							echo "<tr><th>$col_name</th><td>$row_data[$i]</td></tr>"; 
                             else if($i==11)
	                           	echo "<tr><th>$col_name</th><td><img  src='$row_data[$i]' width=100 /></td></tr>";
							
						}
						echo "</table>";
					
}

				//		$table_name="client";
					else if($user_type=="Client"){
							$table_name="client";
							$sql1="select * from $table_name where id=$login_id";
	

						$query1= mysqli_query($con,$sql1);
						$row_data=mysqli_fetch_row($query1);
//						print_r($row_data);
						$num_col=mysqli_num_fields($query1);
						echo "<table class='table'>";
						for($i=0;$i<$num_col;$i++)
						{
							$temp1=mysqli_fetch_field($query1);
							$col_name=$temp1->name;
							if($i<14)
							echo "<tr><th>$col_name</th><td>$row_data[$i]</td></tr>";
						  // else if($i<=16)
	                          	//echo "<tr><th>$col_name</th><td><a href='$row_data[$i]'>View</a> </td></tr>";
	                       //else if($i==17)
	                          // 	echo "<tr><th>$col_name</th><td><img  src='$row_data[$i]' width=100 /></td></tr>";
							//else if($i==19)	
          						// echo "<tr><th>$col_name</th><td>$row_data[$i]</td></tr>";

						}
						echo "</table>";
					}
						
						
						
						
						
						
	//					echo "$login_id";
						
						echo "</div>
                    </div>";
		
		echo "</div>";

		echo "<div class='col-md-3'>";
		include("right.php");
		echo "</div>";

		echo "</div>";
		//include_once("footer.php");
		//include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
?>
</html>