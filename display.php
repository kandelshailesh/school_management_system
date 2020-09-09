<html>
<head>
<title>News</title>
</head>
<body style="background-color:khaki;"> 
<?php

error_reporting(E_ALL ^ E_DEPRECATED);
$con=mysqli_connect('localhost','root','','sms');
//mysqli_select_db('sms');
 


//echo 'SELECT * FROM news ORDER BY id DESC limit 3';
if(isset($_POST['all'])){
	$query = mysqli_query($con,'SELECT * FROM news ORDER BY id DESC');
}
else{
$query = mysqli_query($con,'SELECT * FROM news ORDER BY id DESC limit 3');
}

while($result = mysqli_fetch_assoc($query))
{
	echo $result['subject'].'<br />';
	echo $result['news'].'<br / >';
	echo 'Date:'. $result['date'].'<br / >';
	echo 'Posted by '.$result['postedby'];
	echo '<hr />'; 
	
}

if(!isset($_POST['all'])){
?>
<div >
<form action="display.php" method='post'>
<input type="submit" name="all" value="View All" />

</form>

<div >
<?php 
}
else{ ?>
<div >
<form action="login.php" method='post'>
<input type="submit" name="back" value="Back" />

</form>

<div >
<?php } ?>

<!--<form action="<?php //echo $_SERVER["PHP_SELF"];?>" method='post'>
<input type="submit" name="previous" value="Prev" />
</form>-->
</div>
</body>
</html>