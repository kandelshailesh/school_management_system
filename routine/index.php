<!-- <!-- <!-- <html>
<head>
<!--

-->

<?php 
session_start();
if(!isset($_SESSION['signup']) and !isset($_SESSION['loggedin'])){
	header("Location:/pro/login.php");
}
include "module/header.php";
include "module/alerts.php";
include "config/connect.php"; 
?>
</head>
<body>

<div class="container">
<?php include "module/nav.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Create Exam Routine</h1>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
	if(isset($_POST['simpan']))
	{  // echo $_POST['date_time'];
	 
	 //echo $rowcount=mysqli_num_rows($chk);
	 $cnt=mysqli_query($con,"SELECT COUNT(*) FROM subject_table where subject_name='".$_POST['name']."' and class='".$_POST['class']."'");
	 $row = mysqli_fetch_assoc($cnt);
$p = $row['COUNT(*)'];
	 //echo $p;
   
        if($p==1){
		if(mysqli_query($con,"INSERT INTO subjects (class, name, date_time) VALUES ('".$_POST['class']."','".$_POST['name']."','".$_POST['date_time']."')")){

		writeMsg('save.sukses');
		}
		else{
            die("Duplicate entry or sth went wrong");
		}
		}
		else{
			
			die("Check class and subject");
		}
	}

?>

	<div class="form-group">
        <label for="sel1">Select Grade:</label>
        <select class="form-control" id="sel1" name="class">
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

	<div class="form-group">
  		<label class="control-label" for="name">Subject Name</label>
  		<!--<input type="text" class="form-control" name="name" id="name" style="
          height: 31px;" required>-->
		  <?php
          $qs=mysqli_query($con,"select * from subject_table" );	
          echo "<select name='name' class='form-control' id='name' style='height:31px;' required >";			
           
          while($stid=mysqli_fetch_row($qs))
          {				
           echo"<option value=$stid[1] >$stid[1] $stid[4]  </option>";
		   
           }
          echo "</select>";

          ?>
	</div>

	<div id="datetimepicker" class="form-group" class="input-append date">
  		<label class="control-label" for="date_time">Date</label>
  		<input type="datetime-local" class="form-control" name="date_time" id="date_time" style="
          height: 31px;">
  		<span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
	</div>
		  
    <!--<script type="text/javascript">
      $('#datetimepicker').datetimepicker({

        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-En'

      });
    </script>-->

<!-- 
  <div id="datetimepicker" class="input-append date">
      <input type="text"></input>
      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
    </div>
 -->


	<div class="form-group">
	<input type="submit" value="submit" name="simpan" class="btn btn-primary">
	<input type="reset" value="Reset" class="btn btn-danger">
	</div>

	</form>
	</div>
</div>

</div>
<?php include "module/footer.php"; ?>
</body>
</html> 