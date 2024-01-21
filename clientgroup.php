<?php ob_start();
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
                        <div class='panel-heading'> ";
						

						if(isset($_REQUEST['cid']))
						{
							$id=$_REQUEST['cid'];
						
						$sql="delete from loangroup where id=$id";
						if(mysqli_query($con,$sql))
						echo "Deleted";
						else
						save_error($sql);
						}
						
						if(isset($_REQUEST['memid']))
						{
							$id=$_REQUEST['memid'];
							$gid=$_REQUEST['gid'];
						$sql="delete from temp_groupmember where id=$id";
						echo "delete case= $sql";
						if(mysqli_query($con,$sql))
						header("Location:clientgroup.php?add=$gid");
						else
						save_error($sql);
						}
						
						
						
						if(isset($_REQUEST['id']))
						{
							$id=$_REQUEST['id'];
							echo "<div class='pull-right'>saved :<b>Group Id:$id</b></div>";
						}			

						echo "<h3 class='bg-$theme'>Client Group";
						

						echo "</h3> ";
						
						echo "</div> 
         </div>	           ";

						if(isset($_REQUEST['add']))
						{
							if(isset($_REQUEST['mem'])){
								$mem_id=$_REQUEST['mem'];
								echo"<h3>member id =$mem_id already in an exsisting group</h3>";
							}
						
							
							
							
								echo "<a href='clientgroup.php'>Back</a><br/>";
							$group_id=$_REQUEST['add'];
							
							$sql1="select * from loangroup where id=$group_id ";

							$query1=mysqli_query($con,$sql1);
							$row_data=mysqli_fetch_row($query1);
							
							$max_no_of_member=$row_data[6];
							echo "Group Name=$row_data[2]<br/>";
							echo "Loan Amount =$row_data[3]<br/>";
							echo "Max number of Member=$row_data[6]";		
//		echo $max_no_of_member;
					$sql="SELECT `id`,`group_id`,`member_id`,`member_type`,`status` FROM `temp_groupmember` WHERE group_id=$group_id";

			$query1= mysqli_query($con,$sql);
			$num= mysqli_num_rows($query1);

			$btn_status="";
		if($row_data[6]==$num)
				$btn_status="disabled";	
							
//	echo "temp_loan_group=$group_id";					
	echo "		    <form id='registration-form1' class='form-horizontal' action='data.php' method='post' role='form'>";
  echo "  <div class='form-group'>
  <input type='hidden' name='group_id' value='$group_id'/>
      <label class='col-md-4 control-label'>Enter member Id( Profile Id )</label>
      <div class='col-md-8'>";
		echo "<select name='member_id' class='form-control'>";
		$sql2="SELECT id,name FROM client where loan_status=0";
		$query2=mysqli_query($con,$sql2);
		while($row2=mysqli_fetch_array($query2))
		{
			echo "<option value='$row2[0]'>$row2[1] ($row2[0])</option>";
		}
echo "</select>no loan active member id list";		
echo "</div></div>";
	echo "<div class='form-group'>
      <div class='col-md-8'>
        <input type='submit'name='addmem' $btn_status value='Add Member' class='btn btn-$theme' />
      </div>
    </div>
      </form>
	  ";




				//	$sql="SELECT `id`,`group_id`,`member_id`,`member_type`,`status` FROM `temp_groupmember` WHERE group_id=$group_id";
				//	echo $sql;
					
		
			if($num>0)
			{
					$num_of_col= mysqli_num_fields($query1);
			echo "<table class='table table-hover'>";
			echo "<tr class='bg-$theme'>";
			echo "<th>Sno</th>";
			for($c=0;$c<$num_of_col;$c++)
			{
				$temp=mysqli_fetch_field($query1);
				$col_name=$temp->name;
				$col_name= str_replace("_"," ",$col_name);
			echo "<th>$col_name</th>";
			}
			echo "<th>View </th>";
			echo "</tr>";
			$s=1;
			while($row= mysqli_fetch_array($query1))
			{	
			echo "<tr>";
			echo "<td>$s</td>";
			for($c=0;$c<$num_of_col;$c++)
			echo "<td>$row[$c]</td>";
			echo"<td>
			<a href='clientgroup.php?memid=$row[0]&gid=$row[1]' class='btn btn-$theme'>Delete</a>
		
			
			</td>"; 
			echo "</tr>";
			$s++;
			}
		echo "</table>";
		
		
		
		$status="disabled";
							$sql2="SELECT `id`,`group_id`,`member_id`,`member_type`,`status` FROM `temp_groupmember` WHERE group_id=$group_id and status=1";

			$query2= mysqli_query($con,$sql2);
$num2=mysqli_num_rows($query2);
//echo "$num";  
if($num2>=5)
{
	$status="";
}
//echo "<br/>$num2";
	echo"<a href='data.php?ap_id=$group_id' $status class='btn btn-$theme'>send for approval(to team)</a>";

			}
			



	
	
//						$sql="delete from temp_loan_group where group_id=$id";
//						if(mysqli_query($con,$sql))
//						echo "Deleted";
//						else
//						save_error($sql);
						}
