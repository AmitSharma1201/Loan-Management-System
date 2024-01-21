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
                        <div class='panel-heading'> ";
						if(isset($_REQUEST['id']))
						{
							$id=$_REQUEST['id'];
							echo "<div class='pull-right'>saved :<b>Employee Id:$id</b></div>";
						}			

						echo "<h3 class='bg-$theme'>New Employee Registeration Form";
						

						echo "</h3> ";
						
						echo "</div> 
         </div>	           ";
			

				echo"

		
		    <form id='registration-form1' class='form-horizontal' action='data.php' method='post' role='form'>";
			
			
			  $cnt_array=array(
			 array("Employee Name","text",""),
			 array(" Highest Qualification","select","10th/12th/graduation/postgraduation"),
			 array("Marital status","select","married/unmarried"),
		 array("password","password"),
			 array("Gender","radio","male/female/others"),
		//	 array("gender","checkbox","abc/spic"),
		//	 array("Upload Resume","file",""),
			 array("Address","textarea",""),
			 array("Email","text",""),
			 array("Contact Number","text",""),
			 array("Date of Birth","text","")
			 
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
        if($cnt_type=="text"||$cnt_type=="password"||$cnt_type=="file")
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
      <div class='col-md-1 pull-right'>
        <input type='submit'name='newemp' class='btn btn-$theme' />
      </div>
    </div>
		  
		  
		  
        
          
          
          
          
      </form>



	  ";
		
			
			
				
echo"</div>";

		echo "</div>";
		include_once("footer.php");
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