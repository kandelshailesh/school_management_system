<?php
	include "home/bootheader.php";
	include "home/navbar.php";
?>
<div class="container-fluid" style="padding: 70px;">
<div class="row">
	<div class="col-sm-4 w3-card-2">
<h2 style="text-align: center;">Add News</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>"> 
    <div class="form-group">
      <label>Posted By:</label>
      <input type="Text" class="form-control" name="postedby" placeholder="Enter Username" id="postedby" maxlength="50">
    </div>

    <div class="form-group">
      <label>Subject:</label>
      <input type="Text" class="form-control" name="subject" placeholder="Enter subject" id="subject" maxlength="200">
    </div>

    <div class="form-group">
      <label>News:</label>
      <textarea type="textarea" class="form-control" name="news" placeholder="Write here" id="news" rows="10" maxlength="5000"></textarea> 
    </div>

    
       <input type="Submit" name="submit" id="submit" value="Enter News">
   

	</form><?php
error_reporting(E_ALL ^ E_DEPRECATED);
function clear($message)
{
	if(!get_magic_quotes_gpc())
		$message = addslashes($message);
	$message = strip_tags($message);
	$message = htmlentities($message);
	return $message;
}
if (isset($_POST['submit']) && !empty($_POST['submit']))
{ 
	if (empty($_POST['postedby']))
		die('Enter a name.'); 
	else if (empty($_POST['subject']))
		die('Enter a subject.'); 
	else if (empty($_POST['news']))
		die('Enter an article.'); 
	$postedby = clear($_POST['postedby']); 
	$subject = clear($_POST['subject']); 
	$news = clear($_POST['news']); 
	$date = date("Y:m:d");
	mysql_connect('localhost','root','');
	mysql_select_db('sms');
	if(mysql_query("INSERT INTO news (id , postedby , news , subject , date) VALUES ('', '$postedby', '$news', '$subject', '$date')"))
		echo 'News Entered.';
	mysql_close(); 
}
?></div>
<div class="col-sm-4 w3-card-2">
	<h2 style="text-align: center;">Edit News</h2>

	<?php
error_reporting(E_ALL ^ E_DEPRECATED);

mysql_connect('localhost','root','');
mysql_select_db('sms');
if(!isset($_GET['id']) && empty($_GET['id']))
{
	$query = mysql_query("SELECT * FROM news ORDER BY id DESC");
	echo 'Edit<hr />';
	while($result = mysql_fetch_assoc($query))
		echo $result['subject'].' &raquo; <a href="?id='.$result['id'].'">Edit</a><br />';
	   // global $sub;
		//$sub=$result['subject'];
}
else
{
	if (isset($_POST['submit']) && !empty($_POST['submit']))
	{
		$postedby = clear($_POST['postedby']); 
		$subject = clear($_POST['subject']); 
		$news = clear($_POST['news']); 
		$date = date("Y:m:d"); 
		$id = $_GET['id']; 
		mysql_query("UPDATE news SET postedby='$postedby', news='$news', subject='$subject', date='$date' WHERE id='$id'");
		mysql_close();
		echo 'News Edited.';
	}
	else
	{
		$id = $_GET['id']; 
		$query = mysql_query("SELECT * FROM news WHERE id='$id'");
		$result = mysql_fetch_assoc($query);
?>
<form method="post" action="?id=<?php echo $result['id']; ?>"> 

Editing <?php echo $result['subject']; ?><hr />
Posted By:<input name="postedby" id="postedby" type="Text" size="50" maxlength="50" value="<?php echo $result['postedby']; ?>"><br />
Subject:<input name="subject" id="subject" type="Text" size="50" maxlength="50" value="<?php echo $result['subject']; ?>"><br />
News:<textarea name="news" cols="50" rows="5"><?php echo $result['news']; ?></textarea><br />
<input type="Submit" name="submit" value="Enter information">
</form>
<?php }} ?>
</div>
<div class="col-sm-4 w3-card-2">
	<h2 style="text-align: center;">Delete News</h2>
	
	<script type="text/javascript">
function check(id){
	if (confirm("Are you sure you want to delete this news item?"))
		this.location.href = "?id="+id;
}</script>

<?php
//$_GET['id']=false;
error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect('localhost','root','');
mysql_select_db('sms');
if(!isset($_GET['id']) && empty($_GET['id']))
{
	$query = mysql_query('SELECT * FROM news ORDER BY id DESC');
	while($result = mysql_fetch_assoc($query)) 
		echo $result['subject'].' &raquo; <a href="#" onclick="check('.$result['id'].'); return false;">Delete</a><br />';
}
else
{
	$id = $_GET['id']; 
	mysql_query("DELETE FROM news WHERE id = $id LIMIT 1"); 
	echo 'News Deleted.';
}
?>

</div>
</div></div>
<?php 
	include "home/footer.php";
	?>