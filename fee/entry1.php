<!doctype html
<html>
<head>
<style> 
input,select,textarea
{
border-radius:10px;
border-color:blue;
text-align:centre;
}

select
{
width:150px;
height:30px;
font-size:20px;
background: linear-gradient(to left, #a80077 , #66ff00);
}
option
{
font-size:30px;
}
#from
{
position:absolute;
left:300px;
top:10px;
}
#scripts
{
position:absolute;
left:300px;
top:30px;
width:250px;
height:40px;
}
#script
{
position:absolute;
left:300px;
top:110px;
width:250px;
height:40px;
}

#to
{
position:absolute;
left:300px;
top:85px;
}
#examfee{position:absolute;left:300px;top:165px;}
#examfeeid{position:absolute;left:300px;top:190px;width:250px;height:40px;}
#miscellanous{position:absolute;left:300px;top:250px;}
#miscellanousid{position:absolute;left:300px;top:275px;width:250px;height:40px;}
#examfee1{position:absolute;left:600px;top:165px;}
#examfeeid1{position:absolute;left:600px;top:190px;width:250px;height:40px;}
#miscellanous1{position:absolute;left:600px;top:250px;}
#miscellanousid1{position:absolute;left:600px;top:275px;width:250px;height:40px;}

#get
{
position:absolute;
left:450px;
top:330px;
width:100px;
height:40px;
}

#post
{
position:absolute;
left:450px;
width:200px;
height:40px;
}
input
{
display:block;
}
#par
{
position:absolute;
left:600px;
top:30px;
width:250px;
}
#m
{
position:absolute;
top:10px;
left:600px;
font-size:20px;
}
#met
{
position:absolute;
top:110px;
left:600px;
width:250px;
}
#n
{
position:absolute;
top:85px;
font-size:20px;
left:600px;
}
option
{
font-size:30px;
}

</style>
</head>
<body style="background: linear-gradient(to left, #f79d00 , #64f38c);">
<?php 
session_start();
$con=mysqli_connect("localhost","root","","sms");

$mo;
$n;
$mon;
$id=$_POST["roll"];
$_SESSION['id']=$id;
if(substr($id,0,2)=='st'){
	$name=$_POST["name"];

$class=$_POST["class"];
	$f=mysqli_query($con,"select * from student_table where student_name='$name' and student_id='$id' and class='$class'");
$fee=mysqli_fetch_array($f);
 $s=$fee['fee'];
 $d=$fee['scholarship'];
 $final=$s-$d;


?>
<form action="updt1.php" method="POST">
<label style="font-size:20px;">NAME</label>
<input type="text" style="width:250px; height:40px; font-size:20px; text-align:center;" readonly="readonly" name="name" value="<?php echo $name?>"><br>
<label style="font-size:20px;">STUDENT ID</label>
<input type="text" style="width:250px; height:40px; font-size:20px; text-align:center;" readonly="readonly" name="roll" value="<?php echo $id?>"><br>
<label style="font-size:20px;">CLASS</label>
<input type="text" style="width:250px; height:40px; font-size:20px; text-align:center;" readonly="readonly" name="class" value="<?php echo $class?>"><br>
<label style=" font-size:20px;">PAYMENT STATUS</label>
<?php }
else {
	if(substr($id,0,2)=='tr'){
	//$id=$_POST["roll"];
	$f=mysqli_query($con,"select * from teacher_table where teacher_id='$id'");
$fee=mysqli_fetch_array($f);
 $final=$fee['salary'];
 $name=$fee['first_name']." ".$fee['last_name'];
 
// $d=$fee['scholarship'];
 //$final=$s-$d;

	
   ?>
   <form action="updt1.php" method="POST">
   <label style="font-size:20px;">NAME</label>
<input type="text" style="width:250px; height:40px; font-size:20px; text-align:center;" readonly="readonly" name="name" value="<?php echo $name?>"><br>
   <label style="font-size:20px;">TEACHER ID</label>
<input type="text" style="width:250px; height:40px; font-size:20px; text-align:center;" readonly="readonly" name="roll" value="<?php echo $id?>"><br>
<label style=" font-size:20px;">PAYMENT STATUS</label>
	<?php }
}
global $final;

$_SESSION['fee']=$final;
 if(substr($id,0,2)=='st'){

 

 }
 if(substr($id,0,2)=='tr'){

 }
if ($con)
echo "";
$i;

$mo="1";
$remaining;
$table="select * from structures where user_id='$id'";
$res=mysqli_query($con,$table);
$mon=mysqli_fetch_assoc($res);
for($i=1;$i<13;$i++)
{ $j="m".$i;
$remaining=$mon['Remaining'];
if($mon[$j]=="Paid")
{
$mo=$i;
//$next=$i+1;

}
}
echo $remaining;
switch($mo)
{
case "1":
 $month="Baisakh";
 break;
 case "2":
 $month="Jestha";
 break;
 case "3":
 $month="Ashad";
 break;
 case "4":
 $month="Shrawan";
 break;
 case "5":
 $month="Bhadra";
 break;
 case "6":
 $month="Ashoj";
 break;
 case "7":
 $month="Kartik";
 break;
 case "8":
 $month="Mangsir";
 break;
 case "9":
 $month="Poush";
 break;
 case "10":
 $month="Magh";
 break;
 case "11":
 $month="Falgun";
 break;
 default:
 $month="January";
 }
?>

<input style="width:250px; height:40px; font-size:20px; text-align:center;" readonly="readonly" type="text" value="Baisakh-<?php echo $month; ?>">
<input type="text" id="hidden" value="<?php echo $mo; ?>" style="display:none;">

<label style="font-size:20px;" id="from" >FROM</label>
<select id="scripts" name="from">
<option value="0">Select</option>
<option value="1">Baisakh</option>
<option value="2">Jestha</option>
<option value="3">Ashad</option>
<option value="4">Shrawan</option>
<option value="5">Bhadra</option>
<option value="6">Ashoj</option>
<option value="7">Kartik</option>
<option value="8">Mangsir</option>
<option value="9">Poush</option>
<option value="10">Magh</option>
<option value="11">Falgun</option>
<option value="12">Chaitra</option>
</select>
<label style="font-size:20px;" id="to">TO</label>
<select id="script" name="to">
<option value="0">Select</option>
<option value="1">Baisakh</option>
<option value="2">Jestha</option>
<option value="3">Ashad</option>
<option value="4">Shrawan</option>
<option value="5">Bhadra</option>
<option value="6">Ashoj</option>
<option value="7">Kartik</option>
<option value="8">Mangsir</option>
<option value="9">Poush</option>
<option value="10">Magh</option>
<option value="11">Falgun</option>
<option value="12">Chaitra</option>
</select>
<label style="font-size:20px;" id="examfee">EXAM FEE</label>
<select id="examfeeid" name="examfee">
<option value="0">0</option>
<option value="300">300</option>
</select>
<label style="font-size:20px;" id="miscellanous" name="miscellanous">MISCELLANOUS</label>
<input type="number" style="font-size:20px;" id="miscellanousid" name="miscellanous">
<label id="m">FEE AMOUNT</label>
<textarea id="par" type="text" style="font-size:20px; height:40px; text-align:center;" readonly="readonly"  name="totalfee"></textarea>
<label id="n">RECEIVED AMOUNT</label>
<textarea id="met" type="text"  style="font-size:20px; text-align:center;  height:40px;" name="receive" ></textarea>
<label id="examfee1">RETURNED AMOUNT</label>
<textarea id="examfeeid1" readonly="readonly" style="font-size:20px; text-align:center; height:40px;" name="return"></textarea>
<label id="miscellanous1">REMAINING AMOUNT</label>
<textarea id="miscellanousid1" readonly="readonly" style="font-size:20px; text-align:center;  height:40px;" name="remaining"><?php echo $remaining ?></textarea>

<input type="button" id="get" value="GET" onclick="javascript:but(<?php echo $final; ?>)">
<input type="submit" style="background: linear-gradient(to left, #c21500 , #ffc500); position:absolute; top:380px;" value="GENERATE PAYSLIP" id="post">
</form>
<script type="text/javascript">
document.getElementById('scripts').value=document.getElementById('hidden').value;
function but(data)
{
var s=document.getElementById("scripts");
var t=document.getElementById("script");
var u=document.getElementById("examfeeid");
var v=document.getElementById("miscellanousid");
var total=t.value-s.value+1;
var other=u.value;
var mis=v.value;
var remaining=document.getElementById("miscellanousid1").value;
document.getElementById("par").value=(total)*data+(other)*"1"+(mis)*"1"+remaining*"1";
var fee=document.getElementById("par").value;
var receive=document.getElementById("met").value;
document.getElementById("examfeeid1").value="0";
var w=receive-fee;
if(w>0)
{
document.getElementById("miscellanousid1").value="0";
document.getElementById("examfeeid1").value=w*"1";
}
else
{
document.getElementById("examfeeid1").value="0";
document.getElementById("miscellanousid1").value=-w;
}
} 
</script>
</body>
</html>