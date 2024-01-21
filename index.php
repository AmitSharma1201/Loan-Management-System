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
		echo "<div class='row'>";
		 //echo "<div class='col-md-3'>";
		//include("left.php");
	//	echo "</div>";
		echo "<div class='col-md-9'>";
		echo " <div class='panel panel-$theme'>
                        <div class='panel-heading'>index </div> 
                        <div class='panel-body minheight'>";
						if(isset($_REQUEST['caseno']))
						{
							$caseno=$_REQUEST['caseno'];
							$id_value=$_REQUEST['id'];
							echo "<a href='index.php'>Back</a>";
						//	echo "$caseno";
								//echo "<BR/>id_value=$id_value";
								find_data1($con,$id_value,$caseno);
						}							


						if(isset($_POST['find']))
						{
							$find=$_POST['find'];
								find_data($con,$find,1);		
							find_data($con,$find,2);	
							find_data($con,$find,3);	
						}
						
					
					
						
							
						
				
	
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
   
   function find_data($con,$find,$caseno)
   {
//	   echo $caseno;
//	   echo "<br/>$find";
			$sql="";	   
	   $title="";
	   $sql="";
	   switch($caseno)
	   {
		   case 1:$sql="select id,group_name from loangroup where group_name like '%$find%'";
				 $title="Loan group";
				 break;
		   case 2:$sql="SELECT id,`name`,`gender`,`contact_number`,`email` FROM `client` where name like  '%$find%'";
				 $title="Client";
				 break;


		   case 3:$sql="SELECT `id`,`employee_Name`,`gender`,`contact_number`,`email` FROM `emp1` WHERE employee_name like '%$find%'";
				 $title="Staff Member ";
				 break;
	 
	   }

//echo $sql;
	$query= mysqli_query($con,$sql);
	$num=mysqli_num_rows($query);

if($num>0)
{
			echo "<h2>$title</h2>";

echo "<table class='table table-hover'>";
while($row_data=mysqli_fetch_array($query))
{
	echo "<tr><td><a href='index.php?caseno=$caseno&id=$row_data[0]'>$row_data[1]</a></td></tr>";
}
echo "</table>";


}

	
	//						
							
	//													

   }
   
   
   
   function find_data1($con,$id,$caseno)
   {
//	   echo $caseno;
//	   echo "<br/>id=$id";
	
		$sql="";	   
	   $title="";
	   $sql="";
	   switch($caseno)
	   {
		   case 1:$sql="select id,group_name,Loan_Amount,Time_Duration,number_of_members,info from loangroup where id=$id";
				 $title="Loan group";
				 break;
		   case 2:$sql="SELECT id,`name`,`gender`,`contact_number`,`email`,`village` FROM `client` where id=$id";
				 $title="Client";
				 break;


		   case 3:$sql="SELECT `id`,`employee_Name`,`gender`,`contact_number`,`email` FROM `emp1` WHERE id=$id";
				 $title="Staff Member ";
				 break;
	 
	   }

//echo $sql;
	$query= mysqli_query($con,$sql);
	$num=mysqli_num_rows($query);

if($num>0)
{
			echo "<h2>$title</h2>";

echo "<table class='table table-hover'>";
while($row_data=mysqli_fetch_array($query))
{
						$query= mysqli_query($con,$sql);
						$row_data=mysqli_fetch_row($query);
//						print_r($row_data);
						$num_col=mysqli_num_fields($query);
						for($i=0;$i<$num_col;$i++)
						{
							$temp=mysqli_fetch_field($query);
							$col_name=$temp->name;
							echo "<tr><th>$col_name</th><td>$row_data[$i]</td></tr>";
						}
					
//	echo "<tr><td>$row_data[1]</td></tr>";
}
echo "</table>";


}

	
	//						
							
	//													

   }
?>
</html>



