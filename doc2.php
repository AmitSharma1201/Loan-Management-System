<?php

require('connection.php');
require('fpdf.php');

$gid=$_REQUEST['gid'];
$sql1="select * from loangroup where id=$gid";
$query1=mysqli_query($con,$sql1);
$groupinfo=mysqli_fetch_row($query1);
$pdf=new FPDF();
$pdf->Addpage();
$pdf->setFont("Arial","",14);
$pdf->SetFillColor(976,255,255);
$pdf->SetAuthor('Jules Verne');
$pdf->Cell(0,10,"Parry Finance India Cooperative Society Limited(PFIL)(T&C)",0,1,'C',true);
$pdf->setFont("Arial","",14);
$pdf->Cell(0,5,"Self Supporting Society Patran.",0,1,'C',true);
$pdf->Cell(0,10,"PROMISSORY NOTE",0,1,'C',true);
//$pdf->Ln(10);
$pdf->setFont("Arial","",10);
$pdf->Cell(0,10,"RS:__________________________",0,1,'L',true);
$pdf->Cell(0,10,"Place:__________________________",0,1,'R',true);
$pdf->Cell(0,10,"Date:__________________________",0,1,'R',true);
$pdf->Ln(2);

$pdf->setFont("Arial","",9);
$pdf->SetX(35);
$pdf->MultiCell(0,5,"On demand  I/we jointly and severlly Promise to pay The Parry Finance India\nCooperative Society Limited(PFIL) MIcro Finance,T&C Self Supporting Society.Patran or orden\nthe sum of Rupees______________________(Rs____________________________________)\ntogether with interest at_______________%per annum to be charged monthly for value recieved.",0,1,'C',true);
//$pdf->MultiCell(0,5," ",0,1,'C',true);
//$pdf->MultiCell(0,5,"",0,1,'C',true);
//$pdf->Cell(0,5,"",0,1,'C',true);
$pdf->Ln(4);
$pdf->Cell(0,5,"We also undertake to pay the penal interest @____________%over and above thr normal",0,1,'C',true);
$pdf->Cell(0,5,"rate of interest in ase of default.",0,1,'C',true);
$pdf->Ln(3);
$pdf->Cell(0,5,"(Revenue Stamp)(Rs.1)",0,1,'L',true);
$pdf->setFont("Arial","",11);
$pdf->Cell(0,10,"Name of Group:$groupinfo[2]       loan amount:($groupinfo[3])",0,1,'R',true);
$pdf->setFont("Arial","",9);
$sql="SELECT `name`,`village` FROM `client` where id in(select member_id from groupmember where group_id=$gid) ";
$query=mysqli_query($con,$sql);
$num=mysqli_num_rows($query);
$sno=1;
$sno1=6;
$pdf->Ln(5); 
if($num>0)

{
	$y=124;
	while($member_info=mysqli_fetch_array($query))
		{
			
			//if($sno==6){
				
			//}
			if($sno<6)
			$pdf->MultiCell(80,10,"$sno.\nNAME:$member_info[0]\nVILLAGE:$member_info[1]",1,1,'L',true);
			else
			{
							$pdf->SetY($y);

				$pdf->SetX(120);
			$y +=30;
			$pdf->MultiCell(80,10,"$sno.\nNAME:$member_info[0]\nVILLAGE:$member_info[1]",1,1,'L',true);
			}//  $sno1++;
			//}
            $sno++;
	    }

}
else{
	$pdf->Cell(0,10,"no member found",1,1,'L',true);

}







//$pdf->Image("",150,120,50);
$pdf->output();
//$file_src="mynewpdf.pdf";
w32api_deftype
?>