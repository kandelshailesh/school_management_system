
  <?php 
  session_start();
   $pagetitle="Update Subject's Record";
  include "includes/header.php"; ?>


<?php $db = new db(); ?>


  <?php 
    if (isset($_POST['update'])):
      
	   $subName = $_POST['name'];
      $teacher= $_POST['tname'];
      $type = $_POST['copt'];
      $class= $_POST['class'];
	   $rollno= $_GET['subject_no'];
	  
     

      if($db->update_sub($conn,$subName,$teacher,$type,$class,$rollno)){
      $status= "Subject's Information Updated Successfully";
      }
	  else{
		  $status="Couldn't update subject's information or unauthorized access";
	  }
     ?>
     <?php endif ?> 

     <?php 
        $sub_id = array();
        if (isset($_GET['subject_no'])) {
          $sub_id = $_GET['subject_no'];
		  //echo $sub_id;
        }
       ?>
 
<div class="container">
    
        <?php 
            $update = $db->get_single_sub($conn,"subject_table",$sub_id);
        ?>
          <?php foreach ($update as $key) { ?>


                <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Updating Subject</span>
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

    <form method="post" role="form" action="subject_update.php?subject_no=<?php echo $key['subject_no']; ?>">
       <div class="container">
           <div class="row">
           <div class="col-lg-4">

          <div class="form-group">
            <label for="name"> Subject Name(*) </label>
            <input type="text" name="name" class="form-control"  value="<?php echo $key['subject_name']; ?>" required id="name" placeholder="subject Name" >
          </div>
          </div>
           
           <div class="col-lg-3">
          <div class="form-group">
            <label for="dob"> Teacher's Name</label>
            <select  class="form-control" name="tname"  required id="tname" name="tname"  value="<?php echo $key['teacher_name']; ?>" >
          <option>Amit Patel</option>
           <option >Mahesh Sharma</option>
           </select>
          </div>
          </div>
        </div>
        </div> <!-- col-container-->
       
        <div class="container">
           <div class="row">

        
          <!-- </div> -->
          <!-- <div class="col-lg-6 push-right">  -->
        <div class="col-lg-4">
          <div class="form-group">
            <label for="copt">Compulsory/Optional</label>
             <select  class="form-control" name="copt"  required id="copt" name="copt"  value="<?php echo $key['COpt']; ?>" >
          <option>Compulsory</option>
           <option >Optional</option>
		   </select>
          </div>
       </div>
       
     
      

          <div class="col-lg-3">
          <div class="form-group">
          <label for="class"  class="col-sm-2 control-label">Class</label>
           <select  class="form-control" name="class"   id="class"  value="<?php echo $key['class']; ?>"  >
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
		</div>
       </div><!-- col-container-->  

          <div "form-actions"> <br><br>
          <div class="ui mini buttons col-sm-offset-3 col-sm-3">
          <button type="submit" class="ui mini positive button" name="update">Update</button>
          <div class="or"></div>
          <a href="subject.php" type="submit" class="ui mini button" name="back">Back</a>
          </div>
          </div>
		  
       </form>
   <?php } ?>
          </div>
          </div>
<?php include "includes/footer.php"; ?>