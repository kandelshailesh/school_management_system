<?php
session_start();
if(!isset($_SESSION['signup']))
{
	header("Location:login.php");
}
//----------------student registration starts
if(isset($_POST['reg_student'])){
	
	include_once('classes/connection.php');
	include_once('classes/manageuser.php');
	$username=$_POST['username'];
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	//$ip_address= $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set("Asia/Kathmandu");
	$date = date("Y:m:d");
	$time = date("h:i:sa");
	$year=date("Y");
	global $reg;
	$reg= new ManageUsers();
	if(empty($username) || empty($password) || empty($repassword) )
	{
		$error ='ALL fields are required!';
		echo $error;
	}
	elseif($password != $repassword)
	{
		$error='Password doesnot match with repassword!';
		echo $error;
	}
	
	elseif($reg->GetUserInfo($username)){
		echo "This username already exists, try registering with another username!";
		
	}
	
	if($reg->Check($_POST['class'],$_POST['roll_no'])){
		echo "Duplicate Roll Number for class ".$_POST['class'].". Try with different roll number";
		
	}
	
	else{
		$hsh=abs(crc32($username));
		$hsh="st".$hsh;		
		$stat=$reg->RegisterStudent($username,$password,$hsh,$time,$date,$_SESSION['user_stat'],$hsh,$_POST['roll_no'],$_POST['dob'],$_POST['gender'],$_POST['email'],$_POST['phone'],$_POST['address'],$_POST['status'],$year,$_POST['class'],$_POST['fat'],$_POST['mot'],$_POST['sname'],$_POST['fee'],$_POST['scholarship']);
		if($stat==1){
			$_SESSION['Registered']=true;
			
			
				
				
					unset($_SESSION['signup']);
					
					//session_destroy();     
					
					

					header("location:login.php");
				
		}
			
		}
	}
	

//--------------teacher registration starts

if(isset($_POST['reg_teacher'])){
	
	include_once('classes/connection.php');
	include_once('classes/manageuser.php');
	$username=$_POST['username'];
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	//$ip_address= $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set("Asia/Kathmandu");
	$date = date("Y:m:d");
	$time = date("h:i:sa");
	global $reg;
	$reg= new ManageUsers();
	if(empty($username) || empty($password) || empty($repassword))
	{
		$error ='ALl fields are required!';
		echo $error;
	}
	elseif($password != $repassword)
	{
		$error='Password doesnot match with repassword!';
		echo $error;
	}
	elseif($reg->GetUserInfo($username)){
		echo "This username already exists, try registering with another username!";
		
	}
	else{
		$hsh=abs(crc32($username));
		$hsh="tr".$hsh;		
		$stat=$reg->RegisterTeacher($username,$password,$hsh,$time,$date,$_SESSION['user_stat'],$hsh,$_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['gender'],$_POST['email'],$_POST['phone'],$_POST['degree'],$_POST['salary'],$_POST['address'],$_POST['fat'],$_POST['mot']);
		if($stat==1){
			$_SESSION['Registered']=true;
			
			
				
				
					unset($_SESSION['signup']);
					
					//session_destroy();     
					
					

					header("location:login.php");
				
		}
			
		
	}
	
}
//------------staff registration starts
if(isset($_POST['reg_staff'])){
	
	include_once('classes/connection.php');
	include_once('classes/manageuser.php');
	$username=$_POST['username'];
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	//$ip_address= $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set("Asia/Kathmandu");
	$date = date("Y:m:d");
	$time = date("h:i:sa");
	global $reg;
	$reg= new ManageUsers();
	if(empty($username) || empty($password) || empty($repassword) )
	{
		$error ='ALl fields are required!';
		echo $error;
	}
	elseif($password != $repassword)
	{
		$error='Password doesnot match with repassword!';
		echo $error;
	}
	elseif($reg->GetUserInfo($username)){
		echo "This username already exists, try registering with another username!";
		
	}
	else{
		$hsh=crc32($username);
				
		$stat=$reg->RegisterStudent($username,$password,$ip_address,$time,$date,$_SESSION['user_stat'],$hsh,$_POST['grade'],$_POST['addr'],$_POST['fat'],$_POST['mot'],$_POST['dobbs'],$_POST['dobad'],$_POST['fname'],$_POST['lname'],$_POST['gender']);
		if($stat==1){
			$make_sessions=$reg->GetUserInfo($username);
			foreach($make_sessions as $userSessions)
			{
				$_SESSION['name'] = $userSessions['username'];
				if(isset($_SESSION['name']))
				{
					unset($_SESSION['signup']);
					unset($_SESSION['name']);
					session_destroy();
					header("location:login.php");
				}
			}
			
		}
	}
	
}
?>