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
                        <div class='panel-heading'> MEMBER INFO </div> 
                        <div class='panel-body minheight'>";
					
if(isset($_REQUEST['id']))
{
	$pageno=$_REQUEST['pageno'];
	$id=$_REQUEST['id'];
	echo "<a href='viewclient.php?pageno=$pageno'>Back</a><br/>";	

$newsql="SELECT `id`,`name`,`marital`,`gender`,`address`,`city`,`village`,`email`,`contact_number`,`dateofbirth`,`image_path` FROM `client` WHERE id=$id";
//echo $newsql;
			$query1= mysqli_query($con,$newsql);
			$profileinfo=mysqli_fetch_row($query1);
			$col_num=mysqli_num_fields($query1);
			//echo $col_num;
			echo "<div class='row'>";
			echo "<div class='col-md-8'>";
			$col_list=array();
			for($c=0;$c<$col_num;$c++)
			{
				$temp=mysqli_fetch_field($query1);
				$col_list[$c]=$temp->name;
			}
			echo "<table class='table'>";
			for($c=0;$c<$col_num-1;$c++)
			{
				
				echo "<tr><th>$col_list[$c]</th><td>$profileinfo[$c]</td></tr>";
			}
			echo "</table>";
			echo "</div>";
			echo "<div class='col-md-4'>";
			$indexno=$col_num-1;
			echo "<img src='$profileinfo[$indexno]' width=200/>";
				//		$indexno=$col_num-2;
	//	echo "<a href='$profileinfo[$indexno]' >Download Resume</a>";
			
			echo "</div>";
			echo "</div>";

	
}
else
{


					$size=7;
			$sql1="SELECT * FROM `client` ";
			$query1= mysqli_query($con,$sql1);
			$total_rows= mysqli_num_rows($query1);
						
						$total_pages=round($total_rows/$size);
						
						
							$pageno=0;
							if(isset($_REQUEST['pageno']))
							$pageno=$_REQUEST['pageno'];
						$offset=$pageno*$size;
					//	echo "total rows=$total_rows total pages=$total_pages pageo=$pageno offset=$offset size=$size<hr/>";
			$sql="SELECT `id`,`name`,`gender`,`email`,`village`,`contact_number` FROM `client` limit $offset,$size";
			$query= mysqli_query($con,$sql);
			$num= mysqli_num_rows($query);
			$num_of_col= mysqli_num_fields($query);
			
			echo "Total No of clients:$num";
			
			echo "<table class='table table-hover'>";
			echo "<tr class='bg-$theme'>";
			echo "<th>Sno</th>";
			for($c=0;$c<$num_of_col;$c++)
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
			for($c=0;$c<$num_of_col;$c++)
			echo "<td>$row[$c]</td>";
			echo"<td><a href='viewclient.php?id=$row[0]&pageno=$pageno' class='btn btn-$theme'>View all info</a></td>"; 
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