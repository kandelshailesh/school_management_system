<div id="about" class="container text-center w3-animate-bottom">
	<div class="row">
		
			<div class="col-sm-6" style=" padding: 15px;">
				<div  style="background-color: #e6e6e6;">	
					<div style="padding:10px 30px;">
						<h3>Login</h3>
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
<div style="padding: 20px;">
<form action="login_user.php" method="POST" >

<input type="text" name="username" size="45" value="" placeholder="USERNAME" required /><br><br>
<input type="password" name="password" size="45" value="" placeholder="PASSWORD" required /><br><br>
<input type="submit" name="submit" />
</form>
</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 " style=" padding: 15px;">
				<div  style="background-color: #e6e6e6;">	
					<div style="padding:10px 30px;">
			<?php 
				include "news.php";
				?>
				</div>
		</div>
	</div>
</div>
</div>