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
		echo "<div class='col-md-8'>";
		echo " <div class='panel panel-$theme'>
                        <div class='panel-heading'> $theme </div> 
                        <div class='panel-body minheight'>";
							$size=10;
			$sql1="SELECT * from `loangroup` ";
			$query1= mysqli_query($con,$sql1);
			$total_rows= mysqli_num_rows($query1);
						
						$total_pages=round($total_rows/$size);
						
						
							$pageno=0;
							if(isset($_REQUEST['pageno']))
							$pageno=$_REQUEST['pageno'];
						$offset=$pageno*$size;
					//	echo "total rows=$total_rows total pages=$total_pages pageo=$pageno offset=$offset size=$size<hr/>";
			$sql="SELECT `id`,`group_name`, `Loan_Amount`,`status`,`cheque_date`,`loan_cheque`FROM `loangroup`  where status=3 limit $offset,$size";
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
			echo "<th>loan cheque </th>";
			echo "</tr>";
			$s=1;
			while($row= mysqli_fetch_array($query))
			{	
			echo "<tr>";
			echo "<td>$s</td>";
			for($c=0;$c<$num_of_col-1;$c++)
			echo "<td>$row[$c]</td>";
			echo"<td><a href='$row[5]' class='btn btn-$theme'>View</a></td>"; 	

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