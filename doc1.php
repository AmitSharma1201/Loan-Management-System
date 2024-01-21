<?php

require('connection.php');
require('fpdf.php');

$gid=$_REQUEST['gid'];
$sql1="select * from loangroup where id=$gid";
$query1=mysqli_query($con,$sql1);
$groupinfo=mysqli_fetch_row($query1);
$pdf=new FPDF();
$pdf->Addpage();
$pdf->setFont("Arial","",16);
$pdf->SetFillColor(976,255,255);
$pdf->SetAuthor('Jules Verne');
$pdf->Cell(0,10,"THE PARRY FINANCE INDIA COOPERATIVE SOCIETY LTD.",0,1,'C',true);
$pdf->setFont("Arial","",10);
$pdf->Cell(0,3,"ADDRESS",0,1,'C',true);
$pdf->Cell(0,10,"BANK DETAILS OF MEMBERS",0,1,'C',true);
$pdf->Ln(10);

$pdf->setFont("Arial","",8);
$pdf->Cell(0,10,"Name of Group:$groupinfo[2]       loan amount:($groupinfo[3])",0,1,'L',true);
//$pdf->Cell(0,10,"THE PARRY FINANCE INDIA COOPERATIVE SOCIETY LTD.",0,1,'C',true);
//$pdf->Ln(130);

$pdf->Cell(0,10,"SNO                  Name of Members                        Name of Bank                       Account No .                                        IFSC Code",1,1,'L',true);
$sql="SELECT `name`,`bank_name`,`account_number`,`ifsc_code` FROM `client` where id in(select member_id from groupmember where group_id=$gid)";
//$pdf->Cell(0,10,"SNO             Name of Members                 Name of Bank                   Account No .                    IFSC Code",1,1,'L',true);
$query=mysqli_query($con,$sql);
$num=mysqli_num_rows($query);
$col_num=mysqli_num_fields($query);
$sno=1;
//$y1=63;
//$y2=53;
if($num>0)
{	$x=20;
while($member_info=mysqli_fetch_array($query))
    {
	  
	$pdf->MultiCell(10,10,"$sno. ",1,1,'L',true);
	$sno++;
	for($i=0;$i<$col_num;$i++)
	{
	$pdf->SetX($x);
		$pdf->MultiCell(40,10,"$member_info[$i].",1,1,'L',true);
//	$pdf->SetX(58);
	//$pdf->MultiCell(32,10,"$member_info[1].",1,1,'L',true);
	//	$pdf->SetX(90);
	//$pdf->MultiCell(40,10,"$member_info[2].",1,1,'L',true);
	//$pdf->SetX(130);
	//$pdf->MultiCell(70,10,"$member_info[3].",1,1,'L',true);
//	$x=$x+40;

  }



}
}
else
$pdf->Cell(0,10,"no member found",1,1,'L',true);
$pdf->Cell(0,10,"Signature of PSP                                                                                                                                     Signature of Supervisor",0,1,'L',true);
$pdf->Cell(0,2,"(with Stamp)                                                                                                                                                  (with Stamp)",0,1,'L',true);
//$pdf->Cell(0,10,"",0,1,'R',true);
//$pdf->Cell(0,10,"(with Stamp)",0,1,'R',true);
//$pdf->Line(20,83,20,53);
//$pdf->Line(55,83,55,53);
//$pdf->Line(88,83,88,53);
//$pdf->Line(125,83,125,53);


//$pdf->Image("",150,120,50);
$pdf->output();
//$file_src="mynewpdf.pdf";
w32api_deftype
?>