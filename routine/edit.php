<html>
<head>
<!--
Project Name : CRUD with PHP, MySQL and Bootstrap
Author		 : Hendra Setiawan
Website		 : http://www.hendrasetiawan.net
Email	 	 : hendrabpp[at]gmail.com
-->
<?php 
session_start();
include "module/header.php";
include "module/alerts.php";
include "config/connect.php"; 

$sql = mysqli_query($con,"SELECT id, name, class, date_time FROM subjects WHERE id = '".$_GET['id']."'");
$data = mysqli_fetch_array($sql);

?>
</head>
<body>

<div class="container">
<?php include "module/nav.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Update Routine</h1>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['update']))
{
	mysqli_query($con,"UPDATE subjects SET class = '".$_POST['class']."', name = '".$_POST['name']."', date_time = '".$_POST['date_time']."' WHERE id = '".$_GET['id']."'");
	writeMsg('update.sukses');

	//Re-Load Data from DB
	$sql = mysqli_query($con,"SELECT id, class, name, date_time FROM subjects WHERE id = '".$_GET['id']."'");
	$data = mysqli_fetch_array($sql);
}
?>
   
<!-- HELLO -->
		<div class="form-group">
        <label for="sel1">Select Grade:</label>
        <select class="form-control" id="sel1" name="class">
        
        <?php
        $array =['1','2','3','4','5','6','7','8','9','10']; 
        foreach ($array as $value) {
        	
        	if($value == $data['class']){
        		echo '<option selected>'.$value.'</option>';
        	}
        	echo '<option value='.$value.'>'.$value.'</option>';
        }
        ?>
          
        </select>
    </div> 

	<div class="form-group">
  		<label class="control-label" for="name">Subject Name</label>
  		<input type="text" class="form-control" name="name" id="name" value="<?php echo $data['name']?>" 
  		 style="
          height: 31px;" required>
	</div>

	<div id="datetimepicker" class="form-group" class="input-append date">
  		<label class="control-label" for="date_time">DateTime</label>
  		<input type="datetime-local" class="form-control" name="date_time" min="today" id="date_time" value="<?php echo $data['date_time']?>" style="
          height: 31px;">
  		<span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
	</div>
		  
   <!-- <script type="text/javascript">
      $('#datetimepicker').datetimepicker({

        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-En'

      });
    </script>-->

	<div class="form-group">
	<input type="submit" value="Update" name="update" class="btn btn-primary">
	<a href="rekap.php" class="btn btn-danger">Cancel</a>
	</div>

	</form>
	</div>
</div>

</div>
<?php include "module/footer.php"; ?>
</body>
</html>