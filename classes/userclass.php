<?php

include_once('userconnection.php');
class UserClass{
  public $linku;
function __construct(){
	$db_connection=new udbConnection();
	$this->linku=$db_connection->connect();
	return $this->linku;
} 

function LoginUsers($username,$password){
	//echo $this->linku;
	$query = $this->linku->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
	$query->execute();
	$rowcount = $query->rowCount();
	return $rowcount;
}
function GetUserInfo($username){
	$query = $this->linku->prepare("SELECT * FROM users where username='$username'");
	$query->execute();
     $rowcount = $query->rowCount();   
   if($rowcount==1){
		$result=$query->fetchAll();
		return $result;
	}
	else{
		echo "Unable fetching";
		echo $rowcount;
		die();
		return $rowcount;
	}
	}
	function ChangePassword($username,$password){
	$query=$this->linku->prepare("UPDATE users  SET password='$password' WHERE username='$username'");
	
	$query->execute();
	$counts = $query->rowCount();
	return $counts;
}
 
}


?>