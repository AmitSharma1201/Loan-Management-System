<?php 
require_once("connection.php");
?>
<html>
<head>
<?php
include_once("link.php");
?>
<style>
div.box
{
position:relative;
	left:300px;
	width:300px;
	height:100px;
	
}
</style>

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
                        <div class='panel-body '>";
						
					$sql="select group_id  from groupmember where member_id=$login_id";
//					echo $sql;
						$query= mysqli_query($con,$sql);
				$num= mysqli_num_rows($query);
				if($num>0)
				{
					
					
					$row_data=mysqli_fetch_row($query);
					$loangroup_id=$row_data[0];
						$id=$loangroup_id;
						
						
						
						$stage1_message=$stage2_message=$stage3_message="";
						$title="";
						$stage1_theme=$stage2_theme=$stage3_theme="info";
						$sql="select status,other,stage2_info,stage3_info from loangroup where id=$id";
	//					echo $sql;
						$query=mysqli_query($con,$sql);
						$row_info=mysqli_fetch_row($query);
						
						$stage1_message=$row_info[1];
						$stage2_message=$row_info[2];
						$stage3_message=$row_info[3];
						
						if($row_info[0]==1)
						{
						$stage1_theme="success";
						$stage2_theme=$stage3_theme="info";
						$title="stage 1 title";
						}
						
						
						
						if($row_info[0]==2)
						{
						$stage1_theme=$stage2_theme="success";
						$stage3_theme="info";
						$title="stage 2 title";
						}
						if($row_info[0]==-2)
						{
						$stage1_theme="success";
						$stage2_theme="danger";
						$stage3_theme="info";
						$title="stage 2 title";	
						}
						
						if($row_info[0]==3)
						{
						$stage1_theme=$stage2_theme=$stage3_theme="success";
						$title="stage 3 title";
						}
						if($row_info[0]==-3)
						{
						$stage1_theme=$stage2_theme="success";
						$stage3_theme="danger";
						$title="stage 3 title";
						}
						
						
						echo "<div class='box'> 
						 <div class='panel panel-$stage1_theme'>
                        <div class='panel-heading'>stage 1 $title <br/>
						<div class='panel-body'>Msg:$stage1_message</div>
										
						</div> 
                      
						</div>
						
						
						</div>
						
						";
						echo "<div class='row'><div class='col-md-offset-5 col-md-2'><img src='arrow.jpg'/></div></div>";
						
						echo "<div class='box'> 
						 <div class='panel panel-$stage2_theme'>
                        <div class='panel-heading'>stage 2 $title<br/>
						<div class='panel-body'>Msg:$stage2_message</div>
						</div>
                      
						</div>
						
						
						</div>
						
						";
						
					echo "<div class='row'><div class='col-md-offset-5 col-md-2'><img src='arrow.jpg'/></div></div>";
						
						
						echo "<div class='box'> 
						 <div class='panel panel-$stage3_theme'>
                        <div class='panel-heading'>stage 3 $title <br/>
						<div class='panel-body'>Msg:$stage3_message</div>
						</div> 
                      
						</div>
						
						
						</div>
						
						";
				}
				else
				echo "no group formed ";
						echo "</div>
                    </div>";
		
		echo "</div>";


		echo "</div>";
	//	include_once("footer.php");
		//include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
?>
</html>