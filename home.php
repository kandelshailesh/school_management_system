<?php
   include "home/bootheader.php";
   include "home/navbar2.php";
      ?>
<?php
session_start(); error_reporting(E_ALL & ~E_NOTICE);
if(!isset($_SESSION['loggedin']))   header("Location:login.php");
 global $ip,$name,$date,$time,$stat,$s_id,$addr,$fat,$mot,$info;
include_once('classes/userconnection.php');
include_once('classes/userclass.php');
   include_once('functions.php');
  
  $info= new UserClass();
  $user=$_SESSION['uname'];
  $user_id=$_SESSION['user_id'];
  
  $stat= $_SESSION['status'];
  $result=$info->GetUserInfo($user);
  $_SESSION['password_changed']=false;
   if($stat=='student'){
  foreach($result as $uinfo)
  {
    //print_r($uinfo);
    $name=$uinfo['username'];
    
    // $ip= $uinfo[''];
     $date= $uinfo['date'];
     $time=$uinfo['time'];
    //$stat= $uinfo['user_status'];
     $s_id= $uinfo['user_id'];
     //$addr=$uinfo['address'];
     // $fat=$uinfo['father'];
      //$mot=$uinfo['mother'];
  }
  
$_SESSION['stat']=$stat;  
   
   $student=new db();
     if(!($info=$student->get_single_std($conn,"student_table",$user_id))){
     echo "Error getting student";
   }
   foreach($info as $val){
     $studentName = $val['student_name'];
      $dob = $val['dob'];
      $gender = $val['gender'];
      $email = $val['email'];
      $phone= $val['phone'];
      $add= $val['address'];
      $status = $val['Status'];
      $year= $val['Year'];
      $class= $val['class'];
      $s_id= $val['student_id'];
    
      $father=$val['father'];
    $mother=$val['mother'];
    $fee=$val['fee'];
    $scholarship=$val['scholarship'];
   }
  
if(isset($_POST['logout'])){
     unset($_SESSION['loggedin']);
  session_destroy();
  
header("Location:index.php");
}

//echo "Welcome  ".$name."<br />";
//echo "Your user_id is ".$user_id." and you enrolled in ".$date." at ".$time." as a ".$stat."."."<br />";
//echo " You live in ".$addr." and your father is ".$fat." and mother is ".$mot.".";
?>

<!--<div class="container" style="background-image: url(images/student1.jpg); background-size: cover; background-repeat: no-repeat; padding-top: 30px; padding-bottom: 300px;">
  <h1>School Management System</h1>
</div>-->
<div class="container">
<img style="padding-top: 50px; position: absolute; left: 0px;
    top: 0px; z-index: -1; width:100%; height:auto;" src="images/stu.jpg"></div>
    <div style="padding-top: 200px;">
<div class="container">

<div class="embed-responsive" style="width:300px; height: 300px;">
    <img src="<?php echo "img/".$user.".jpg"; ?>" class="img-thumbnail" style="height:100%; width: auto;" alt=" <?php echo $studentName; ?>">
    </div>
</div>
</div>
</div>
<!--
<div style="background-color:blue;color:white;" >
<form action="<?php $_PHP_SELF ?>" method="POST">
<input type="submit" name="logout" value="Log Out" />
<br/>
</form>

<form action="routine/index.php" method="POST">
<input type="submit" name="routine" value="View Exam Schedule" />
<br/>
</form>
<form action="<?php $_PHP_SELF ?>" method="POST">
Change Your Password:
<br/>
Enter new Password:   <input type="password" name="cpass" /><br/>
Re-Enter the password:<input type="password" name="acpass" /><br />
<input type="submit" name="changepass" value="change Password" />
</form>
<form action="pdf.php" method="POST">
<input type="submit" name="pdf" value="PDF" />
</form>
<form action="tt/php/index.php" method="POST">
<input type="submit" value="View Time Table" name="tt"/>
</form>
</div>

-->
<div class="container">
  <div class="row">
    <div class="col-sm-4 w3-card-12" style="padding: 20px; margin: 0px 10px;">
      <h2><?php echo $studentName; ?></h2>
      <i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><?php include_once('upd.php'); ?></p>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $stat; ?></i></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $add; ?></i></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $email; ?></i></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $phone; ?></i></p>
          <hr>
           <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Attendance</b></p>
          
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
          </div>
          
    </div>
        <div class="col-sm-4 w3-card-12" style="padding: 20px; margin: 0px 10px;" >
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>About</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b><?php echo $studentName; ?> /<?php echo $stat; ?> </b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $date; ?> <span class="w3-tag w3-teal w3-round"><?php echo $status; ?></span></h6>
          
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Father</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $father; ?></h6>
          
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Mother</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $mother; ?></h6>
          <br>
        </div>
    </div>
     
 
  <div class="col-sm-3 w3-card-12" style="padding: 20px; margin: 0px 10px;">
    

<form action="<?php $_PHP_SELF ?>" method="POST">
<button type="button" class="w3-large w3-blue btn btn-info" data-toggle="collapse" data-target="#demo">Change Password</button><br>
  <div id="demo" class="collapse">
 <input type="password" name="cpass" class="form-control" placeholder="New Password" /><br/>
<input type="password" name="acpass" class="form-control" placeholder="Re-Enter Password"/><br />
<input type="submit" name="changepass" value="change Password" />
</form><br> 
 </div>
<br>

<form action="routine/index2.php" method="POST">
<button  type="submit" name="routine" class="w3-btn w3-large w3-ripple w3-blue"> View Exam Schedule</button>

</form>
<br>
<form action="tt/php/index.php" method="POST">
<!--<input type="submit" value="View Time Table" name="tt"/>-->
<button name="tt" type="submit" class="w3-btn w3-ripple w3-blue w3-large">View Time Table</button>
</form><br>
<form action="marks/reportCardSelector.php" method="GET">
<!--<input type="submit" value="View Time Table" name="tt"/>-->
<button name="marksheet" type="submit" class="w3-btn w3-ripple w3-blue w3-large">Generate My Reportcard</button>
</form>
</div>
  </div>
</div>

<!--
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="<?php echo "img/".$user.".jpg"; ?>" style="width:100%" alt=" <?php echo $studentName; ?>">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2><?php echo $studentName; ?></h2>
          </div>
        </div>
        <div class="w3-container">
		<p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><?php include_once('upd.php'); ?></p>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $stat; ?></i></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $add; ?></i></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $email; ?></i></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $phone; ?></i></p>
          <hr>
-->
         <?php 
          include "home/footer.php";
          ?>
<?php
if(isset($_POST['changepass'])){
	if($_POST['cpass']){
	$newpass=$_POST['cpass'];
	$rnewpass=$_POST['acpass'];
	if($newpass==$rnewpass){
	$conf=$info->ChangePassword($name,$newpass);
	if($conf==1)
	{
		echo "Password Changed";
		$_SESSION['password_changed']=true;
		$_POST=array();
	}
	else{
		echo "Duplicate operation orCouldnot change password! ";
	}
	}
	else{
		echo "Re-password didnot match!"; 
	}
	}
	else{
		echo "Password field is empty!";
	
	}
	
}
   }
   // teacher section
   if($stat=='teacher'){
	foreach($result as $uinfo)
	{
		//print_r($uinfo);
		$name=$uinfo['username'];
		
		// $ip= $uinfo[''];
		 $date= $uinfo['date'];
		 $time=$uinfo['time'];
		//$stat= $uinfo['user_status'];
		 $s_id= $uinfo['s_id'];
		 $addr=$uinfo['address'];
		  $fat=$uinfo['father'];
		  $mot=$uinfo['mother'];
	}
	
$_SESSION['stat']=$stat;	
	

if(isset($_POST['logout'])){
     unset($_SESSION['loggedin']);
	session_destroy();
	
header("Location:login.php");
}

echo "Welcome  ".$name."<br />";
echo "Your user_id is ".$user_id." and you enrolled in ".$date." at ".$time." as a ".$stat."."."<br />";
//echo " You live in ".$addr." and your father is ".$fat." and mother is ".$mot.".";
$teacher=new db();
     if(!($info=$teacher->get_single_teacher($conn,"teacher_table",$user_id))){
		 echo "Error getting student";
	 }
	 foreach($info as $val){
		 $firstName = $val['first_name'];
      $lastName = $val['last_name'];
      $dob = $val['dob'];
      $gender = $val['gender'];
      $email = $val['email'];
      $phone= $val['phone'];
      $degree= $val['degree'];
      $salary= $val['salary'];
      $address= $val['address'];
	  $father=$val['father'];
	  $mother=$val['mother'];
      $id= $val['teacher_id'];
      $us=$firstName." ".$lastName;
	 }
?>

<div class="container">
<img style="padding-top: 50px; position: absolute; left: 0px;
    top: 0px; z-index: -1; width:100%; height:auto;" src="images/stu.jpg"></div>
    <div style="padding-top: 200px;">
<div class="container">

<div class="embed-responsive" style="width:300px; height: 300px;">
    <img src="<?php echo "img/".$user.".jpg"; ?>" class="img-thumbnail" style="height:100%; width: auto;" alt=" <?php echo $us; ?>">
    </div>
</div>
</div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4 w3-card-12" style="padding: 20px; margin: 0px 10px;">
      <h2><?php echo $us; ?></h2>
      <i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><?php include_once('upd.php'); ?></p>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $stat; ?></i></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $us; ?></i></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $email; ?></i></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"><?php echo $phone; ?></i></p>
          <hr>
           <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Attendance</b></p>
          
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
          </div>
          
    </div>
        <div class="col-sm-4 w3-card-12" style="padding: 20px; margin: 0px 10px;" >
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>About</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b><?php echo $us; ?> /<?php echo $stat; ?> </b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $date; ?> <span class="w3-tag w3-teal w3-round"><?php echo $stat; ?></span></h6>
          
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Father</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $father; ?></h6>
          
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Mother</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $mother; ?></h6>
          <br>
        </div>
    </div>
     
 
  <div class="col-sm-3 w3-card-12" style="padding: 20px; margin: 0px 10px;">
    

<form action="<?php $_PHP_SELF ?>" method="POST">
<button type="button" class="w3-large w3-blue btn btn-info" data-toggle="collapse" data-target="#demo">Change Password</button><br>
  <div id="demo" class="collapse">
 <input type="password" name="cpass" class="form-control" placeholder="New Password" /><br/>
<input type="password" name="acpass" class="form-control" placeholder="Re-Enter Password"/><br />
<input type="submit" name="changepass" value="change Password" />
</form><br> 
 </div>
<br>

<form action="routine/index.php" method="POST">
<button  type="submit" name="routine" class="w3-btn w3-large w3-ripple w3-blue"> View Exam Schedule</button>

</form>
<br>
<form action="tt/php/index.php" method="POST">
<!--<input type="submit" value="View Time Table" name="tt"/>-->
<button name="tt" type="submit" class="w3-btn w3-ripple w3-blue w3-large">View Time Table</button>
</form><br>

</div>
  </div>
</div>
<?php
 include "home/footer.php";
 ?>




<?php
if(isset($_POST['changepass'])){
	if($_POST['cpass']){
	$newpass=$_POST['cpass'];
	$rnewpass=$_POST['acpass'];
	if($newpass==$rnewpass){
	$conf=$info->ChangePassword($name,$newpass);
	if($conf==1)
	{
		echo "Password Changed";
	}
	else{
		echo "Coldnot change password!";
	}
	}
	else{
		echo "Re-password didnot match!";
	}
	}
	else{
		echo "Password field is empty!";
	}
	
}
   }
?>
