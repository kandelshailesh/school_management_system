<?php

include_once('connection.php');
//include_once('userconnection.php');
class ManageUsers{
  public $link;
function __construct(){
	$db_connection=new dbConnection();
	$this->link=$db_connection->connect();
	return $this->link;
} 
function RegisterStudent($username,$password,$user_id,$time,$date,$us,$s_id,$s_roll_no,$dob,$gender,$email,$phone,$addr,$status,$year,$class,$fat,$mot,$sname,$fee,$scholarship){
	$counts=0;
	
	$query=$this->link->prepare("INSERT INTO users (username,password,user_id,time,date,user_status) VALUES (?,?,?,?,?,?)");
	$values=array($username,$password,$user_id,$time,$date,$us);
	$query->execute($values);
	$count1 = $query->rowCount();
	
	$query=$this->link->prepare("INSERT INTO student_table(student_id,std_roll_no,dob,gender,email,phone,address,Status,Year,class,father,mother,student_name,fee,scholarship) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$values=array($s_id,$s_roll_no,$dob,$gender,$email,$phone,$addr,$status,$year,$class,$fat,$mot,$sname,$fee,$scholarship);
	$query->execute($values);
	$count2=$query->rowCount();
	
	$query=$this->link->prepare("INSERT INTO structures(user_id,Name,m1,m2,m3,m4,m5,m6,m7,m8,m9,m10,m11,m12,Remaining) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$values=array($user_id,$sname,'Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','0');
	$query->execute($values);
	$count3=$query->rowCount();
	
	//echo $count2;
	//die();
	if($count1==1 && $count2==1 && $count3==1){
		$counts=1;
	}
	else{
		$counts=0;
		echo "Unable to register";
		//die();
	}
	
	return $counts;
}
function RegisterTeacher($username,$password,$user_id,$time,$date,$us,$tr_id,$fname,$lname,$dob,$gender,$email,$phone,$degree,$salary,$address,$father,$mother){
	$counts=0;
	
	$query=$this->link->prepare("INSERT INTO users (username,password,user_id,time,date,user_status) VALUES (?,?,?,?,?,?)");
	$values=array($username,$password,$user_id,$time,$date,$us);
	$query->execute($values);
	$count1 = $query->rowCount();
	$name=$fname." ".$lname;
	
	
	
	
	
	$query=$this->link->prepare("INSERT INTO resources (TT_ID,TYPE,NAME,AVL,SIZE) VALUES (?,?,?,?,?)");
	$values=array('2','PROF',$name,"",'0');
	$query->execute($values);
	$count2 = $query->rowCount();
	$query=$this->link->prepare("select * from resources where NAME='$name'" );
	$query->execute();
	//$count=$query->rowCount();
	$prof=$query->fetchAll();
	foreach($prof as $backup){
		$res_id=$backup['ID'];
	}
	$query=$this->link->prepare("INSERT INTO teacher_table (teacher_id,first_name,last_name,dob,gender,email,phone,degree,salary,address,res_id,father,mother) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$values=array($tr_id,$fname,$lname,$dob,$gender,$email,$phone,$degree,$salary,$address,$res_id,$father,$mother);
	$query->execute($values);
	$count3=$query->rowCount();
	//echo $name;
	//echo $user_id;
	$query=$this->link->prepare("INSERT INTO structures(user_id,Name,m1,m2,m3,m4,m5,m6,m7,m8,m9,m10,m11,m12,Remaining) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$values=array($user_id,$name,'Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','Not Paid','0');
	$query->execute($values);
	$count4 = $query->rowCount();
	//echo $count2;
	//die();
	if($count1==1 && $count2==1 && $count3==1 && $count4==1){
		$counts=1;
	}
	else{
		$counts=0;
		echo "Unable to register";
		//die(); 
	}
	
	return $counts;
}
function admin($user,$pass){
	$query=$this->link->prepare("select * from admin");
	$query->execute();
	$count=$query->rowCount();
	$check=$query->fetchAll();
	foreach($check as $view){
		$userc=$view['username'];
		$passc=$view['password'];
	}
	if($count==1 && $user==$userc && $pass==$passc){
		return $count;
	}
	else{
		die("Invalid username or password.");
	}
}
function GetUserInfo($user){
	$query=$this->link->prepare("select * from users where username='$user'");
	$query->execute();
	$count=$query->rowCount();
	if($count!=0){
		return 1;
		}
	else{
		return 0;
	}
	
	
	
}
function GetLoginUserInfo($user){
	$query=$this->link->prepare("select * from users where username='$user'");
	$query->execute();
	$count=$query->rowCount();
	if($count ==1){
		return $query->fetchAll();
		}
	else{
		return 0;
	}
	
	
	
}
function Check($class,$roll){
	$query=$this->link->prepare("select * from student_table where class='$class' and std_roll_no='$roll'");
	$query->execute();
	$count=$query->rowCount();
	 if($count!=0){
		 return 1;
	 }
	else{
		return 0;
	}
}
}
?>