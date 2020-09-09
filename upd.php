
<?php
error_reporting(E_ALL & ~E_NOTICE);
 error_reporting(E_ALL ^ E_DEPRECATED);
if (isset($_REQUEST['upload']))
{
$name=$_FILES['uploadvideo']['name'];
//$name=$_SESSION['uname'];
 $type=$_FILES['uploadvideo']['type'];
 //$type="";
//$size=$_FILES['uploadvideo']['size'];
//$cname=str_replace(" ","_",$name);
$cname='img/'.$_SESSION['uname'].'.jpg';
//$cname=str_replace(" ","_",$name);
//$tmp_name=$_FILES['uploadvideo']['tmp_name'];
//$tmp_name=$_SESSION['uname'];
$target_path="img/";
 $target_path=$target_path.basename($cname);
//$target_path=$target_path.$_SESSION['uname'];
if(move_uploaded_file($_FILES['uploadvideo']['tmp_name'],$target_path))
{mysql_connect("localhost",$_SESSION['status'],$_SESSION['status']);
$db=mysql_select_db("sms");
 $sql="INSERT INTO tbl_img(name,type) VALUE('".basename($cname)."','".$type."')"; 
$result=mysql_query($sql);
 "Your image ".basename($cname)." has been successfully uploaded";
}
}
?>
<form name="video" enctype="multipart/form-data" method="post" action="">
<input name="MAX_FILE_SIZE" value="100000000000000"  type="hidden"/>
<input type="file" name="uploadvideo" />
<input type="submit" name="upload" value="UPLOAD PROFILE PIC" />
</form>