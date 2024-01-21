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
		echo "<a href='getnewgrouprequest.php?id=$gid'>Back</a><br/>";
		
			$sql="select id,`name`,`marital`,`gender`,`email`,`contact_number`,`signature_path`,`adharcard_path`,`Pancard_path`,`image_path`  from client where id=$memberid";
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
	if($c<6)
	{
	echo "<tr><th>$col_name</th><td>$groupmemberinfo[$c]</td></tr>";
	}
	else if($c<9)
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
						
echo"</div>";
echo "</form>";
}
else
echo  $loangroupinfo[0];





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
							echo "<a href='getnewgrouprequest.php'>Back</a><br/>";
																					echo "  <ul class='nav nav-tabs'>";
		echo"<li class='active'><a href='getnewgrouprequest.php?id=$id&act=1'>group info</a></li>";
  echo"  <li ><a href='getnewgrouprequest.php?id=$id&act=2'>Member info</a></li>";
 echo"<li><a href='getnewgrouprequest.php?id=$id&act=3'>documents</a> </li>";
 
//echo"  <li ><a href='getnewgrouprequest.php?id=$id&act=4'>upload cheque</a></li>";
echo"  <li ><a href='getnewgrouprequest.php?id=$id&act=5'>Request Status</a></li>";

 echo "  </ul>";
 
 
 
	
	
	$sql="update loangroup set read_status=0 where id=$id";
	mysqli_query($con,$sql);
						
						$sql="select id,admin_id,group_name,Loan_Amount,Time_Duration,number_of_members , status from loangroup where id=$id";
						$query=mysqli_query($con,$sql);
						$col_num=mysqli_num_fields($query);
					$groupinfo=mysqli_fetch_row($query);
			if($act==1)		{
					
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
			
			for($c=0;$c<$col_num-1;$c++)
			{
	//			$temp=mysqli_fetch_field($query);
				//$col_name=$temp->name;
				//$col_name= str_replace("_"," ",$col_name);
			echo "<td>$groupinfo[$c]</td>";
			}
			echo "</tr>";
			$s=1;
			
echo "</table>";					
			}
			
			
	
		$sql="select id,`name` ,`marital`,`gender` from client where id in(select member_id from groupmember where group_id=$id)";
	//	$sql="select id,`name`,`Higher_Qualification`,`marital`,`gender`,`email`,`contact_number`,`signature_path`,`addhar_path`,`PAN_path`,`image_path`  from client where id in(select member_id from groupmember where group_id=$id)";
//echo $sql;
						$query=mysqli_query($con,$sql);
						$col_num=mysqli_num_fields($query);
$count=mysqli_num_rows($query);

if($act==2){
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


echo "<td><a href='getnewgrouprequest.php?gid=$id&member_id=$groupmemberinfo[0]'>more info<a/></td>";
echo "</tr>";
}
echo "</table>";
}

echo "<br/><br/><br/><br/><br/>";
if($act==3){
		$sql="select path1,path2,path3,path4,path5 from loangroup where id=$id";
//		echo $sql;
		
		$query=mysqli_query($con,$sql);

		$row_data=mysqli_fetch_row($query);
//		print_r($row_data);

				echo"


		    <form id='registration-form1' class='form-horizontal' action='data.php' method='post' role='form' enctype='multipart/form-data'>";
			echo "<input type='hidden' name='id' value='$id'/>";
			
			  $cnt_array=array(
				 array("doc1","file",$row_data[0]),
			 	 array("doc2","file",$row_data[1]),
				 array("doc3","file",$row_data[2]),
			 	 array("doc4","file",$row_data[3]),
			 	 array("doc5","file",$row_data[4])

			 
			  );
//			  $label_array=array("Employee Name","Gender","Marital status");

	//	  $arr1="Married,Unmarried";
		for($i=0;$i<count($cnt_array);$i++)
		{			
echo "<div class='form-group'>";
	
	$label_name=$cnt_array[$i][0];
	$cnt_type=$cnt_array[$i][1];

  echo "  
      <label class='col-md-1 control-label'></label>
      <div class='col-md-11'>";
	$label_name=str_replace(" ","_",$label_name);  
	$label_name="cnt_".$i;
	//echo "cnt_name=$label_name";
        if($cnt_type=="text"||$cnt_type=="password"||$cnt_type=="file")
		{
			/*
		if($cnt_type=="file" && $cnt_array[$i][2]!="")
		{   $path=$cnt_array[$i][2];
			echo"<div class='row'>";
			echo "<div class='col-md-5'><a href='$file_path'>print</a></div>
			<div class='col-md-6'>
			<input type='$cnt_type' name='$label_name' class='form-control'/>
			<a href='$path'>view /download  </a></div></div>";
			
		

	
		}
		*/
		$lb_name=$cnt_array[$i][0];
		$file_path=$cnt_array[$i][0].".php?gid=$id";
		$path=$cnt_array[$i][2];
		echo "<div class='row'>";
		echo "<label class='col-md-4'><a href='$file_path'>Print</a></label>";
		echo "<label class='col-md-4'>$lb_name</label>";
		echo "<div class='col-md-4'><input type='$cnt_type' name='$label_name' class='form-control'required/>";
		if($path!="")
		echo "<a href='$path'>view /download  </a>";
		echo "</div>";
		echo "</div>";		
		}else if($cnt_type=="select")
		{
			echo "<select name='$label_name' class='form-control'>";
			$select_option_value_list=$cnt_array[$i][2];
			$temp=explode("/",$select_option_value_list);
			for($j=0;$j<count($temp);$j++)
			echo "<option value='$temp[$j]'>$temp[$j]</option>";
			echo "</select>";
		}
		else if($cnt_type=="radio"|| $cnt_type=="checkbox")
		{

			$status="";
			echo "<div class='form-check'>";
			if($cnt_type=="checkbox")
			{						$label_name .="[]";
	//	echo "checkbox label_name=$label_name";

			}else
				$status="checked";
		
			$option_value_list=$cnt_array[$i][2];
			$temp=explode("/",$option_value_list);
			for($j=0;$j<count($temp);$j++)
			echo "

		<input type='$cnt_type' name='$label_name' $status class='form-check-input' value='$temp[$j]'/>
				<label class='form-check-label' for='flexCheckDefault'>$temp[$j]  &nbsp;&nbsp;</label>
		";
			echo "</div>";
		}
	   else if($cnt_type=="textarea")
		echo "<textarea name='$label_name' class='form-control' rows=5 cols=10 required></textarea>";	
			
      echo "</div>";
   	
	echo " </div>";
		}
		   $len=count($cnt_array);
		echo "<input type='hidden' name='max_cnt_num' value='$len'/>";  


$group_status=$groupinfo[6];
if($group_status==1)
{
	echo "<div class='form-group'>
      <div class='col-md-8'>
      <input type='submit' name='upload_doc1' value='Upload' class='btn btn-$theme' />
      </div>
    </div>";
	
}		  
		  
		  
        
          
          
          
          
    echo "</form>



	  ";

}


