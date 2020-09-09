<?php
session_start();
if(isset($_SESSION['Registered'])){
	echo "Registered Successfully...";
	unset($_SESSION['Registered']);
	//session_destroy();
}
if(isset($_SESSION['signup'])){
unset($_SESSION['signup']);
session_destroy();
}
if(isset($_SESSION['loggedin'])){
unset($_SESSION['loggedin']);
session_destroy();
}

?>
<style>
body{
	background-color:indigo;
}
</style>
<div style="background-color:blue; color:white;" >
<form action="login_user.php" method="POST" >
Log In<br />
Username:<input type="text" name="username" value="" />
Password:<input type="password" name="password" value="" />
<input type="submit" name="submit" />
</form>
<form action="signup.php" method="POST">
Register<br/ >
AdminName:<input type="text" name="admin" value="">
Password:<input type="password" name="apassword" />
<input type="submit" name="adminpg" value="Go To Admin" />
</form>
</div>
<div style="background-color:green; width:40%; color:white;">
<h1>Notices</h1>
</div>

<div style="background-color:khaki; width:40%;"  >
<?php include_once("display.php"); ?>
</div>

<div style="background-color:orange;height:40%;">
</div>