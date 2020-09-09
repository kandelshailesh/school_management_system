<?php
	include "home/bootheader.php";
	include "home/navbar2.php";
?>
<div class="container-fluid" style="background-image: url(images/banner.jpg); text-align: center;"><div style="padding: 30px; padding: 60px 0px;">
<h2 style="padding-top: 40px; color:#f9f9f9; font-family: Georgia, serif; letter-spacing: 0.05em; font-size: 200%;"> WELCOME USER</h2>
	</div>
</div>
<?php
include_once('classes/connection.php');
	include_once('classes/manageuser.php');
	
	$sign=new ManageUsers();
	$user=$_POST['admin'];
	$passw=$_POST['apassword'];
	$entry=$sign->admin($user,$passw);
if($entry==1){
	session_start();
	$_SESSION['signup']=true;
	?>

	<div class="container">
	<div class="row" style="padding: 50px;">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
	<div style="align-items: center;">
	<form action="admin.php" method="POST">
	
	<label for="stat">Type of user:</label><br>
<select name="user_status" id="stat" class="form-control" Placeholder="Type of user" style="margin-left: auto; margin-right: auto;">
  <option>student</option>
  <option >teacher</option>
  
  
</select>
<br>
<input type="submit"  class="w3-blue form-control" value="Start Registration" name="start_reg" style="margin-left: auto; margin-right: auto;"/><br>
	</form>
	</div>
</div>
<div class="col-sm-4">
	
</div>
</div>
	<div class="row" style="padding: 10px;">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-4">

	
	
	<div class="btn-group-vertical">
    
<form action="attendance/login.php" method="POST">
    <button type="submit buttton" name="admin_attendance" class="btn-lg btn btn-primary form-control">Attendance</button>
    </form>
    <a href="marks/StudentSelection.php">
    <button type="button" class="btn-lg btn btn-primary form-control">Marksheet</button>
    </a>
    <a href="routine/index.php">
    <button type="button" class="btn-lg btn btn-primary form-control">Routine</button>
  </a>
  </div>
  </div>
  <div class="col-sm-4">
  <div class="btn-group-vertical">
<a href="add.php">
    <button type="button" class="btn-lg btn btn-primary form-control">News</button>
  </a>
  <a href="fee/login.html">
    <button type="button" class="btn-lg btn btn-primary form-control">Fee</button>
  </a>
  <a href="tt/php/index.php">
    <button type="button" class="btn-lg btn btn-primary form-control">Time Table</button>
  </a>
  </div>
</div>
  <div class="col-sm-2">
  	
  </div>
  </div>
<!--
		<div class="col-sm-4" style="padding: 20px;">
		<form action="attendance/login.php" method="POST">
	
	
			<a href="attendance/login.php" type="submit" name="admin_attendance" ><img src="images/act/attendance.png" style="width:120px; height: auto;">
			</a></form>
		</div>
		<div class="col-sm-4" style="padding: 20px;">
			<img src="images/act/fee.png" style="width:120px; height: auto;">
			</a>
		</div>
<div class="col-sm-4" style="padding: 20px;">
		<a href="add.php">	<img  src="images/act/edit
		news.png" style="width:120px; height: auto;">
			</a>
			
		</div>
			</div>

	<div class="row" style="padding: 50px;">
		<div class="col-sm-4" style="padding: 20px;">
			<a href="marks/StudentSelection.php"><img src="images/act/marksheet.png" style="width:120px; height: auto;">
			</a>
		</div>
		<div class="col-sm-4" style="padding: 20px;">
			<a href="routine/index.php"><img src="images/act/routine.png" style="width:120px; height: auto;">
			</a>
		</div>
<div class="col-sm-4" style="padding: 20px;">
			<a href="tt/php/index.php"><img src="images/act/time.png" style="width:120px; height: auto;">
			</a>
		</div>
			</div>
<!--
	<form action="attendance/login.php" method="POST">
	<input type="submit" name="admin_attendance" value="Update View Delete Section" />
	</form>
	<form action="tt/php/index.php" method="POST">
	<input type="submit" name="admin_tt" value="Time Table">
	</form>
	<form action="add.php" method="POST">
	<input type="submit" name="add_news" value="Add News">
	</form>
	<form action="edit.php" method="POST">
	<input type="submit" name="edit_news" value="Edit News">
	</form>
	<form action="delete.php" method="POST">
	<input type="submit" name="edit_news" value="Delete News">
	</form>
	<form action="fee/login.html" method="POST">
	<input type="submit" name="fee" value="Fee/Salary">
	</form>
-->
</div>
<div class="col-sm-4">
	
</div>
	<?php 
	
} 
else{
	echo "Invalid username or password.";
	?>
	<form action="login.php" method="POST">
	<input type="submit" name="retry" value="Retry!">
	</form>
	<?php
}
?>
</div>

<div class="container-fluid"></div>
<?php
	include "home/footer.php";
	?>
	</div>
