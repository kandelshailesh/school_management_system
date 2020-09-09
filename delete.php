<html>
<head>
<title>Delete</title>
<script type="text/javascript">
function check(id){
	if (confirm("Are you sure you want to delete this news item?"))
		this.location.href = "?id="+id;
}</script>
</head>
<body>
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
</body>
</html>