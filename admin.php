<?php
	include "home/bootheader.php";
	include "home/navbar.php";
?> 
<?php
session_start();
$_SESSION['user_stat']=$_POST['user_status'];
if(isset($_SESSION['signup']) && isset($_POST['start_reg']))
{   //echo $_POST['user_status'];  $username,$password,$hsh,$time,$date,$_SESSION['user_stat'],$hsh,$_$_POST['roll_no'],$_$_POST['dob'],$_POST['gender'],$_POST['emmail'],$_POST['phone'],$_POST['address'],$_POST['status'],$_POST['year'],$_POST['class'],$_POST['fat'],$_POST['mot'],$_POST['sname']
	if($_POST['user_status']=='student'){ ?>
	<div class="container" style="padding:50px;padding-left:250px; padding-right:250px;">
	<h4>Register Here</h4>
<form action="register.php" method="POST">
    <div class="form-group">
      <label>Username:</label>
      <input type="username" class="form-control" name="username" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label >Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label>Confirm-Password:</label>
      <input type="password" class="form-control" name="repassword" placeholder="Re-Enter password"></div>

    <div class="form-group">
      <label>Class:</label>
      <input type="number" min="1" max="10" class="form-control" name="class" placeholder="Enter Class"></div>

      <div class="form-group">
      <label >Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Email"></div>

      <div class="form-group">
      <label for="dob">Date of Birth: </label>
      <input type="Date" class="form-control" name="dob" placeholder="Enter Date of Birth"></div>


      <div class="form-group">
      <label for="roll">Roll No.: </label>
      <input type="number" class="form-control" name="roll_no" placeholder="Enter roll no."></div>


      <div class="form-group">
      <label for="addr">Address: </label>
      <input type="text" class="form-control" name="address" placeholder="Enter Address"></div>


      <div class="form-group">
      <label for="fName">Father Name: </label>
      <input type="text" class="form-control" name="fat" placeholder="Enter Father Name"></div>


      <div class="form-group">
      <label for="mName">Mother Name: </label>
      <input type="text" class="form-control" name="mot" placeholder="Enter Mother Name"></div>


      <div class="form-group">
      <label for="sname">Student Name: </label>
      <input type="text" class="form-control" name="sname" placeholder="Enter Student Name"></div>


      <div class="form-group">
      <label for="phone">Phone: </label>
      <input type="text" class="form-control" name="phone" placeholder="Enter phone no."></div>


      <div class="form-group">
      <label for="feeAmt">Fee Amount: </label>
      <input type="text" class="form-control" name="fee" placeholder="Enter Fee Amount"></div>


      <div class="form-group">
      <label for="scholarship">Scholarship: </label>
      <input type="text" class="form-control" name="scholarship" placeholder="Enter scholership"></div>


      <div class="form-group">
      <label for="status">Status:  </label>
      <select  name="status"  />
<option>Enrolled</option>
<option>Not Enrolled</option>
</select></div>


     <div class="form-group">
      <label for="gender">Gender: </label><br>
      <input type="radio" name="gender" value="male"> Male<br>
      <input type="radio" name="gender" value="female"> Female<br>
  	  <input type="radio" name="gender" value="other"> Other</td>
	 </div>
	
    <button type="submit" name="reg_student" class="btn btn-default">Submit Query</button>
</form>
</div>
<?php
	}
	else if($_POST['user_status']=='teacher'){

		?>
<div class="container" style="padding:50px;padding-left:250px; padding-right:250px;">
		   <form action="register.php" method="POST">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="username" class="form-control" name="username" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="Confirmpwd">Confirm-Password:</label>
      <input type="password" class="form-control" name="repassword" placeholder="Re-Enter password"></div>

   

      <div class="form-group">
      <label for="dob">Date of Birth: </label>
      <input type="Date" class="form-control" name="dob" placeholder="Enter Date of Birth"></div>

      <div class="form-group">
      <label for="addr">Address: </label>
      <input type="text" class="form-control" name="address" placeholder="Enter Address"></div>


      <div class="form-group">
      <label for="fName">Father Name: </label>
      <input type="text" class="form-control" name="fat" placeholder="Enter Father Name"></div>


      <div class="form-group">
      <label for="mName">Mother Name: </label>
      <input type="text" class="form-control" name="mot" placeholder="Enter Mother Name"></div>


      <div class="form-group">
      <label for="sname">First Name: </label>
      <input type="text" class="form-control" name="fname" placeholder="Enter First Name"></div>

       <div class="form-group">
      <label for="sname">Last Name: </label>
      <input type="text" class="form-control" name="lname" placeholder="Enter Last Name"></div>


      <div class="form-group">
      <label for="phone">Phone: </label>
      <input type="text" class="form-control" name="phone" placeholder="Enter phone no."></div>

       <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Email"></div>

       <div class="form-group">
      <label for="degree">Degree:</label>
      <input type="text" class="form-control" name="degree" placeholder="Degree"></div>




      <div class="form-group">
      <label for="feeAmt">Salary: </label>
      <input type="text" class="form-control" name="salary" placeholder="Enter Salary Amount"></div>


     <div class="form-group">
      <label for="gender">Gender: </label><br>
      <input type="radio" name="gender" value="male"> Male<br>
      <input type="radio" name="gender" value="female"> Female<br>
  	  <input type="radio" name="gender" value="other"> Other</td>
	 </div>
	
    <button type="submit" name="reg_teacher" class="btn btn-default">Submit Query</button>
 </form>
		<?php
	}
	
	
		
	
}
else{
	header("Location:login.php");
}
?>