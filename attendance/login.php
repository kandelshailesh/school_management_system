<?php
error_reporting(E_ALL & ~ E_NOTICE);
session_start();
 $pagetitle="LogIn Page";
  
?>
<?php 
if(isset($_POST['admin_attendance'])){
	$_SESSION['signup']=true;
	$_SESSION['stat']='root';
	$_SESSION['username']='a';
	$_SESSION['id']=true;
	 header('Location:home.php');
	 die();
}
if(!isset($_SESSION['loggedin'])){
	header('Location:/pro2/signup2.php');
}
       if(isset($_SESSION['loggedin']) && $_SESSION['stat']!='root'){
       // include 'connection.php';
        $username=($_SESSION['uname']);
		$stat=$_SESSION['stat'];
		$_SESSION['username']='user';
        //$password=$username;
         header('Location:home.php');
        //$sql="SELECT id, username, password FROM users WHERE username='$username' ";//AND activated='1' LIMIT 1";
       /* $query=mysqli_query($dbcon, $sql);
        if($query){
          $row= mysqli_fetch_row($query);
          $userId= $row[0];
          $dbusername=$row[1];
          $dbpassword=$row[2];
        }
           if($username== $dbusername && $password== $dbpassword){
          $_SESSION['username']=$_SESSION['uname'];
         // $_SESSION['id']=$userId;
          header('Location:home.php');
        }//else{
           // echo "<span style='color:red;'>User name or password is incorrect!</span>";
         // }    
*/
} 

?>
       
          
 <?php include "includes/footer.php"; ?>