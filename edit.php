<?php
	include "home/bootheader.php";
	include "home/navbar.php";
?>
<div class="container" style="padding: 50px; padding-left: 200px;padding-right: 200px;">

<?php
error_reporting(E_ALL ^ E_DEPRECATED);
function clear($message)
{
	if(!get_magic_quotes_gpc())
		$message = addslashes($message);
	$message = strip_tags($message);
	$message = htmlentities($message);
	return trim($message);
}
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