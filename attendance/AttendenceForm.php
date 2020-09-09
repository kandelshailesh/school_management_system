<?php 
session_start();
 $pagetitle="AttendenceForm";
  include "includes/header.php"; ?>
 <div class="container">
              <div class="row">
                 <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Attendance Form</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                  </div>
                </div>
<?php  
error_reporting(E_ALL ^ E_DEPRECATED);
include("config.php");
if(isset($_POST['filter']) || isset($_SESSION['class'])){
?>
<div class="form-container">
    <form method="post" action="saveattendence.php" role="form">
     <!-- <div class="container"> -->
     <div class="col-lg-3">
      <div class="form-group">
<?php
//echo $_POST['filter'];
if(isset($_POST['filter'])){
    $_SESSION['class']=$_POST['class'];
	//echo $_POST['filter'];
	
	$class=$_POST['class'];
}
else{
	$class= $_SESSION['class'];
}
      $qs=mysql_query("select * from student_table where class='$class'");
      ?>
      <?php	
      echo "<select class='form-control' name='stid' >";			
      while($stid=mysql_fetch_row($qs))
      {				
       echo"
       <option value=$stid[1]>$stid[12] </option>";
       }
      echo "</select>"."<br>";
      ?>
      </div>
      </div> <!--col-lg-4-->
       <div class="col-lg-3">
      <?php
      $qs1=mysql_query("select * from subject_table");	
      echo "<select class='form-control' name='subjid'>";			
      while($subjid=mysql_fetch_row($qs1))
      {				
       echo"
       <option value=$subjid[0]>$subjid[1] </option>";
       }
      echo "</select>";?>
      </div> <!--col-lg-4-->
      <input type="radio" name="present" value="P" />Present
      <input type="radio" name="present" value="A" />Absent
      <button type="submit" name="save" value="Save" class="btn btn-success btn-sm">Save</button>
   
 </form>
 </div> <!--form-container-->
</div><!--container-->
<?php 
}
else{?>
<form action='AttendenceForm.php' method="POST">
    <div class="form-group">
          
           <select   required id="class" name="class" >
           <option>-------select-------</option>
           <option value='1'>1</option>
           <option value="2">2</option> 
		   <option value='3'>3</option>
           <option value="4">4</option> 
		   <option value='5'>5</option>
           <option value="6">6</option> 
		   <option value='7'>7</option>
           <option value="8">8</option> 
		   <option value='9'>9</option>
           <option value="10">10</option> 
           </select>
          </div>
		  <button type="submit" name="filter" value="Filter">All Students</button>
</form>
<?php
}
 include "includes/footer.php"; ?>