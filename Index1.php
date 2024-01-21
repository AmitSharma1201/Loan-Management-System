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
		echo "<div class='row'>";
		 //echo "<div class='col-md-3'>";
		//include("left.php");
	//	echo "</div>";
		echo "<div class='col-md-9'>";
		echo " <div class='panel panel-$theme'>
                        <div class='panel-heading'>index </div> 
                        <div class='panel-body minheight'>";
						if(isset($_REQUEST['caseno']))
						{
							$caseno=$_REQUEST['caseno'];
							$id_value=$_REQUEST['id'];
							echo "<a href='index.php'>Back</a>";
						//	echo "$caseno";
								//echo "<BR/>id_value=$id_value";
								find_data1($con,$id_value,$caseno);
						}							


						if(isset($_POST['find']))
						{
							$find=$_POST['find'];
								find_data($con,$find,1);		
							find_data($con,$find,2);	
							find_data($con,$find,3);	
						}
						
					
					
						
							
						
				
	
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
   
   function find_data($con,$find,$caseno)
   {
//	   echo $caseno;
//	   echo "<br/>$find";
			$sql="";	   
	   $title="";
	   $sql="";
	   switch($caseno)
	   {
		   case 1:$sql="select id,group_name from loangroup where group_name like '%$find%'";
				 $title="Loan group";
				 break;
		   case 2:$sql="SELECT id,`name`,`gender`,`contact_number`,`email` FROM `client` where name like  '%$find%'";
				 $title="Client";
				 break;


		   case 3:$sql="SELECT `id`,`employee_Name`,`gender`,`contact_number`,`email` FROM `emp1` WHERE employee_name like '%$find%'";
				 $title="Staff Member ";
				 break;
	 
	   }

//echo $sql;
	$query= mysqli_query($con,$sql);
	$num=mysqli_num_rows($query);

if($num>0)
{
			echo "<h2>$title</h2>";

echo "<table class='table table-hover'>";
while($row_data=mysqli_fetch_array($query))
{
	echo "<tr><td><a href='index.php?caseno=$caseno&id=$row_data[0]'>$row_data[1]</a></td></tr>";
}
echo "</table>";


}

	
	//						
							
	//													

   }
   
   
   
   function find_data1($con,$id,$caseno)
   {
//	   echo $caseno;
//	   echo "<br/>id=$id";
	
		$sql="";	   
	   $title="";
	   $sql="";
	   switch($caseno)
	   {
		   case 1:$sql="select id,group_name,Loan_Amount,Time_Duration,number_of_members,info from loangroup where id=$id";
				 $title="Loan group";
				 break;
		   case 2:$sql="SELECT id,`name`,`gender`,`contact_number`,`email` FROM `client` where id=$id";
				 $title="Client";
				 break;


		   case 3:$sql="SELECT `id`,`employee_Name`,`gender`,`contact_number`,`email` FROM `emp1` WHERE id=$id";
				 $title="Staff Member ";
				 break;
	 
	   }

//echo $sql;
	$query= mysqli_query($con,$sql);
	$num=mysqli_num_rows($query);

if($num>0)
{
			echo "<h2>$title</h2>";

echo "<table class='table table-hover'>";
while($row_data=mysqli_fetch_array($query))
{
						$query= mysqli_query($con,$sql);
						$row_data=mysqli_fetch_row($query);
//						print_r($row_data);
						$num_col=mysqli_num_fields($query);
						for($i=0;$i<$num_col;$i++)
						{
							$temp=mysqli_fetch_field($query);
							$col_name=$temp->name;
							echo "<tr><th>$col_name</th><td>$row_data[$i]</td></tr>";
						}
					
//	echo "<tr><td>$row_data[1]</td></tr>";
}
echo "</table>";


}

	
	//						
							
	//													

   }
?>
</html>









