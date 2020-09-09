<?php
session_start();
if(!isset($_SESSION['loggedin']))
	header("Location:login.php");
global $ip,$name,$date,$time,$stat,$info;
include_once('classes/userconnection.php');
	include_once('classes/userclass.php');
	$info= new UserClass();
	$user=$_SESSION['uname'];
	$result=$info->GetUserInfo($user);
	foreach($result as $uinfo)
	{
		$name=$uinfo['username'];
		$ip= $uinfo['ip_address'];
		$date= $uinfo['date'];
		$time=$uinfo['time'];
		$stat= $uinfo['user_status'];
	}
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$name);
$pdf->Cell(40,10,$ip);
$pdf->Cell(40,10,$date);
$pdf->Cell(40,10,$time);
$pdf->Cell(40,10,$stat);

$pdf->Output();
?>