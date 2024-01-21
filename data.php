<?php
require_once("connection.php");
//echo "data page<br/>";
if(isset($_POST['contact_us']))
{
 $max_cnt_num=$_POST['max_cnt_num'];
$array=array();
$sql_value_list="";
for($i=0;$i<$max_cnt_num;$i++)
{
	
	$cnt_name="cnt_".$i;
	//if($i!==5)
	$array[$i]=$_POST[$cnt_name];
	//else
	//$array[$i]=implode("/",$_POST[$cnt_name]);
//	echo "<br/>$i=".$array[$i];
	$sql_value_list .="'".$array[$i]."'";
	if($i<$max_cnt_num-1)
		$sql_value_list .=",";
}
//echo "sql_value_list=$sql_value_list";
//$sql="INSERT INTO `emp` (`employee_name`, `gender`, `marital`, `password`, `checkbox`, `image`, `message`) values($sql_value_list)";
$sql="INSERT INTO `contact` (name,mobile_number,message) values($sql_value_list)";

if(mysqli_query($con,$sql))
{echo "saved";
$id=mysqli_insert_id($con);
header("Location:index.php");
}
else
{save_error($sql);}
}
else if(isset($_POST['upload_cheque']))
{
//echo "upload_cheque";
	$id=$_POST['id'];
//echo "id=$id<br/>";
	$cheque=$_FILES['loan_cheque'];
//	print_r($cheque);
	
$cheque_path=upload($cheque,"docs/client_docs/cheque",$id,$con);
$cheque_date=date("d/m/20y");

$sql="update loangroup set loan_cheque='$cheque_path',cheque_date='$cheque_date' where id='$id'";
		if(mysqli_query($con,$sql))	
		{
			
			
			$sql="SELECT Loan_Amount,Time_Duration,number_of_members FROM loangroup where id=$id";
			$query=mysqli_query($con,$sql);
			$loan_info=mysqli_fetch_row($query);
			//$loan_amt=$
			$sql1="select member_id from groupmember where group_id=$id";
			$query1=mysqli_query($con,$sql1);
			$sql2="INSERT INTO `emi`(`group_id`,`member_id`,`total_loan`,`Balance_amt`,`emi_amount`) values";
			$total_loan=$loan_info[0]/$loan_info[2];
			$emi_amount=round($total_loan/$loan_info[1]);
			$i=0;
			while($row=mysqli_fetch_array($query1))
			{
	//			echo "$row[0]<br/>";
				$sql2 .="($id,$row[0],$total_loan,$total_loan,$emi_amount)"; 
				$i++;
				if($i<$loan_info[2])
					$sql2 .=",";
			}
			//echo $sql2;
			//exit;
			mysqli_query($con,$sql2);
		header("Location:manager_approval.php?id=$id");
	
		}
		else{
		save_error($sql);}
 

}