else
{


			

				echo"

		
		    <form id='registration-form1' class='form-horizontal' action='data.php' method='post' role='form'>";
			
			
			  $cnt_array=array(
			 array("GROUP NAME","text",""),
			 array("number of memebers","select","5/6/7/8/9/10"),
			 array("Loan_Amount","text",""),
			 array("Time_Duration","select","18/24/30/36/42/48/54/60"),
			 array("Details","textarea",""),
			 array("admin_id","hidden",""),

			
			  );
//			  $label_array=array("Employee Name","Gender","Marital status");

	//	  $arr1="Married,Unmarried";

		for($i=0;$i<count($cnt_array);$i++)
		{			
	
	$label_name=$cnt_array[$i][0];
	$cnt_type=$cnt_array[$i][1];

  echo "  <div class='form-group'>
      <label class='col-md-4 control-label'>$label_name</label>
      
	  <div class='col-md-8'>";
	$label_name=str_replace(" ","_",$label_name);  
	$label_name="cnt_".$i;
	//echo "cnt_name=$label_name";
//	echo "<input type='$cnt_type' name='$label_name' class='form-control'/>";
      if($cnt_type=="hidden")
		echo "$login_id<input type='$cnt_type' name='$label_name'  value='$login_id' class='form-control'/>";	
		else if($cnt_type=="text"||$cnt_type=="password"||$cnt_type=="file")
		echo "<input type='$cnt_type' name='$label_name' class='form-control' required/>";	
		else if($cnt_type=="select")
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
			
      echo "</div>
    </div>";
		}	
	
		   $len=count($cnt_array);
		echo "<input type='hidden' name='max_cnt_num' value='$len'/>";  

	echo "<div class='form-group'>
      <div class='col-md-8'>
        <input type='submit' name='grpmem' class='btn btn-$theme' />
      </div>
    </div>
		  
		  
		  
        
          
          
          
          
      </form>



	  ";
		
		
		
					$sql="SELECT  id,admin_id,group_name,Loan_Amount,Time_Duration,number_of_members,'info',status,'other' FROM loangroup";
//					echo $sql;
			$query= mysqli_query($con,$sql);
			$num= mysqli_num_rows($query);
			$num_of_col= mysqli_num_fields($query);
			
			echo "<table class='table table-hover'>";
			echo "<tr class='bg-$theme'>";
			echo "<th>Sno</th>";
			for($c=0;$c<$num_of_col-5;$c++)
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
			echo "<tr>";
			echo "<td>$s</td>";
			for($c=0;$c<$num_of_col-5;$c++)
			echo "<td>$row[$c]</td>";
			
			
			
			echo"<td>";
			
			if ($row[7]==0){
				
				
			
			echo "
			<a href='clientgroup.php?cid=$row[0]' class='btn btn-$theme'>Delete</a>
		<a href='clientgroup.php?add=$row[0]' class='btn btn-$theme'>Add Member</a>";
		
			}
			else if($row[7]==1){
				echo"waiting for approval";
			}
			else if($row[7]==2){
				echo"passed to verification team";
			}
			else if($row[7]==-2){
				echo"rejection from approval team";
			}
			else if($row[7]==3){
				echo"approved from verification team and passed to final stage";
			}
			else if($row[7]==-3){
				echo"rejected ";
			}
			else if($row[7]==4){
				echo"loan approved";
			}
			else if($row[7]==-4){
				echo"rejected by company";
			}
			
			echo "</td>"; 
			
			echo "</tr>";
			$s++;
			}
		echo "</table>";

		
			
}			
				
echo"</div>";

		echo "</div>";
		//include_once("footer.php");
		include_once("modal.php");
   
  echo " </div>
  	<script src='assets/js/jquery-1.7.1.min.js'></script> 
    <script src='assets/js/jquery.validate.js'></script>";
	?>
	
  <script src='script.js'>
  
  
  
$(document).ready(function(){


		$('#registration-form').validate({
	    rules: {
	       cnt_0 : {
	        required: true,
			minlength:5
	      }
		  
	    },
		/*
		messages: {
			upload:
			{
			regex: "not of specified type"
			},
    email: {
      required: "We need your email address to contact you",
      email: "Your email address must be in the format of name@domain.com"
    }
  },*/
		
		/*	highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
				$(element).closest('.control-group').removeClass('success').addClass('icon');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}*/
	  });

}); // end document.ready
  
  </script> 
  <?php
  echo " </body>
   
   ";
?>
</html>