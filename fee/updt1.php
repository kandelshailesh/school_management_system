<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/javascript" href="style.css" media="screen" />
<link rel="stylesheet" type="text/javascript" href="printerDefault.css" media="print" />
<style>
div.d{background-color:red;}
h1,#name,#class,#roll,#fee,#monthly,#Admission,#Exam,#Miscellanous,#Total,#Received,#Returned,#Remaining{position:absolute;left:250px;width:800px;}
#print{position:absolute;left:500px;top:420px;}
#month,#admission,#exam,#miscellanous,#total,#received,#returned,#remaining{position:absolute;left:680px;}
h2{position:absolute;left:380px;top:130px;width:700px;}
h1{top:100px;}
#name{top:190px;}
#class{top:210px;}
#roll{top:230px;}
#fee{top:250px;}
#month,#monthly{top:270px;}
#Admission,#admission{top:290px;}
#Exam,#exam{top:310px;}
#Miscellanous,#miscellanous{top:330px;}
#Total,#total{top:350px;}
#Received,#received{top:370px;}
#Returned,#returned{top:390px;}
#Remaining,#remaining{top:390px;}
#date{position:absolute;left:630px;top:170px;}
#img{position:absolute;left:680px;top:170px;width:500px;}
</style>
</head>
<body>
<?php 
session_start();
$receive=$_POST["receive"];
$totalfee=$_POST["totalfee"];
$frm=$_POST["from"];
$t=$_POST["to"];
$id=$_SESSION['id'];
$fee=$_SESSION['fee'];
$paidfee=($t+1-$frm)*$fee;
$monthlyfee=$fee;
if(substr($id,0,2)=='st'){

$classs=$_POST["class"];
$examfee=$_POST["examfee"];
$miscellanous=$_POST["miscellanous"];
$dueamount=$totalfee-$paidfee-$examfee-$miscellanous;
}
else{
	$dueamount=$totalfee-$paidfee;
}
$names=$_POST["name"];
$rolls=$_POST["roll"];
$return=$_POST["return"];

$remaining=$_POST["remaining"];


if(substr($id,0,2)=='st'){
if($miscellanous>0)
{
$miscellanous=$miscellanous;
}
else
{
$miscellanous=0;
}
}
echo $frm;
echo $t;
$from=$frm;
$con=mysqli_connect("localhost","root","","sms");
if ($con)
echo "Connected successfully";
while($frm<=$t)
{
	$month="m".$frm;
$table="UPDATE structures set `$month`='Paid',Remaining='$remaining' where user_id='$id'";
$res=mysqli_query($con,$table);
 if($res)
 {
 echo "Updated successfully";
 }
 $frm=$frm+1;
 }
 
 $tab="Select * from structures";
 $result=mysqli_query($con,$tab);
 switch($from)
 {
 case "1":
 $mon="Baisakh";
 break;
 case "2":
 $mon="Jestha";
 break;
 case "3":
 $mon="Ashad";
 break;
 case "4":
 $mon="Shrawan";
 break;
 case "5":
 $mon="Bhadra";
 break;
 case "6":
 $mon="Ashoj";
 break;
 case "7":
 $mon="Kartik";
 break;
 case "8":
 $mon="Mangsir";
 break;
 case "9":
 $mon="Poush";
 break;
 case "10":
 $mon="Magh";
 break;
 case "11":
 $mon="Falgun";
 break;
 default:
 $mon="Chaitra";
 }
 switch($t)
 {
 case "1":
 $mons="Baisakh";
 break;
 case "2":
 $mons="Jestha";
 break;
 case "3":
 $mons="Ashad";
 break;
 case "4":
 $mons="Shrawan";
 break;
 case "5":
 $mons="Bhadra";
 break;
 case "6":
 $mons="Ashoj";
 break;
 case "7":
 $mons="Kartik";
 break;
 case "8":
 $mons="Mangsir";
 break;
 case "9":
 $mons="Poush";
 break;
 case "10":
 $mons="Magh";
 break;
 case "11":
 $mons="Falgun";
 break;
 default:
 $mons="Chaitra";
 }
 
echo $frm;?>
<div id="d" class="d">
<h1>Nava Prabhat English Boarding School</h1>
<h2>Saljandi-4,Rupandehi</h2>
<div id="date">Date:</div>
<div id="img"></div>
<div id="name">Name:<?php echo $names?></div>
<?php if(substr($id,0,2)=='st'){?>
<div id="class">Class:<?php echo $classs?></div><?php } ?>
<div id="roll">USER ID:<?php echo $rolls?></div>
<?php if($frm>0)
{?>
<div id="fee">Paid from:<?php echo $mon?>-<?php echo $mons?></div>
<?php } ?><?php if(substr($id,0,2)=='st'){?>
<div id="monthly">Monthly Fee</div><div id="month">Rs.<?php echo $monthlyfee ?>.00</div>
<div id="Admission">Due Amount</div><div id="admission">Rs.<?php echo $dueamount?>.00 </div> 
<?php if(substr($id,0,2)=='st'){?>
<div id="Exam">Exam Fee</div><div id="exam">Rs.<?php echo $examfee?>.00</div>
<div id="Miscellanous">Miscellanous Fee</div><div id="miscellanous">Rs.<?php echo $miscellanous?>.00</div><?php } ?>
<?php }
else{ ?>
<div id="monthly">Monthly Salary</div><div id="month">Rs.<?php echo $monthlyfee ?>.00</div>
<div id="Admission">Due Amount</div><div id="admission">Rs.<?php echo $dueamount?>.00 </div>

<?php } ?>
<div id="Total">Total</div><div id="total">Rs.<?php echo $totalfee?>.00</div>

<div id="Received">Received Amount</div><div id="received">Rs.<?php echo $receive?>.00</div>
<?php 
if($receive>$totalfee)
{?>
<div id="Returned">Returned Amount</div><div id="returned">Rs.<?php echo $return?>.00</div>
<?php }
else
{?>
<div id="Remaining">Remaining Amount</div><div id="remaining">Rs.<?php echo $remaining?>.00</div>
<?php }?>
</div>
<button id="print" style="width:100px;text-align:center;height:50px;background-color:lightblue;color:white;font-size:20px;border-radius:10px; box-shadow: 10px 10px;" onclick="javascript:printDiv('d')">Print</button>


<script>
var de=new Date();
document.getElementById("img").innerHTML=de.toDateString();
 function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }

 </script>
</body>
</html>