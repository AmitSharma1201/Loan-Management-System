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
                        <div class='panel-heading'> Group Join Request Page </div> 
                        <div class='panel-body minheight'>";
						echo "Login Profie id=$login_id<br/>";
						if (isset($_REQUEST['act']))
						{
							$act=$_REQUEST['act'];
							$id=$_REQUEST['id'];
						//	echo"$act";
							$sql=" update temp_groupmember set status=$act where id=$id";
							if(mysqli_query($con,$sql))
								echo "updated";
							else
								saveerror($sql);
						}
						
						
						
						
						
						$sql="select * from temp_groupmember where member_id=$login_id order by id desc";
						$query=mysqli_query($con,$sql);
						
						while($temp_groupmemberinfo=mysqli_fetch_array($query))
						{
//							print_r($groupinfo);
							$group_id=$temp_groupmemberinfo[1];
					
						$sql2="select * from loangroup where id=$group_id";
						$query2= mysqli_query($con,$sql2);
						$groupinfo=mysqli_fetch_row($query2);
					
						echo "<table class='table table-hover'>";
							echo "<tr><td>Group Id</td><td>$group_id</td></tr>";
						
						echo "<tr><td>Group Name </td><td>$groupinfo[2]</td></tr>";
						$sql3="select name from client where id=$groupinfo[1]";
						
						$query3=mysqli_query($con,$sql3);
						$admininfo=mysqli_fetch_row($query3);
						echo "<tr><td>Admin  name(profile id) </td><td> $admininfo[0] ($groupinfo[1])</td></tr>";
					//	echo "<tr><td>Group info </td><td>$groupinfo[5]</td></tr>";
						
						echo "<tr><td>";

						echo "<ul>Member info";
						$sql1="select * from client where id in(select member_id from temp_groupmember where group_id=$group_id) ";
						$query1=mysqli_query($con,$sql1);
						while($member_info=mysqli_fetch_array($query1))
						{
						$sql2="select *  from temp_groupmember where group_id=$group_id and member_id=$member_info[0] ";
							$query2=mysqli_query($con,$sql2);
							$mem_info=mysqli_fetch_row($query2);
							$status_theme="bg-info";
							$msg="waiting";
							if($mem_info[4]==1){
								$status_theme="bg-success";
							$msg="join";
							}
							else if($mem_info[4]==-1){
								$status_theme="bg-danger";
							$msg="reject";
							}
							
							echo "<li class='$status_theme'>  $member_info[1]    ($msg ) </li>";
						}
						echo "</ul>";
						
						echo "</td></tr>";						
						
						
						
						echo "</table>";						
		
		
							if($temp_groupmemberinfo[4]==0)
							{
							echo "<div class='row'>";
							echo"<div class='col-md-3'><a href='request_to_join.php?act=1&id=$temp_groupmemberinfo[0]'class='btn btn-$theme'>join(Accept)  </a></div>";
						echo"<div class='col-md-3'><a href='request_to_join.php?act=-1&id=$temp_groupmemberinfo[0]' class='btn btn-$theme'>decline(Reject)  </a></div>";
							
							echo "</div>";
							}
							else
							{
							//echo $temp_groupmemberinfo[4]."<br/>";
	
	echo "<div class='row'><div class='col-md-offset-3 col-md-9'><h3 class='text-$theme'> your status:";
							if($temp_groupmemberinfo[4]==1)
							echo"accepted";
							else
								echo"refused";
												
							echo "</h3></div></div>";
							}

						}							
						
						
						/*
						$sql="select * from temp_groupmember where group_id= (select group_id from temp_groupmember where member_id=$login_id)";
						
						$query= mysqli_query($con,$sql);
						echo "<table class='table table-hover'>";
						while($row=mysqli_fetch_array($query))
						{
							echo "<tr><td>";
							$sql1="select name from client where id=$row[2]";
							$query1=mysqli_query($con,$sql1);
							$memberinfo=mysqli_fetch_row($query1);
							echo $memberinfo[0];
							echo "</td><td></td></tr>";
						}
						
						echo "</table>";
						*/
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