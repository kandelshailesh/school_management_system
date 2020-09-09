<?php 
session_start();



if(isset($_POST['next']) && !empty($_POST['next'])){
	$k +=1;
	//unset($_POST['next']);
}
else if(isset($_POST['previous']) && !empty($_POST['previous'])){
	$k -=1;
	//unset($_POST['previous']);
}
$_SESSION['k']=$k;
header("Location:login.php");
?>