echo "<br/><br/><br/><br/><br/>";


	$sql="select * from loangroup where id=$id  and path1!='' and path2!='' and path3!='' and path4!='' and path5!=''";
//	echo $sql;
	$query=mysqli_query($con,$sql);
	$num=mysqli_num_rows($query);
//	echo "num=$num";
	//echo $sql;
	$status="disabled";
if($num==1)
$status="";

if($groupinfo[6]==1)
{

echo"<hr\>
<form  method='post'>
<input type='hidden' name='group_id' value='$id'/>
<h4>number of members=$count<br></h4>";

echo "<div class='row'>";
	
			  $cnt_array=array(
			  
			   array("","textarea","REASON")
);
for($i=0;$i<count($cnt_array);$i++)
		{			
	
	$label_name=$cnt_array[$i][0];
	$cnt_type=$cnt_array[$i][1];
	$value=$cnt_array[$i][2];


  echo "  <div class='form-group'>
      <label class='col-md-3 control-label'>$label_name</label>
      <div class='col-md-5'>";
	$label_name=str_replace(" ","_",$label_name);  
	$label_name="cnt_".$i;
	if($cnt_type=="textarea")
		echo "<textarea name='$label_name' class='form-control' rows=5 cols=40>$value</textarea>";	
		  echo "</div>
    </div>";
		}	
//	echo"<div class='col-md-5'> <textarea name='comment'  rows=5 cols=40>COMMENT</textarea></div>";
echo"<div class='col-md-3'><input type='submit' name='case1_approval' $status formaction='data.php?case1=1' value='approved' class='btn btn-$theme'/></div>";
echo"<div class='col-md-3'><input type='submit' name='case1_reject' $status formaction='data.php?case2=2' value='reject' class='btn btn-$theme'/></div>";

echo"</form>";
echo"</div>";

}


else if($groupinfo[6]==2 ||$groupinfo[6]==-2)
{
	echo "new status=".$groupinfo[6]; 

echo"<hr\>
<form  method='post' action='data.php'>
<input type='hidden' name='group_id' value='$id'/>";
echo"<textarea name='undo_request_msg' rows=2 cols=40>UNDO REQUEST MESSAGE</textarea>";
echo"<br><input type='submit' name='undo_request'  value='undo request' class='btn btn-$theme'/>";
echo "</form>";
	
}
if($act==5){

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
			 if($row[4]==0){
				echo"waiting for approval";
			}
			else if($row[4]==1){
				echo"request approved";
			}
			else if($row[4]==-1){
				echo"request denied";
			}
			echo"</td>";
			echo "</tr>";
			$s++;
			}
					echo"</table>";	
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
							$query= mysqli_query($con,$sql);
							$num[$i]=mysqli_num_rows($query);		
						}
	  
	//  print_r($num);
	  echo "<hr/>";
  
	
				//	echo $sql;
		echo "  <ul class='nav nav-tabs'>";
		echo"<li class='active'><a href='getnewgrouprequest.php?act=2'>New group Request</a></li>";
  if($num[0]>0)
echo "		<span class='badge'>$num[0]</span>";
echo "</a></li>";
  echo"  <li ><a href='getnewgrouprequest.php?act=3'>Approved group  ";
  if($num[1]>0)
  echo "<span class='badge'>$num[1]</span>";
  echo "</a></li>";
 echo"<li><a href='getnewgrouprequest.php?act=-2'>Rejected group  ";
   if($num[2]>0)
 echo "<span class='badge'>$num[2]</span>";
 echo "</a></li>";
 
echo"  <li ><a href='getnewgrouprequest.php?act=0'>All group ";
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

	$sql="SELECT id,admin_id,group_name,Loan_Amount,Time_Duration,number_of_members,info,other,stage2_info,stage3_info,read_status FROM `loangroup`$where";// where status=1";
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
			if($row[10]==0)
			echo "<tr>";
			else					
			echo "<tr style='background-color:E9E7E7;'>";
			echo "<td>$s</td>";
			for($c=0;$c<$col_num;$c++)
			echo "<td>$row[$c]</td>";
			echo"<td><a href='getnewgrouprequest.php?id=$row[0]' class='btn btn-$theme'>info</a></td>"; 
			echo "</tr>";
			$s++;
			}
					echo"</table>";	
}
							
		echo "</div>";

		

		echo "</div>";
	//	include_once("footer.php");
	//	include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
?>
</html>