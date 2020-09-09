<?php
 	include "home/bootheader.php";
?>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60"onload="myFunction()" style="margin:0;">
<?php
	include "home/navbar.php";
	?>

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
<!---login-->

<div class="container-fluid" style="background-image: url(images/signupbg.jpg); background-repeat: no-repeat;">
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-6">
 			<h1 class="signuptext" style="font-size: 280%; text-align: center; padding-top:200px; color:#ffffff; 
    font-family: Georgia, serif; letter-spacing: 0.05em;">Welcome to School Management System</h1><br><br>
 			<h4 class="signuptext" style="padding-bottom: 200px; color:#ffffff; font-family: Courier New, Courier, monospace;">Get connected with your school stuffs.Stay close with your School.</h4>
 			</div>
 			<div style="padding-top: 60px;" class="col-sm-4">
 			<div class= "w3-card-4 w3-white w3-card-12">
 				
 				<div style="padding:20px;">
 			<p><h3>Login</h3><h7 style="color: red; padding: 15px;">*For Students</h7></p>
 					<form action="login_user.php" method="POST" >

<input type="text" name="username" placeholder="USERNAME" size="30" required value="" /><br><br>
<input type="password" name="password" placeholder="PASSWORD" size="30" required value="" /><br><br>
<input type="submit" name="submit" value="Log In" />
</form>
<form action="signup.php" method="POST">
<p><h3>Sign Up</h3><h7 style="color: red; padding: 15px;">*Administration</h7></p>

<input type="text" name="admin" placeholder="USERNAME" size="30" required value=""><br><br>
<input type="password" name="apassword" placeholder="PASSWORD" size="30" required /><br><br>
<input type="submit" name="adminpg" value="Admin" />
</form>
</div>

 			</div>
 			</div>
 		</div>
 	</div>
</div>



</body>

</html>


<!---login-->