<?php 
require_once("connection.php");
?>
<html>
<head>
<?php
include_once("link.php");
?>
<style>
h4{
	font-family:Century Gothic;
}
</style>
</head>
<?php
echo " 
    <body>
        <div class='container'>";
		include_once("head.php");
		include_once("mainmenu.php");
		echo "<div class='row'>";
		 //echo "<div class='col-md-3'>";
		//include("left.php");
	//	echo "</div>";
		echo "<div class='col-md-8 col-md-offset-2'>";
		echo "  <div class='panel panel-$theme'>
                       <div class='panel-heading'><center><h1>THE PARRY FINANCE INDIA COOPERATIVE SOCIETY LIMITED</h1></center> </div> 		</div>

           <h4>   	A Cooperative Society is an autonomous association of persons united voluntarily to meet their common economic, social, cultural needs. To protect the interest of weaker sections, the co-operative society is formed. It is a voluntary association of persons, whose motive is the welfare of the members. Cooperatives are based on the values of self-help, self-responsibility, democracy, equality, equity, and solidarity. </h4>
<center><h2><u><b>Parry Finance India Coop.Society Ltd.</b></u></h2></center>
	
<h4> &nbsp	The Parry Finance India Cooperative Society Ltd. is a Micro Finance , Thrift & Credit Self Supporting &nbsp Society registered under the Punjab Self Supporting Cooperative Societies Act 2006 vide letter no. &nbsp RCS/credit-1/CA-5/6163 dated <i><b>06.10.2020</b></i> and its registration number is 129 dated <b><i>14.10.2020</b></i><br>.
	The thrift and credit cooperative societies are member-based organisations that help members to address &nbsp the economic problems. The ultimate goal of the society is to encourage thrift among the members and to &nbsp meet the credit needs of people who might otherwise be exposed to exploitation and to meet this goal, Society has offered following products to its members. </h4>
<b><u><h3>Parry Micro Finance</b></u></h3><br>
<h4>To meet the credit needs of members, Society provides microfinance. The objective of scheme is to extend collateral free loans to self employed ladies, unemployed or low-income individuals through groups formed through the representatives of the Society.<br>
	The financing is done to individuals by forming groups of 5 or 10 individuals coming together for the purposes of availing Society loan through the group mechanism against mutual guarantee.<br><br>
	Every member shall be allowed a loan upto Rs.50000/- on the basis of personal and collective liability of the group which is to be repaid in maximum 24 months depending upon the loan amount.<br><br>
In case of death of the borrower, the outstanding loan will be waived by the Society by using this fund.<br></h4>
<b><u><h3>Parry Loan Against Property Scheme</b></u></h3><br>
<h4>The scheme is for providing finance against mortgage of immovable property to self employed ladies, unemployed or low-income individuals through the representatives of the Society and is designed to offer instant solutions relating to socio-economic and business needs such as, children’s higher education, travel, daughter’s marriage, medical emergencies, etc<br><br>
An individual shall be allowed a loan upto Rs.100000/- against the mortgage of property in favour of the Society. The loan is given in the shape of Term Loan. Quantum of loan is three times of net annual income or 50% of value of property, whichever is less. However maximum loan amount will be Rs. 1.00 lac<br><br>
  Loan together with interest is repayable in maximum 36 equal monthly installments.<br><br></h4>