else if(isset($_POST['upload_doc1']))
{
echo "upload_doc1";
	$id=$_POST['id'];

	$file1=$_FILES['cnt_0'];
  $file2=$_FILES['cnt_1'];
    $file3=$_FILES['cnt_2'];
  $file4=$_FILES['cnt_3'];
  $file5=$_FILES['cnt_4'];

print_r($file1);
//print_r($file2);
$str1="";
if(isset($_FILES['cnt_0']['name']) &&$_FILES['cnt_0']['name']!="")
{$doc1_path=upload($file1,"docs/client_docs/doc1",$id,$con);
$str1="path1='$doc1_path'";
}
if(isset($_FILES['cnt_1']['name']) &&$_FILES['cnt_1']['name']!="")
{
$doc2_path=upload($file2,"docs/client_docs/doc2",$id,$con);
if($str1!="") $str1 .=",";
$str1 .="path2 ='$doc2_path'";
}
if(isset($_FILES['cnt_2']['name']) &&$_FILES['cnt_2']['name']!="")
{
$doc3_path=upload($file3,"docs/client_docs/doc3",$id,$con);
if($str1!="") $str1 .=",";
$str1 .="path3='$doc3_path'";
}
if(isset($_FILES['cnt_3']['name']) &&$_FILES['cnt_3']['name']!="")
{
$doc4_path=upload($file4,"docs/client_docs/doc4",$id,$con);
if($str1!="") $str1 .=",";
$str1 .="path4='$doc4_path'";
}
if(isset($_FILES['cnt_4']['name']) &&$_FILES['cnt_4']['name']!="")
{
$doc5_path=upload($file5,"docs/client_docs/doc5",$id,$con);
if($str1!="") $str1 .=",";
$str1 .="path5='$doc5_path'";
}


	$sql="update loangroup set $str1 where id='$id'";
		if(mysqli_query($con,$sql))	
		header("Location:getnewgrouprequest.php?id=$id");
		else
		save_error($sql);
//	print_r($doc1);
	
}
else if(isset($_REQUEST['request_id']))
{
	$request_id=$_REQUEST['request_id'];
	$act=$_REQUEST['act'];
	$gid=$_REQUEST['gid'];
	
	echo"act= $act";
echo"request_id= $request_id";
	if($act==1)
	{
			$sql="update loangroup set  status=$act where id=$gid";
			
			mysqli_query($con,$sql);
	}
	$sql="update request_for_undo set  status=$act where id=$request_id";
	if(mysqli_query($con,$sql))
	header("Location:manager_approval.php?id=$gid&a=$act");
	else
	save_error($sql);
}
else if(isset($_POST['undo_request']))
{
	$id=$_POST['group_id'];
	$msg=$_POST['undo_request_msg'];
	$login_id=$_SESSION['login_id'];

	$sql="insert into request_for_undo(group_id,message,admin_id) values($id,'$msg',$login_id) ";
		if(mysqli_query($con,$sql))	
		header("Location:getnewgrouprequest.php?id=$id");
		else
		save_error($sql);

}

