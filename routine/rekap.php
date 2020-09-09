<html>
<head>
<!--
Project Name : CRUD with PHP, MySQL and Bootstrap
Author		 : Hendra Setiawan
Website		 : http://www.hendrasetiawan.net
Email	 	 : hendrabpp[at]gmail.com
-->
<?php  session_start();
error_reporting(E_ALL & ~E_NOTICE);
include "module/header.php";
include "module/alerts.php";
include "config/connect.php"; 

$sql =mysqli_query($con,"SELECT id, name, class, date_time FROM subjects ORDER BY class ASC");
$sqs=mysqli_query($con,"SELECT id, name, class, date_time FROM subjects where class={$_GET['search']} ORDER BY class ASC");
?>
<script type="text/javascript">
window.apex_search = {};
apex_search.init = function (){

	this.rows = document.getElementById('data').getElementsByTagName('TR');
	this.rows_length = apex_search.rows.length;
	this.rows_text =  [];
	for (var i=0;i<apex_search.rows_length;i++){
        this.rows_text[i] = (apex_search.rows[i].innerText)?apex_search.rows[i].innerText.toUpperCase():apex_search.rows[i].textContent.toUpperCase();
	}
	this.time = false;
}
apex_search.lsearch = function(){

	this.term = document.getElementById('S').value.toUpperCase();

	for(var i=0,row;row = this.rows[i],row_text = this.rows_text[i];i++){
		row.style.display = ((row_text.indexOf(this.term) != -1) || this.term  === '')?'':'none';
	}
	this.time = false;
}
apex_search.search = function(e){
    var keycode;
    if(window.event){keycode = window.event.keyCode;}
    else if (e){keycode = e.which;}
    else {return false;}
    if(keycode == 13) { apex_search.lsearch(); } else { return false; }
}
</script>

</head>

<body onload="apex_search.init();">
<div class="container">
<?php include "module/nav.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Routine List </h1>
        </div>
    </div>
</div>

<p>
<div class="row">
<div class="col-lg-4">
   <div class="input-group">
   <style> 
#search[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}
#search[type=text]:focus {
    width: 100%;
}
</style>
<form method="get" action="rekap.php?class="<?php $_GET['search']; ?>">
  <input type="text" name="search" id="search" placeholder="Search..">
</form>
	<!--<input type="text" size="30" class="form-control" maxlength="1000" value="" id="S" onkeyup="apex_search.search(event);" />
	<span class="input-group-btn">
	<input   type="button" class="btn btn-default" value="Search" onclick="apex_search.lsearch(); style="
    height: 32px;"/>
	</span>-->
	</div>
</div>

<div class="col-lg-4">
    <form action='export.php' method="POST">
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
	         <button type="submit" value="submit" name="simpan" class="btn btn-success"> <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Export to Excel </button> 
	    </div>

    </form>
     <!-- <a href="export.php" class="btn btn-success"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Export to Excel</a> -->
</div>
</div>

<br />

<div class="row">
	<div class="col-md-12">
	<p>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="5%"><center>NO</center></th>
					<th>Subjects</th>
					<th>DateTime</th>
					<th>Class</th>
					<th width="15%"><center>ACTION</center></th>
				</tr>
			</thead>
			<tbody id="data">
			<?php  if(isset($_GET['search'])){
                    $no=1;
             			while ($row = mysqli_fetch_array($sqs)) { ?>
				<tr>
					<td align="center"><?php echo $no; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['date_time']; ?></td>
					<td><?php echo $row['class']; ?></td>
					<td align="center">
					<a href="edit.php?id=<?php echo $row['id']; ?>">update</a> 
					| 
					<a href="del.php?id=<?php echo $row['id']; ?>" onclick ="if (!confirm('Are you sere to delete?')) return false;">delete</a>
					</td>
				</tr>
			<?php $no++; }
			}
             else{

			$no=1;
             			while ($row = mysqli_fetch_array($sql)) { ?>
				<tr>
					<td align="center"><?php echo $no; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['date_time']; ?></td>
					<td><?php echo $row['class']; ?></td>
					<td align="center">
					<a href="edit.php?id=<?php echo $row['id']; ?>">update</a> 
					| 
					<a href="del.php?id=<?php echo $row['id']; ?>" onclick ="if (!confirm('Are you sere to delete?')) return false;">delete</a>
					</td>
				</tr>
			<?php $no++; } 
			 }
			 ?>	
			</tbody>
		</table>
	</p>	
	</div>
</div>	

</div>
<?php include "module/footer.php"; ?>
</body>
</html>
