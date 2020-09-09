
  <?php 
  session_start();
  //echo $_SESSION['status'];
   $pagetitle="Update Student's Record";
  include "includes/header.php"; ?>


<?php $db = new db(); 
global $roll_no; 
?>


  <?php 
    if (isset($_POST['update'])):
      
      $studentName = $_POST['name'];
      $dob = $_POST['dob'];
      $gender = $_POST['gender'];
      $email = $_POST['email'];
      $phone= $_POST['phone'];
      $add= $_POST['add'];
      $status = $_POST['Status'];
      $year= $_POST['Year'];
      $class= $_POST['class'];
      $s_id= $_GET ['student_id'];
	  
      $father=$_POST['fat_name'];
	  $mother=$_POST['mot_name'];
	  $fee=$_POST['fee'];
	  $scholarship=$_POST['scholarship'];
      if($db->update_std($conn,$s_id,$roll_no,$dob,$gender,$email,$phone,$add,$status, $year, $class,$father,$mother,$studentName,$fee,$scholarship)){
      $status= "Student's Information Updated Successfully";
      }
	  else{
	  $status= "Couldn't update Student's Information";
	  }
     ?>
     <?php endif ?> 

     <?php 
        $std_id = array();
        if (isset($_GET['student_id'])) {
			 $std_id=$_GET['student_id'];
          //$std_id = $_GET['std_roll_no'];
        }
       ?>

<div class="container">
    
        <?php 
		//echo $std_id;
            $update = $db->get_single_std($conn,"student_table",$std_id);
			
			
        
          foreach ($update as $key) { ?>

             
                <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Updating Student</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
                <?php if (isset($status)): ?>

      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $status; ?>
      </div>


    <?php endif ?> 

<div class="form-container">

    <form method="post" role="form" action="student_update.php?student_id=<?php echo $key['student_id']; $roll_no=$key['std_roll_no']; ?>">
       
       <div class="container">
           <div class="row">
           <div class="col-lg-4">

          <div class="form-group">
            <label for="name"> Student Name(*) </label>
            <input type="text" name="name" class="form-control"  value="<?php echo $key['student_name']; ?>" required id="name" placeholder="student Name" >
          </div>
          </div>
           
           <div class="col-lg-4">
          <div class="form-group">
            <label for="dob"> Date Of Birth </label>
            <input type="date" name="dob" class="form-control" value="<?php echo $key['dob']; ?>" id="dob" >
          </div>
          </div>
        </div>
        </div> <!-- col-container-->
       
        <div class="container">
           <div class="row">

        <div class="col-lg-4">
          <div class="form-group">
          <label for="gender">Gender(*)</label>
           <select class="form-control" name="gender"  required id="gender" >
           
           <option><?php echo $key['gender']; ?> </option>
           <option value="male">Male</option>
           <option value="female">Female</option> 
           </select>
          </div>
        </div>
          <!-- </div> -->
          <!-- <div class="col-lg-6 push-right">  -->
        <div class="col-lg-4">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $key['email']; ?>" required id="email" placeholder=" Email" >
          </div>
       </div>
       </div>
       </div><!-- col-container-->

      <div class="container">
       <div class="row">
       <div class="col-lg-4">
        <div class="form-group">
            <label for="phone">Phone </label>
            <input type="text" name="phone" class="form-control" value="<?php echo $key['phone']; ?>" id="phone" placeholder="Phone Number" >
          </div>
       </div>
       <div class="col-lg-4">
          <div class="form-group">
            <label for="add">Address</label>
            <textarea name="add" class="form-control"  id="add" placeholder="Your address please" rows="3" ><?php echo $key['address']; ?></textarea>
          </div>
       </div>
       </div>
     </div><!-- col-container-->
      <div class="container">
       <div class="row">
       <div class="col-lg-4">
      <div class="form-group">
            <label for="session" >Active/Inactive</label>
            <select  class="form-control" name="Status"  required id="Status"  value="<?php echo $key['Status']; ?>" >
          <option><?php echo $key['Status']; ?></option>
           <option >Enrolled</option>
           <option >Not Enrolled</option>
           
           </select>
        </div>
        </div>
          <div class="col-lg-4">
          <div class="form-group">
          <label for="program"  class="col-sm-2 control-label">Year</label>
           <select  class="form-control" name="Year"  required id="Year" name="Year"  value="<?php echo $key['Year']; ?>" >
          <option><?php echo $key['Year']; ?></option>
           <option >2017</option>
           <option >2018</option>
           <option >2019</option>
           <option >2020</option>
           <option >2021</option>
           </select>
          </div>  
          </div>
        </div>
          </div>

          <div class="col-lg-4">
          <div class="form-group">
          <label for="semester"  class="col-sm-2 control-label">Class</label>
           <select  class="form-control" name="class"  required id="class"  value="<?php echo $key['class']; ?>"  >
           <option><?php echo $key['class']; ?></option>
           <option>1</option>
           <option>2</option>
           <option>3</option> 
           <option>4</option>
           <option>5</option>
           <option>6</option>
           <option>7</option>
           <option>8</option>
		   <option>9</option>
		   <option>10</option>
           </select>
          </div>  
          </div>
		  
		  <div class="container">
           <div class="row">
           <div class="col-lg-4">

          <div class="form-group">
            <label for="fat_name"> Father's Name </label>
            <input type="text" name="fat_name" class="form-control"  value="<?php echo $key['father']; ?>" required id="fat_name" placeholder="father Name" >
          </div>
          </div>
           
           <div class="col-lg-4">
          <div class="form-group">
            <label for="mot_name"> Mother's Name </label>
            <input type="text" name="mot_name" class="form-control" value="<?php echo $key['mother']; ?>" id="mot_name" >
          </div>
          </div>
        </div>
        </div> <!-- col-container-->
		
		<div class="container">
           <div class="row">
           <div class="col-lg-4">

          <div class="form-group">
            <label for="fee"> Fee </label>
            <input type="text" name="fee" class="form-control"  value="<?php echo $key['fee']; ?>" required id="fee" placeholder="fee amount" >
          </div>
          </div>
           
           <div class="col-lg-4">
          <div class="form-group">
            <label for="dob"> Scholarship Awarded </label>
            <input type="text" name="scholarship" class="form-control" value="<?php echo $key['scholarship']; ?>" id="scholarship" >
          </div>
          </div>
        </div>
        </div> <!-- col-container-->
          <div "form-actions"> <br><br>
          <div class="ui mini buttons col-sm-offset-3 col-sm-3">
          <button type="submit" class="ui mini positive button" name="update">Update</button>
          <div class="or"></div>
          <a href="student.php" type="submit" class="ui mini button" name="back">Back</a>
          </div>
          </div>
		 
       </form>
   <?php }
   ?>
          </div>
     </div><!--container-->	 
<?php include "includes/footer.php"; ?>