else if(isset($_POST['forget']))
{
$c=$_POST['case'];
echo $c;
if($c==0)
{
$user_type=$_POST['cnt_0'];
$user_id=$_POST['cnt_1'];
//$user_password=$_POST['cnt_2'];

//echo "user_password=$user_password<br/>";
$table_name="";
$userid="";
if($user_type=="staff")
{
$table_name="emp1";

	$sql="select id,employee_Name,password,image_path from $table_name where id='$user_id' or email='$user_id' or contact_number='$user_id'";	
	}
else
{$table_name="client";	
	$sql="select id,name,password,image_path from $table_name where id='$user_id' or email='$user_id' or contact_number='$user_id'";
}	
$_SESSION['table_name']=$table_name;	
$_SESSION['userid']=$id;	


$query=mysqli_query($con,$sql);
$num=mysqli_num_rows($query);
//echo $num;
if($num==1)
{
	
	$user_info= mysqli_fetch_row($query);
	
	
	

$otp=rand(1111,9999);


$sql="update $table_name set otp=$otp  where id=$user_info[0]";	
//echo $sql;
//exit;
mysqli_query($con,$sql);
	
	
	
	header("Location:forget_password.php?id=$user_info[0]&c=1");
}
else
	header("Location:forget_password.php?c=0");


}
else if($c==1||$c==-1)
{

echo "case1";
$user_otp=$_POST['cnt_0'];
$id=$_POST['cnt_1'];
$_SESSION['id']=$id;
echo $id;
echo "user otp=$user_otp";
//$sql="select * from "
$table_name=$_SESSION['table_name'];
echo "<br/>$table_name";	
$sql="select * from  $table_name where id=$id and otp=$user_otp";

$query=mysqli_query($con,$sql);
$num=mysqli_num_rows($query);
if($num==1)
header("Location:forget_password.php?c=2");
else
header("Location:forget_password.php?id=$id&c=-1");	


}
else if($c==2)
{
	//echo "case2";
	$newpassword=$_POST['cnt_0'];
	$recheckpassword=$_POST['cnt_1'];
		$id=$_SESSION['id'];
	$table_name=$_SESSION['table_name'];
	if($newpassword==$recheckpassword)
	{
	//	echo "<br/>$table_name";	
	$newpassword=base64_encode($newpassword);
$sql="update $table_name set password='$newpassword' where id=$id";
//echo"$sql";
if(mysqli_query($con,$sql))
header("Location:forget_password.php?c=3");
else
save_error($sql);	
	
	}
	
}



}
 else if(isset($_POST['login']))
{

$user_type=$_POST['cnt_0'];
$user_id=$_POST['cnt_1'];
$user_password=$_POST['cnt_2'];
//echo "user_password=$user_password<br/>";
if($user_type=="staff")
$sql="select id,employee_Name,password,image_path from emp1 where id='$user_id' or email='$user_id' or contact_number='$user_id'";	
else if($user_type=="Admin")
$sql="select id,password from admin where user_id='$user_id' ";	
else IF($user_type=="Client")
$sql="select id,name,password,image_path from client where id='$user_id' or email='$user_id' or contact_number='$user_id'";	
//$password="spic123";
//$password=base64_encode($password);
//echo $password;
//exit;
$query=mysqli_query($con,$sql);
$num=mysqli_num_rows($query);
if($num==1)
{
	$user_info=mysqli_fetch_row($query);
		if($user_type=="Admin")
		$db_password=base64_decode($user_info[1]);
		else
		$db_password=base64_decode($user_info[2]);

	if($db_password==$user_password)
	{ 
	$_SESSION['user_type']=$user_type;
		$_SESSION['login_id']=$user_info[0];


if($user_type=="Admin")
		header("Location:admin.php");
		else
		header("Location:profile.php?id=$user_info[0]");
	}else
	header("Location:login.php?id=$user_id&case=2");
//			echo "password miss match:user_password=$user_password db_password=$db_password";
}
else
header("Location:login.php?id=$user_id&case=1");

}
else if(isset($_REQUEST['case1']) || isset($_REQUEST['case2'])|| isset($_REQUEST['case3'])|| isset($_REQUEST['case4']))
  {
	 $comment=$_POST['comment'];
	 $group_id=$_POST['group_id'];
	 $status_value=2;
	 if(isset($_REQUEST['case1']))
	 {
		 $url="getnewgrouprequest.php";
	 echo "case1";
	 	 		$sql="update loangroup set status=2 ,stage2_info ='$comment' WHERE id=$group_id ";	
	 }else if(isset($_REQUEST['case2']))
	 {		 $url="getnewgrouprequest.php";
		 $status_value=-2;
		 	 		$sql="update loangroup set status=-2 ,stage2_info ='$comment' WHERE id=$group_id ";	
	 echo "case2";
 }else if(isset($_REQUEST['case3']))
 {		 $url="manager_approval.php";
	 	$sql="update loangroup set status=3 ,stage3_info ='$comment' WHERE id=$group_id ";	
	 echo "case 3";
 } 	 
 else if(isset($_REQUEST['case4']))
 {		 $url="manager_approval.php";
	 	$sql="update loangroup set status=-3 ,stage3_info ='$comment' WHERE id=$group_id ";	
	 echo "case 4";
 } 

//echo $sql;
// exit;

//EXIT;


				if(mysqli_query($con,$sql))
				header("Location:$url");
				else
				save_error($sql);

 }
 
 else if (isset($_POST['approve_case1'])  ||   isset($_POST['reject_case1']))
{
	$status_value=1;
$group_id=$_POST['gid'];
$member_id=$_POST['member_id'];
$reason=$_POST['reason'];
       

	if(isset($_POST['approve_case1'])){
	$status_value=2;
	$sql1="update client set loan_status=2 WHERE id=$member_id";
	$query1=mysqli_query($con,$sql1);
	}
	else{
	$status_value=-2;
			$sql2="update client set loan_status=0 WHERE id=$member_id";
	$query2=mysqli_query($con,$sql2);
	}
			$sql="update groupmember set status=$status_value, other='$reason' WHERE group_id=$group_id and member_id=$member_id";
	 

if(mysqli_query($con,$sql))
{
			$sql1="insert into member_action_detail(group_id,member_id,info) values($group_id,$member_id,'$reason')";
			
		if(mysqli_query($con,$sql1))
		header("Location:getnewgrouprequest.php?gid=$group_id&member_id=$member_id");
		else
		save_error($sql1);
}
else
	save_error($sql);


}
else if (isset($_REQUEST['ap_id']))
{
	$group_id=$_REQUEST['ap_id'];

	$sql1="insert INTO groupmember select * FROM temp_groupmember WHERE group_id=$group_id and status=1";
	if(mysqli_query($con,$sql1))
	{
		$sql2="update loangroup set status=1 where  id=$group_id ";
		if(mysqli_query($con,$sql2))
		{
			
		
		$sql3="delete from temp_groupmember where  group_id=$group_id ";
		if(mysqli_query($con,$sql3))
		{ echo "done";
		header("Location:clientgroup.php");
		}//
		else
		save_error($sql3);
		
		}
		else
		save_error($sql2);
	}
	else
	save_error($sql1);
}
else if(isset($_POST['addmem']))
{
$group_id=$_POST['group_id'];
echo $member_id=$_POST['member_id'];

$sql="select * from temp_groupmember where member_id=$member_id and group_id=$group_id";
$query=mysqli_query($con,$sql);
$num=mysqli_num_rows($query);
$sql1="update client set loan_status=1 where id=$member_id";
$query1=mysqli_query($con,$sql1);
if($num==0)
{
	$otp=rand(1111,9999);
$sql="INSERT INTO `temp_groupmember` (`group_id`,`member_id`,otp,member_type) values($group_id,$member_id,$otp,'member')";

if(mysqli_query($con,$sql))
{echo "saved";
$id=mysqli_insert_id($con);
header("Location:clientgroup.php?add=$group_id");

}
else
{save_error($sql);}

}
else
{//echo "Location:clientgroup.php?add=$group_id&memid=$member_id";
//exit;
header("Location:clientgroup.php?add=$group_id&mem=$member_id");
}

}
else if(isset($_POST['grpmem']))
{
 $max_cnt_num=$_POST['max_cnt_num'];
$array=array();
$sql_value_list="";
for($i=0;$i<$max_cnt_num;$i++)
{
	
	$cnt_name="cnt_".$i;
	//if($i!==5)
		$array[$i]=$_POST[$cnt_name];
	//else
	//$array[$i]=implode("/",$_POST[$cnt_name]);
//	echo "<br/>$i=".$array[$i];
	$sql_value_list .="'".$array[$i]."'";
	if($i<$max_cnt_num-1)
		$sql_value_list .=",";
}
//echo "sql_value_list=$sql_value_list";
//$sql="INSERT INTO `emp` (`employee_name`, `gender`, `marital`, `password`, `checkbox`, `image`, `message`) values($sql_value_list)";
$sql="INSERT INTO `loangroup` (group_name,number_of_members,Loan_Amount,Time_Duration,info,admin_id) values($sql_value_list)";

if(mysqli_query($con,$sql))
{echo "saved";
$id=mysqli_insert_id($con);
header("Location:clientgroup.php?id=$id");
}
else
{save_error($sql);}
}


