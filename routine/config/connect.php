<?php
if(isset($_SESSION['signup'])){
$con = mysqli_connect('localhost','root','','sms');
}
if(isset($_SESSION['loggedin'])){
	
	$con = mysqli_connect('localhost',$_SESSION['status'],$_SESSION['status'],'sms');
}
//mysqli_select_db('crud');
			// $this->myconn = new mysqli('localhost','user','','crud');
?>