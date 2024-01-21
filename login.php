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
";
		echo "<div class='col-md-offset-3 col-md-6'>";
		$msg="";
		if(isset($_REQUEST['case']))
		{
			$case=$_REQUEST['case'];
			if($case==1)
				$msg="User not found";
			else
				$msg="password Miss Match";
		}			

		echo " <div class='panel panel-$theme'>
                        <div class='panel-heading'> LOGIN:$msg</div> 
                        <div class='panel-body minheight'>";
						
						echo "
						 <form id='registration-form2' class='form-horizontal' action='data.php' method='post' role='form'>";
			
			
			  $cnt_array=array(
			   array("USER TYPE","select","Client/staff/Admin"),
			   array("USER ID/EMAIL ID/MOBILE NUMBER","text",""),
			  array("PASSWORD","password")
		 );
					
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
        if($cnt_type=="text"||$cnt_type=="password"||$cnt_type=="file")
		echo "<input type='$cnt_type' name='$label_name' class='form-control'/>";	
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
		echo "<textarea name='$label_name' class='form-control' rows=5 cols=10></textarea>";	
			
      echo "</div>
    </div>";
		}	
	
		   $len=count($cnt_array);
		echo "<input type='hidden' name='max_cnt_num' value='$len'/>";  
		
echo "<div class='form-group'>
      <div class='col-md-8'>
     <u> <a href='forget_password.php'>forget password</a></u>
      </div>
    </div>";
	echo "<div class='form-group'>
      <div class='col-md-8'>
   <center>     <input type='submit' name='login' class='btn btn-$theme' value='Login'/></center>
      </div>
    </div>
		   
		        
                    
          
                </form>	";
						echo "</div>
                    </div>";
		
		echo "</div>";

		
		echo "</div>";
	//	include_once("footer.php");
	//	include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
?>
</html>