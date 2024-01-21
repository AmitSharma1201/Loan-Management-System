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
                        <div class='panel-body minheight'>";
						
													$size=10;
			
				
				if(isset($_POST['receive_emi']))
				{
					
					echo "emi pay option";
					$balance_amt=$_POST['balance_amt'];
					$emi_amt=$_POST['emi_amt'];
					$member_id=$_POST['member_id'];
					$loan_id=$_POST['loan_id'];
					$interest=$_POST['interest'];
					$paid_amount=$_POST['paid_amount'];
					$balance_amount=$balance_amt-$emi_amt;
					
//echo $balance_amt;
//echo "<br/>$emi_amt<br/>$balance_amount";					
					$date=date("d/m/20y");
$sql="insert into emi (group_id,member_id,balance_amt,emi_amount,date,interest,paid_amount) values($loan_id,$member_id,$balance_amount,$emi_amt,'$date',$interest,$paid_amount)";
//echo $sql;
//exit;

	$query1=mysqli_query($con,$sql);

	/*	$date=date("d/m/20y");
						//echo"$sql1";
				//exit;
	
				 $sql2="select * from emi where member_id=$member_id";
				// echo"$sql2";
				// exit;
				 $query2=mysqli_query($con,$sql2);
				 $emi_info=mysqli_fetch_row($query2);
				 $new_individual_loan=$emi_info[4]-$emi_info[5];
				 $new_total_loan=$emi_info[3]-$emi_info[5];
				// $emi_info[3]=$new_individual_loan;
				$sql3="update emi set individual_loan=$new_individual_loan where member_id=$member_id";
				echo $sql3;
				exit;
			//	$query3=mysqli_query($con,$sql3);
*/
				
				}
				

			
			else if(isset($_REQUEST['pay_id']))
			{
				$member_id=$_REQUEST['pay_id'];
					echo "Member id=:$member_id";
					//exit;
					$sql="select * from client where id=$member_id";
					$query=mysqli_query($con,$sql);
					$member_info=mysqli_fetch_row($query);
			echo "<div class='row'>";
echo "<div class='col-md-6'>";			
					echo "<table class='table'>";


					echo "<tr><td>Member Name<td><td>$member_info[1]</td></tr>";
					echo "<tr><td></td><td><img src='$member_info[17]' width=200/></td></tr>";
					echo "<tr><td>Gender<td><td>$member_info[4]</td></tr>";
					$sql="select * from loangroup where id=(select group_id from groupmember where member_id=$member_id and status=2)";
					//echo $sql;
					$query=mysqli_query($con,$sql);
					$group_info=mysqli_fetch_row($query);
					$group_id=$group_info[0];
                     $total_loan=$group_info[3];
					$total_amt=$group_info[3]/$group_info[6];	
						$emi_amt=round($total_amt/$group_info[4]);
						$interest=$total_amt*(2/100);
						$paid_amount=$emi_amt+$interest;
						$balance_amount=$total_amt-$emi_amt;
						
						
					echo "total_amt=$emi_amt";
	
					echo "<tr><td>Total Loan<td><td>$group_info[3]</td></tr>";
				//	echo "<tr><td> Loan<td><td>$total_loan</td></tr>";
					
					echo "<tr><td>individual Loan<td><td>$total_amt</td></tr>";
	$sql1="select balance_amt FROM `emi` where member_id=$member_id and group_id=$group_info[0] order by id  desc";
				//echo $sql1;
				//exit;
				$query1=mysqli_query($con,$sql1);
				$balance_amt_info=mysqli_fetch_row($query1);
				$balance_amt=$balance_amt_info[0];
					echo "<form action='recieve_emi.php' method='post' onsubmit='return confirm_msg()'>";
					echo "<tr><td>Balance amount<td><th><input type='hidden' name='balance_amt' value='$balance_amt'/>$balance_amt</th></tr>";
					echo "<input type='hidden' name='member_id' value='$member_id'/>";
					echo "<input type='hidden' name='loan_id' value='$group_info[0]'/>";
					echo "<tr><td>Emi <input type='hidden' name='emi_amt' value='$emi_amt'/><td><td>$emi_amt</td></tr>";
					echo "<tr><td>Interest<input type='hidden' name='interest' value='$interest'/><td><td>$interest</td></tr>";
					
					echo "<tr><td>Total Amount paid<input type='hidden' name='paid_amount' value='$paid_amount'/><td><td>$paid_amount</td></tr>";
					echo "</table>";
					
					echo"<td><input type='submit' class='btn btn-$theme' name='receive_emi' value='Receive Amount'/></td>"; 
					echo "</form>";
					
					
					
					
					echo "</div>";
					echo "<div class='col-md-6'>";
					
			    $sql1="SELECT id,`paid_amount`,`date` FROM `emi`  where member_id=$member_id and group_id=$group_info[0] order by id  desc";
				$query1=mysqli_query($con,$sql1);
				echo "<table class='table'>";
				while($row=mysqli_fetch_array($query1))
				{
					echo "<tr>";
					for($i=1;$i<3;$i++)
						echo "<td>$row[$i]</td>";
					echo "<td><a href='print.php?id=$row[0]'>Print</a></td>";
					echo "</tr>";
				}
				echo "</table>";

					echo "</div>";
					echo "</div>";
					

					
					
			}													
			else if(isset($_REQUEST['id']))
			{
				
				echo "<a href='recieve_emi.php'>Back</a>";
				
								$gid=$_REQUEST['id'];
							$sql="SELECT * from `loangroup` where id=$gid ";
							$query=mysqli_query($con,$sql);
							$loan_info=mysqli_fetch_row($query);
							$act=1;
							if(isset($_REQUEST['act']))
							$act=$_REQUEST['act'];	

			$sql1="SELECT * from `groupmember` where group_id=$gid ";
		
			$query1= mysqli_query($con,$sql1);
			$num=mysqli_num_rows($query1);	
			echo "$num Member";	
			echo "<table class='table'>";
			$sno=1;
			echo "<tr><td>Sno</td><td>Loan info</td><td>Member Id</td><td>Member Name</td></tr>";
		while($row=mysqli_fetch_array($query1))
			{
				
				$temp=$loan_info[3]/$num;
		
				$amt=round($temp/$loan_info[4]);
				
				$sql2="select * from client where id=$row[2]";
				$query2=mysqli_query($con,$sql2);
				$member_info=mysqli_fetch_row($query2);
				echo "<tr><td>$sno</td><td>$amt </td><td>$member_info[0]</td><td>$member_info[1]</td><td><a href='recieve_emi.php?pay_id=$member_info[0]'>pay</a></td></tr>";
			$sno++;
			}
			echo "</table>";
			
			}
			else
			{
			$sql1="SELECT * from `loangroup` where status=3 ";
			$query1= mysqli_query($con,$sql1);
			$total_rows= mysqli_num_rows($query1);
						
						$total_pages=round($total_rows/$size);
						
						
							$pageno=0;
							if(isset($_REQUEST['pageno']))
							$pageno=$_REQUEST['pageno'];
						$offset=$pageno*$size;
					//	echo "total rows=$total_rows total pages=$total_pages pageo=$pageno offset=$offset size=$size<hr/>";
			$sql="SELECT `id`,`group_name`, `Loan_Amount`,`Time_Duration`,`number_of_members` FROM `loangroup`  where status=3  limit $offset,$size";
			$query= mysqli_query($con,$sql);
			$num= mysqli_num_rows($query);
			$num_of_col= mysqli_num_fields($query);
			
			echo "Total No of approved groups:$num";
			
			echo "<table class='table table-hover'>";
			echo "<tr class='bg-$theme'>";
			echo "<th>Sno</th>";
			for($c=0;$c<$num_of_col-1;$c++)
			{
				$temp=mysqli_fetch_field($query);
				$col_name=$temp->name;
				$col_name= str_replace("_"," ",$col_name);
			echo "<th>$col_name</th>";
			}
						echo "<th>group info </th>";

			echo "</tr>";
			$s=1;
			while($row= mysqli_fetch_array($query))
			{	
			echo "<tr>";
			echo "<td>$s</td>";
			for($c=0;$c<$num_of_col-1;$c++)
			echo "<td>$row[$c]</td>";
		//	echo"<td><a href='$row[5]' class='btn btn-$theme'>View</a></td>"; 	
						echo"<td><a href='recieve_emi.php?id=$row[0]' class='btn btn-$theme'>view info</a></td>"; 	


			echo "</tr>";
			$s++;
			}
		echo "</table>";
		
		echo "<div class='row'><div class='col-md-12'><center>";
		if($pageno>0)
		{
			$lastpageno=$pageno-1;
		echo "<a href='viewclient.php?pageno=$lastpageno'><<</a> ";
		}
		
		for($j=1,$i=$j-1;$i<$total_pages;$i++,$j++)
		{
			
			if($i==$pageno)
			echo "<font size=20px; color='red'>$j </font> &nbsp;";
			else
			echo "<a href='viewclient.php?pageno=$i'>$j</a> &nbsp;";
		}
		if($pageno<$total_pages-1)
		{$pageno++;
		echo "<a href='viewclient.php?pageno=$pageno'>>></a>";
		}
		
		echo "</center></div>";
													}
						echo "</div>
                    ";
												
		echo "</div>";
													
		

		echo "</div>";
		
		
		
			

	

													
	//	include_once("footer.php");
	//	include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
?>
<script>
function confirm_msg()
{
	return confirm("are you sure");
}
</script>
</html>