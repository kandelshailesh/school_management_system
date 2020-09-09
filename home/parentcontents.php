<div id="about" class="container text-center">
	<div class="row">
		
			<div class="col-sm-6 " style="padding: 15px;">
			<div style="background-color: #e6e6e6; ">
					<div style="padding:10px 30px;">
					<p>	<h3>Gunaso Box</h3><h6 style="color:red">*For guardian</h6></p>
							
<div style="padding: 20px;">
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<input type="text" name="pname" size="45" value="" placeholder="Your Name" required /><br><br>

         </div>
<input type="text" name="cname" size="45" value="" placeholder="Your children's name" required /><br><br>

 <textarea name="comment" Value="Comment" rows="5" cols="45"></textarea><br><br>
<input type="submit" name="submit" value="Send" />
</form>
</div>
				
<?php
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
	if (empty($_POST['pname']))
		die('Enter your name.'); 
	else if (empty($_POST['cname']))
		die('Enter your children name'); 
	else if (empty($_POST['comment']))
		die('Enter your gunaso.'); 
	$pname = clear($_POST['pname']); 
	$cname = clear($_POST['cname']); 
	$comment = clear($_POST['comment']); 
	
	mysql_connect('localhost','root','');
	mysql_select_db('sms');
	if(mysql_query("INSERT INTO gunaso (id , ParentName , ChildName , Comment) VALUES ('', '$pname', '$cname', '$comment')"))
		echo 'Your gunaso has been recorded';
	mysql_close(); 
}
?>	
</div>
		

</div>
		<div class="col-sm-6" style="padding:15px;">
			<div style="background-color: #e6e6e6; ">
			<div style="padding: 10px 30px; border-color: black; border-width: 2px;">
			<?php 
				include "news.php";
				?>
				</div>
		</div>
	</div>
</div>
</div>