else if(isset($_POST['upload']))
{
	$id=$_POST['id'];
	$resume=$_FILES['cnt_0'];
	$image=$_FILES['cnt_1'];

$resume_path=upload($resume,"docs/staff/resume",$id,$con);
$image_path=upload($image,"docs/staff/image",$id,$con);


		$sql="update emp1 set resume_path='$resume_path',image_path='$image_path' where id='$id'";
		if(mysqli_query($con,$sql))	
		header("Location:newemployee.php?id=$id");
		else
		save_error($sql);
		



}
else if(isset($_POST['clientupload']))
{
	$id=$_POST['id'];

	$signature=$_FILES['cnt_0'];
		$adharcard=$_FILES['cnt_1'];
	$pancard=$_FILES['cnt_2'];
	$image=$_FILES['cnt_3'];
		$other=$_FILES['cnt_4'];
		
$signature_path=upload($signature,"docs/client/signature",$id,$con);
$adharcard_path=upload($adharcard,"docs/client/adharcard",$id,$con);
$pancard_path=upload($pancard,"docs/client/pancard",$id,$con);
$image_path=upload($image,"docs/client/image",$id,$con);
$other_path=upload($other,"docs/client/other",$id,$con);

	$sql="update client set signature_path='$signature_path',adharcard_path='$adharcard_path',pancard_path='$pancard_path',image_path='$image_path',other_path='$other_path' where id='$id'";
	if(mysqli_query($con,$sql))	
		header("Location:client.php?id=$id");
		else
		save_error($sql);

}
else if(isset($_POST['newemp']))
{
 $max_cnt_num=$_POST['max_cnt_num'];
$array=array();
$sql_value_list="";
for($i=0;$i<$max_cnt_num;$i++)
{
	
	$cnt_name="cnt_".$i;
	//if($i!==5)
	if($i==3)
	$array[$i]=base64_encode($_POST[$cnt_name]);
	else
	$array[$i]=$_POST[$cnt_name];
	//else
	//$array[$i]=implode("/",$_POST[$cnt_name]);
//	echo "<br/>$i=".$array[$i];
	$sql_value_list .="'".$array[$i]."'";
	if($i<$max_cnt_num-1)
		$sql_value_list .=",";
}
//echo "sql_value_list=$sql_value_list";
//$sql="INSERT INTO `emp` (`employee_name`, `gender`, `marital`, `password`, `checkbox`, `image`, `message`) values($sql_value_list)";
$sql="INSERT INTO `emp1` (`employee_Name`, `Higher_Qualification`, `marital`, `password`, `gender`, `Address`,email, `contact_number`, `dateofbirth`) values($sql_value_list)";
if(mysqli_query($con,$sql))
{echo "saved";
$id=mysqli_insert_id($con);
header("Location:uploaddoc.php?id=$id");
}
else
{save_error($sql);}
}
else if(isset($_POST['newclient']))
{
 $max_cnt_num=$_POST['max_cnt_num'];
$array=array();
$sql_value_list="";
	///$password=base64_encode($array[2]);
    // $array[2]=$password;	
for($i=0;$i<$max_cnt_num;$i++)
{
	
	
	$cnt_name="cnt_".$i;
	//if($i!==5)
	if($i==2)
	$array[$i]=base64_encode($_POST[$cnt_name]);
	else
	$array[$i]=$_POST[$cnt_name];
	//else
	//$array[$i]=implode("/",$_POST[$cnt_name]);
//	echo "<br/>$i=".$array[$i];
	$sql_value_list .="'".$array[$i]."'";
	if($i<$max_cnt_num-1)
		$sql_value_list .=",";
}
//echo "sql_value_list=$sql_value_list";
//print_r($sql_value_list);
//exit;

$sql="INSERT INTO `client` (`name`, `marital`, `password`, `gender`,`bank_name`,`account_number`,`ifsc_code`, `Address`,`city`,`village`,`email`, `contact_number`, `dateofbirth`) values($sql_value_list)";
if(mysqli_query($con,$sql))
{echo "saved";
$id=mysqli_insert_id($con);
header("Location:clientupload.php?id=$id");
}
else
{save_error($sql);
}

}
else 
{
echo "else case";	
}


function upload($file,$dir,$id,$con)
{
//	print_r($file);
	$path1=$file['tmp_name'];
	$name_v=$file['name'];
	$temp=explode(".",$name_v);
	$len=count($temp);
	///print_r($temp);
	$name=$id.".".$temp[$len-1];
	$path2="$dir/".$name;
	
	//echo "path2=".$path2;
	
//	exit;
	
	
	if(move_uploaded_file($path1,$path2))
	{//echo "uploaded";
return $path2;
	}
	else
	{save_error(" uploading error");
return "";}

}

?>