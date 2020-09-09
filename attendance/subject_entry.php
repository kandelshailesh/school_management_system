
<?php
session_start();
 $pagetitle="Entering Subjects Detail In This Page ";
 include "includes/header.php"; 
 error_reporting(E_ALL ^ E_DEPRECATED);
 ?>

 <?php 
    if (isset($_POST['saved'])) {
    
      $subName = $_POST['subject'];
     echo $teacher= $_POST['teacher'];
      $Copt = $_POST['COpt'];
      $class= $_POST['class'];

      $db = new db();

      if($db->subject_entry($conn,$subName,$teacher,$Copt,$class)){
      echo "Succesfully Saved";
      }
      else{
        echo "unable to Save.";
      }
    }

	
	
     ?>  
 
<div class="container">

               <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Subject's Entry</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
                

<div class="form-container">

    <form action="#" method="post" role="form">
    <div class="container">
    <div class="row">
          <div class="col-lg-4">

          <div class="form-group">
            <label for="subject" >Subject's Name </label>
           <select  class="form-control" required id="subject" name="subject">
           <option>Select subject</option>
           <option >English</option>
           <option >Math</option>
           <option >Science</option>
           <option >EPH</option>
           <option >Others</option>
           </select>
          </div>
          </div>
    
          <div class="col-lg-3">

          <div class="form-group">
          <label for="COpt" >Field</label>
           <select  class="form-control" required id="COpt" name="COpt">
           <option>Select field</option>
           <option >Compulsory</option>
           <option >Optional</option>
           
           </select>
          </div>
          </div>

         </div><!--col-row-->
          </div><!--col-container-->
           <div class="container">
          <div class="row">
          <div class="col-lg-4">

          <div class="form-group">
            <label for="class" >Class</label>
           <select  class="form-control" required id="class" name="class">
           <option>Select class</option>
           <option >1</option>
           <option >2</option>
           <option >3</option> 
           <option >4</option>
           <option >5</option>
           <option >6</option> 
           <option >7</option>
           <option >8</option>
		   <option >9</option>
		   <option >10</option>
           </select>
          </div>
          </div>
           
		   
		   
      
         <div class="col-lg-3">

          <div class="form-group">
          <label for="teacher" >Teacher Name</label>
		  <?php
		  $con=mysql_connect('localhost','root','');
		  mysql_select_db('sms');
           $qs=mysql_query("select * from teacher_table" );	
          echo "<select name='teacher' class='form-control' required id='teacher' >";			

          while($tid=mysql_fetch_array($qs))
          {				
           echo "<option  name='teacher' >".$tid['first_name']." ".$tid['last_name']." </option>";
           }
          echo "</select>";
		  ?>
		  
          </div>
          </div>
      </div>
      </div>

          <div class="ui mini buttons col-sm-offset-3 col-sm-3">
          <button type="submit" class="ui mini positive button" name="saved">Register</button>
          <div class="or"></div>
          <button type="reset" class="ui mini red button" name="back">Clear</button>
          </div>
      
  </form>
 </div><!--form-container-->
 </div> <!--container-->
   
<?php 

           
           
include "includes/footer.php"; ?>
