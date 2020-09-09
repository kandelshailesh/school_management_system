<?php
include_once('manageuser.php');
class udbConnection{
protected $connuser;
public $name='sms';
//public $user='amit';
//public $pass='patel';
public $host='localhost:3306';

function connect(){
try{
	//echo $_SESSION['status'];
$this->connuser=new PDO("mysql:host=$this->host;dbname=$this->name",$_SESSION['status'],$_SESSION['status']);
return $this->connuser;
}
catch(PDOException $e){
return $e->getMessage();
}
}
}
?>