<?php
require_once("confic.php");
$con=mysqli_connect($server,$db_userid,$db_password,$database);

if(!$con)
header("Location:errorpage.php?err=101");


function save_error($sql)
{
	$err=date("d-m-y")."u".rand(1000,9999);
$file=fopen("error.txt","a");
$data="\n".$err."--".$sql;
fwrite($file,$data);
fclose($file);
header("Location:errorpage.php?err=$err");
//return $err;

}
?>