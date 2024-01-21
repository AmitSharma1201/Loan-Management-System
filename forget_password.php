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
		//include("left.php");
		echo "</div>";
		echo "<div class='col-md-6'>";
		echo " <div class='panel panel-$theme'>
                        <div class='panel-heading'> LOGIN</div> 
                        <div class='panel-body minheight'>";
						echo "
						
						 <form id='registration-form2' class='form-horizontal' action='data.php' method='post' role='form'>";
			
			
			
			$cnt_array=array(
			   array("USER TYPE","select","staff/client"),
			   array("USER ID/EMAIL ID/MOBILE NUMBER","text","")
			   //array("","submit","FIND USER")   
		 );
		 $c=0;
		 			$title_value='find user';

			if(isset($_REQUEST['c']))
			{
				if(isset($_REQUEST['id']))
				$id=$_REQUEST['id'];
				
				$c=$_REQUEST['c'];

			 if($c==3)
				{echo "password updated";
			
				}
				else if($c==0)
				{echo "User not found";
			
				}					
				else if($c==1||$c==-1)
				{
								$title_value='verify otp';

					if($c==-1)
						echo "OTP MISS MATCH";
				$cnt_array=array(
							 
			   array("ENTER OTP","text",""),
			   		   array("id","hidden","$id")
   
   //            array("","submit","CONFIRM OTP")
					
					
				);
				
				}

  				
				else if($c==2)
				{
					$cnt_array=array(
			   array("ENTER NEW PASSWORD","password",""),
			   array("RETYPE PASSWORD","password","")

//			   array("","submit","RESET")
			   
		 );
		 		 	$title_value='reset password';

				}

				
			}
			  
				

				/*


*/		 
		for($i=0;$i<count($cnt_array);$i++)
		{			
	
	$label_name=$cnt_array[$i][0];
	$cnt_type=$cnt_array[$i][1];
	$value=$cnt_array[$i][2];

  echo "  <div class='form-group'>";
  if($cnt_type!="hidden")
      echo "<label class='col-md-4 control-label'>$label_name</label>";
      echo "<div class='col-md-8'>";
	$label_name=str_replace(" ","_",$label_name);  
	$label_name="cnt_".$i;
	//echo "cnt_name=$label_name";
		if($cnt_type=="hidden")
		echo "<input type='$cnt_type' name='$label_name' value='$value' class='form-control'/>";	
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
		
	echo "<div class='form-group '>
      <div class='col-md-8 col-md-offset-3'>
       <input type='submit' name='forget' class='btn btn-$theme' value='$title_value' />
      </div>
    </div>";
		   $len=count($cnt_array);
		echo "<input type='hidden' name='max_cnt_num' value='$len'/>";  
		echo "<input type='hidden' name='case' value='$c'/>";


		   
		   
				
			
	
	
				
                    
          
           echo  "</form>";
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