<b><u><h3>Parry Term Deposit Scheme</b></u></h3><br>
<h4>To encourage thrift among the members so that they can have funds at the time of need, the Society is offering following deposit products to its members. The deposits are collected by the representatives of the Society from the members at door step.</h4>
<br><br>a) &nbsp	<b><u>Parry Fixed Deposit</b></u><h4> &nbsp is a financial instrument where a lump sum is received by the Society for a fixed period withdraw able only after the expiry of the fixed period and can be renewed further at the request of depositor(s)</h4>
<br><br>b)&nbsp	<b><u>Parry Recurring deposit</b></u> <h4>is a special kind of term deposit offered by Society which help people with regular incomes to deposit a fixed amount every month into their recurring deposit account and earn interest at the rate applicable to fixed deposits.</h4>
<br><br>c)&nbsp	<b><u>Parry Daily Deposit Scheme</b></u> <h4>is a special kind of term deposit account offered by the Society which will help people with regular incomes to deposit a fixed amount every day into their daily deposit account and earn interest at the rate applicable to fixed deposits. The minimum amount which can be deposited by the members is Rs.100/- per day or in multiples of Rs100/- for 365 days or 730 days. In case of non deposit of daily installment Rs.10 per day per installment will be charged from the depositor.</h4>

                    </div>";
						if(isset($_REQUEST['caseno']))
						{
							$caseno=$_REQUEST['caseno'];
							$id_value=$_REQUEST['id'];
							echo "<a href='index.php'>Back</a>";
						//	echo "$caseno";
								//echo "<BR/>id_value=$id_value";
								find_data1($con,$id_value,$caseno);
						}							


						if(isset($_POST['find']))
						{
							$find=$_POST['find'];
								find_data($con,$find,1);		
							find_data($con,$find,2);	
							find_data($con,$find,3);	
						}
						
					
					
						
							
						
				
	
		

	//	echo "<div class='col-md-3'>";
	//	include("right.php");
	//	echo "</div>";

		echo "</div>";
		include_once("footer.php");
		//include_once("modal.php");
   
  echo " </div>
   </body>
   
   ";
   
   function find_data($con,$find,$caseno)
   {
//	   echo $caseno;
//	   echo "<br/>$find";
			$sql="";	   
	   $title="";
	   $sql="";
	   switch($caseno)
	   {
		   case 1:$sql="select id,group_name from loangroup where group_name like '%$find%'";
				 $title="Loan group";
				 break;
		   case 2:$sql="SELECT id,`name`,`gender`,`contact_number`,`email` FROM `client` where name like  '%$find%'";
				 $title="Client";
				 break;


		   case 3:$sql="SELECT `id`,`employee_Name`,`gender`,`contact_number`,`email` FROM `emp1` WHERE employee_name like '%$find%'";
				 $title="Staff Member ";
				 break;
	 
	   }

//echo $sql;
	$query= mysqli_query($con,$sql);
	$num=mysqli_num_rows($query);

if($num>0)
{
			echo "<h2>$title</h2>";

echo "<table class='table table-hover'>";
while($row_data=mysqli_fetch_array($query))
{
	echo "<tr><td><a href='index.php?caseno=$caseno&id=$row_data[0]'>$row_data[1]</a></td></tr>";
}
echo "</table>";


}

	
	//						
							
	//													

   }
   
   
   
   function find_data1($con,$id,$caseno)
   {
//	   echo $caseno;
//	   echo "<br/>id=$id";
	
		$sql="";	   
	   $title="";
	   $sql="";
	   switch($caseno)
	   {
		   case 1:$sql="select id,group_name,Loan_Amount,Time_Duration,number_of_members,info from loangroup where id=$id";
				 $title="Loan group";
				 break;
		   case 2:$sql="SELECT id,`name`,`gender`,`contact_number`,`email` FROM `client` where id=$id";
				 $title="Client";
				 break;


		   case 3:$sql="SELECT `id`,`employee_Name`,`gender`,`contact_number`,`email` FROM `emp1` WHERE id=$id";
				 $title="Staff Member ";
				 break;
	 
	   }

//echo $sql;
	$query= mysqli_query($con,$sql);
	$num=mysqli_num_rows($query);

if($num>0)
{
			echo "<h2>$title</h2>";

echo "<table class='table table-hover'>";
while($row_data=mysqli_fetch_array($query))
{
						$query= mysqli_query($con,$sql);
						$row_data=mysqli_fetch_row($query);
//						print_r($row_data);
						$num_col=mysqli_num_fields($query);
						for($i=0;$i<$num_col;$i++)
						{
							$temp=mysqli_fetch_field($query);
							$col_name=$temp->name;
							echo "<tr><th>$col_name</th><td>$row_data[$i]</td></tr>";
						}
					
//	echo "<tr><td>$row_data[1]</td></tr>";
}
echo "</table>";


}

	
	//						
							
	//													

   }
?>
</html>