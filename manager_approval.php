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
		echo "<div class='col-md-9'>";
		echo " <div class='panel panel-$theme'>
                        <div class='panel-heading'> $theme </div> 
                       </div>
                   	";
if(isset($_REQUEST['gid']))
{
	$gid=$_REQUEST['gid'];
		$memberid=$_REQUEST['member_id'];
		echo "<a href='manager_approval.php?id=$gid'>Back</a><br/>";
		
		
		

		
			$sql="select id,`name`,`marital`,`gender`,`email`,`village`,`contact_number`,`signature_path`,`adharcard_path`,`pancard_path`,`image_path`  from client where id=$memberid";
//echo $sql;
						$query=mysqli_query($con,$sql);
						$col_num=mysqli_num_fields($query);
						
//echo $col_num;
echo "Member info: <table class='table'>";

while($groupmemberinfo=mysqli_fetch_row($query))
{
//	print_r($groupmemberinfo);
//	echo "<hr/>";
echo "<tr>";
for($c=0;$c<$col_num;$c++)
{
	$temp=mysqli_fetch_field($query);
	$col_name=$temp->name;
	if($c<7)
	{
	echo "<tr><th>$col_name</th><td>$groupmemberinfo[$c]</td></tr>";
	}
	else if($c<10)
		echo "<tr><th>$col_name</th><td><a href='$groupmemberinfo[$c]'>View</a> </td></tr>";
	else 
		echo "<tr><th>$col_name</th><td><img  src='$groupmemberinfo[$c]' width=100 /></td></tr>";
}
}
echo "</table>";









$sql1="select status from loangroup where id=$gid";
$query1=mysqli_query($con,$sql1);
$loangroupinfo=mysqli_fetch_row($query1);
if($loangroupinfo[0]==1)
{
	
echo "<form action='data.php' method='post'>";
echo "<input type='hidden' name='gid' value='$gid'/>";
echo "<input type='hidden' name='member_id' value='$memberid'/>";
echo "<div class='row'>";
						echo"<div class='col-md-5'><textarea  rows=5 cols=40 name='reason'>REASON</textarea></div>";
							echo"<div class='col-md-3'><input type='submit' name='approve_case1' value='Approved' class='btn btn-$theme'/> </div>";
						echo"<div class='col-md-3'><input type='submit' name='reject_case1' value='Rejected' class='btn btn-$theme' /> </div>";
						

echo "</form>";
echo"</div>";
}
else
echo $loangroupinfo[0];





$sql="SELECT * FROM member_action_detail WHERE member_id=$memberid";
//					echo $sql;
			$query= mysqli_query($con,$sql);
			$num= mysqli_num_rows($query);
			$num_of_col= mysqli_num_fields($query);
			
			
			echo "<table class='table table-hover'>";
			echo "<tr class='bg-$theme'>";
			echo "<th>Sno</th>";
			for($c=0;$c<$num_of_col;$c++)
			{
				$temp=mysqli_fetch_field($query);
				$col_name=$temp->name;
				$col_name= str_replace("_"," ",$col_name);
			echo "<th>$col_name</th>";
			}
			echo "</tr>";
			$s=1;
			while($row= mysqli_fetch_array($query))
			{	
			echo "<tr>";
			echo "<td>$s</td>";
			for($c=0;$c<$num_of_col;$c++)
			echo "<td>$row[$c]</td>";
			echo"</tr>";
						$s++;
			}
			echo"</table>";
							
						

	echo "</div>";

		
}										
else if(isset($_REQUEST['id']))
{	
						
						
						
						
						
							$id=$_REQUEST['id'];
							$act=1;
							if(isset($_REQUEST['act']))
							$act=$_REQUEST['act'];
							echo "<a href='manager_approval.php'>Back</a><br/>";
							
							
							
														echo "  <ul class='nav nav-tabs'>";
		echo"<li class='active'><a href='manager_approval.php?id=$id&act=1'>group info</a></li>";
  echo"  <li><a href='manager_approval.php?id=$id&act=2'>Member info</a></li>";
 echo"<li><a href='manager_approval.php?id=$id&act=3'>documents</a> </li>";
 
echo"  <li><a href='manager_approval.php?id=$id&act=4'>upload cheque</a></li>";
echo"  <li><a href='manager_approval.php?id=$id&act=5'>Request Status</a></li>";

 echo "  </ul>";
 	
						
	
	$sql="update loangroup set read_status=0 where id=$id";
	mysqli_query($con,$sql);
						
						$sql="select id,admin_id,group_name,Loan_Amount,Time_Duration,number_of_members , status,loan_cheque,cheque_date from loangroup where id=$id";
						$query=mysqli_query($con,$sql);
						$col_num=mysqli_num_fields($query);
					$groupinfo=mysqli_fetch_row($query);


if($act==1)
{
echo "New Group Info: <table class='table'>";
			echo "$col_num";
			
			echo "<tr>";
			for($c=0;$c<$col_num-1;$c++)
			{
			$temp=mysqli_fetch_field($query);
				$col_name=$temp->name;
				$col_name= str_replace("_"," ",$col_name);
			echo "<th>$col_name</th>";
			}
			echo "</tr>";
			
			for($c=0;$c<$col_num-2;$c++)
			{
	//			$temp=mysqli_fetch_field($query);
				//$col_name=$temp->name;
				//$col_name= str_replace("_"," ",$col_name);
			echo "<td>$groupinfo[$c]</td>";
			

			}
						echo"<td><a href='$groupinfo[7]' class='btn btn-$theme'>view cheque</a></td>"; 

			echo "</tr>";
			$s=1;
			
echo "</table>";					
}	

	
		$sql="select id,`name`,`marital`,`gender` from client where id in(select member_id from groupmember where group_id=$id)";
	//	$sql="select id,`name`,`Higher_Qualification`,`marital`,`gender`,`email`,`contact_number`,`signature_path`,`addhar_path`,`PAN_path`,`image_path`  from client where id in(select member_id from groupmember where group_id=$id)";
//echo $sql;
						$query=mysqli_query($con,$sql);
						$col_num=mysqli_num_fields($query);
$count=mysqli_num_rows($query);

if($act==2)
{
echo "Group Member: <table class='table'>";

$approved_member_counter=0;
while($groupmemberinfo=mysqli_fetch_row($query))
{

$sql1="select status,other FROM groupmember WHERE member_id=$groupmemberinfo[0] and group_id=$id";
$query1=mysqli_query($con,$sql1);
$temp=mysqli_fetch_row($query1);
$status=$temp[0];
echo "<tr>";
for($c=1;$c<$col_num;$c++) 
echo "<td>$groupmemberinfo[$c]</td>";
if($status==2)
{$status="member approved";

$approved_member_counter++;
}
else if($status==-2)
$status="member rejected";
else
$status="waiting";


echo"<td>$status</td>";
echo"<td>$temp[1]</td>";


echo "<td><a href='manager_approval.php?gid=$id&member_id=$groupmemberinfo[0]'>more info<a/></td>";
echo "</tr>";
}

echo "</table>";	
}




  echo "<hr/>";
  

  
 if($act==4)
 { 
	  	echo"<form id='cheque_upload' class='form-horizontal' enctype='multipart/form-data' action='data.php' method='post' role='form' >";
					echo "<input type='hidden' name='id' value='$id'/>";




$loan_status=$groupinfo[6];
if($loan_status==2)
{
echo"<div class='row'>";
			echo "<div class='col-md-2'>upload loan cheque</div>
			<div class='col-md-6'>
			<input type='file' name='loan_cheque' class='form-control' />
			<br>
			        <input type='submit' name='upload_cheque' class='btn btn-$theme' />

</a></div>";
}
else if($loan_status==3)
{
	$loan_cheque_path=$groupinfo[7];
	echo "<a href='$loan_cheque_path' class='btn btn-$theme'>View</a>";
		echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp $groupinfo[8]";
}
		echo"	  <div class='col-md-8'>
      </div>";
	  echo"   </form>";



echo "<hr/>";



 }


		$sql2="select path1,path2,path3,path4,path5 from loangroup where id=$id";
//		echo $sql2;
		
		$query2=mysqli_query($con,$sql2);

		$row_data2=mysqli_fetch_row($query2);
//	print_r($row_data2);	
	echo "<hr/>";
	if($act==3)
	{
	
echo "<table class='table table-hover'>";
for($i=0;$i<5;$i++)
echo "<tr><th>Doc</th><td><a href='$row_data2[$i]'>View  </a></td></tr>";	


echo "</table>";

if($groupinfo[6]==2)
{

echo"<hr\>
<form  method='post'>
<input type='hidden' name='group_id' value='$id'/>
number of members=$count<br>

";

echo "<div class='row'>";
		echo"<div class='col-md-5'><textarea  rows=5 cols=40 name='comment'>REASON</textarea></div><br>";
		echo"<div class='col-md-3'><input type='submit' name='case1_approval' formaction='data.php?case3=3' value='approved' class='btn btn-$theme'/> </div>";
		echo"<div class='col-md-3'><input type='submit' name='case1_reject' formaction='data.php?case4=-3' value='reject' class='btn btn-$theme'/> </div>";
//		echo"<div class='col-md-1'><input type='submit' name='approve_update' 'formaction='data.php?case5=4' value='approve update' class='btn btn-$theme'/></div>";
				
echo"</div>";
						
echo"</form>";





}
	}

if($act==5)
{
echo "<u><h2 class='text-$theme'> REQUEST STATUS<h2></u>";

						$sql="SELECT * from request_for_undo where group_id=$id";
			//	echo $sql;
				$query=mysqli_query($con,$sql);
						$col_num=mysqli_num_fields($query);
		
			
			echo "<table class='table table-hover'>";
			echo "<tr class='bg-$theme'>";
			echo "<th>Sno</th>";

			for($c=0;$c<$col_num;$c++)
			{
				$temp=mysqli_fetch_field($query);
				$col_name=$temp->name;
				$col_name= str_replace("_"," ",$col_name);
			echo "<th>$col_name</th>";
			}
			echo"<th>Request Status</th>";
			echo "</tr>";
			

						$s=1;
			while($row= mysqli_fetch_array($query))
			{	
			if($row[4]==0)
			echo "<tr>";
			else					
			echo "<tr style='background-color:E9E7E7;'>";
			echo "<td>$s</td>";
			for($c=0;$c<$col_num;$c++)
			echo "<td>$row[$c]</td>";
			echo"<td>";
		/*	if ($row[4]==0){
											
			echo "
			<a href='clientgroup.php?cid=$row[0]' class='btn btn-$theme'>Delete</a>
		<a href='clientgroup.php?add=$row[0]' class='btn btn-$theme'>Add Member</a>";
		
			}*/
					echo"<a href='data.php?request_id=$row[0]&act=1&gid=$row[1]' class='btn btn-$theme' name='undo_accept'>accept</a>
						<a href='data.php?request_id=$row[0]&act=-1&gid=$row[1]' class='btn btn-$theme' name='undo_reject'>reject</a>";


			echo"</td>";
			echo "</tr>";
			$s++;
			}
					echo"</table>";	


}



//ECHO "ASSAD";





else if($groupinfo[6]==2 ||$groupinfo[6]==-2)
{
	//echo "new status=".$groupinfo[6]; 

	
}


}
else
{
	
/*	echo "<a  class='btn btn-success btn-lg'>
    News </a>
	class=pagination pagination-sm'
	";
	*/				
	$num=array();
						for($i=0;$i<4;$i++)
						{
						if($i==0) {$where_con=" where status=2 and read_status=2";}
							else if($i==1) {$where_con=" where status=3 and read_status=3";}
							else if($i==2) {$where_con=" where status=-2 and read_status=-2";}
							else if($i==3) {$where_con=" ";}


							$sql="select * from loangroup $where_con";
	//						echo $sql;
		//					echo "<br/>";
							$query= mysqli_query($con,$sql);
							$num[$i]=mysqli_num_rows($query);		
						}
	  
//	  print_r($num);
	  echo "<hr/>";
  
	
	//				echo $sql;
		echo "  <ul class='nav nav-tabs'>";
		echo"<li class='active'><a href='manager_approval.php?act=2'>New group Request";
  if($num[0]>0)
echo "		<span class='badge'>$num[0]</span>";
echo "</a></li>";
  echo"  <li ><a href='manager_approval.php?act=3'>Approved group  ";
  if($num[1]>0)
  echo "<span class='badge'>$num[1]</span>";
  echo "</a></li>";
 echo"<li><a href='manager_approval.php?act=-2'>Rejected group  ";
   if($num[2]>0)
 echo "<span class='badge'>$num[2]</span>";
 echo "</a></li>";
 
echo"  <li ><a href='manager_approval.php?act=0'>All group ";
   if($num[3]>0)
echo "<span class='badge'>$num[3]</span>";

echo "</a></li>";
 echo "  </ul>
  
";			
$where = "";

$title="";
if(isset($_REQUEST['act']))
{
  $act=$_REQUEST['act'];
  switch($act)
  {
	   case 0: $where =" "; $title="All group"; break;
	  case 2: $where =" where status=1"; $title="New group Request"; break;
	  case 3:$where =" where status=2"; $title="Approved group"; break;
	  case -2:$where =" where status=$act"; $title="Rejected group"; break;
	  
	  
  }
	  
 
}
//$title="New Group";

echo "<h2 class='text-$theme'>$title<h2>";

						$sql="SELECT id, `Loan_Amount`,`Time_Duration`,`number_of_members`,`status` FROM `loangroup` $where";// where status=1";
				//echo $sql;
				$query=mysqli_query($con,$sql);
						$col_num=mysqli_num_fields($query);
		
			
			echo "<table class='table table-hover'>";
			echo "<tr class='bg-$theme'>";
			echo "<th>Sno</th>";
			for($c=0;$c<$col_num;$c++)
			{
				$temp=mysqli_fetch_field($query);
				$col_name=$temp->name;
				$col_name= str_replace("_"," ",$col_name);
			echo "<th>$col_name</th>";
			}
			echo "<th>View </th>";
			echo "</tr>";
			

						$s=1;
			while($row= mysqli_fetch_array($query))
			{	
			if($row[4]==0)
			echo "<tr>";
			else					
			echo "<tr style='background-color:E9E7E7;'>";
			echo "<td>$s</td>";
			for($c=0;$c<$col_num;$c++)
			echo "<td>$row[$c]</td>";
			echo"<td><a href='manager_approval.php?id=$row[0]' class='btn btn-$theme'>info</a></td>"; 
			echo "</tr>";
			$s++;
			}
					echo"</table>";	
}
							
		echo "</div>";

		

		echo "</div>";
		//include_once("footer.php");
	//	include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
?>
</html>