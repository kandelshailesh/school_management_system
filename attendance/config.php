
<?php
 error_reporting(E_ALL & ~E_NOTICE);
 error_reporting(E_ALL ^ E_DEPRECATED);
//session_start();
if(isset($_SESSION['loggedin'])){
$connect = mysql_connect("localhost",$_SESSION['status'],$_SESSION['status']);
}
else{
	if(isset($_SESSION['signup'])){
	$connect=mysql_connect("localhost",'root',"");
	}
}
if(!$connect)
{
	echo "Error".mysql_error();
	}
	
	
	$db=mysql_select_db("sms");
	if(!$db)
	{
		echo "Error".mysql_error();
		}
		



?>