<?php
session_start();
include_once("common.php");

function sign_up()
{
    $conn = connect_to_db();
    if ($_POST['pass'] != $_POST['pass2'])
    {
        echo "<p>You specified different passwords!</p>";
        return 0;
    }
    $query = "SELECT * FROM USERS WHERE NICK='{$_POST['user']}'";
    $result = mysqli_query($conn,$query)
        or die ('Can\'t get users!');
    if (mysqli_num_rows($result) != 0)
    {
        echo "<p>User <b>{$_POST['user']}</b> already exists!</p>";
        return 0;
    }
    $pass_md5 = md5($_POST['pass']);
    $query = "INSERT INTO USERS (NICK, PASS) " .
        "VALUES ('{$_POST['user']}', '$pass_md5')";
    mysqli_query($conn,$query)
        or die("Can't register user");
		$query = "SELECT * FROM USERS WHERE NICK='{$_POST['user']}'";
    $result = mysqli_query($conn,$query)
        or die ('Can\'t get users!');
		$_SESSION['user_id']=$query['ID']; 
		
    return 1;
}

if (isset($_POST['signup']))
{
    if (sign_up())
    {
        $_SESSION['user_name'] = $_POST['user'];
        print<<<_H
        <p>User {$_POST['user']} has been registered.</p>
        <p><a href="index.php">Start</a> using your account.</p>
_H;
        exit();
    }
}

print<<<_H
<h3>Sign up</h3>
<form method="post">
<table>
<tr>
<td>User:</td>
<td><input id="user" name="user" type="text"></td>
</tr>
<tr>
<td>Password:</td>
<td><input id="pass" name="pass" type="password"></td>
</tr>
<tr>
<td>Confirm password:</td>
<td><input id="pass2" name="pass2" type="password"></td>
</tr>
<tr>
<td><input id="signup" name="signup" type="submit" value="Sign up"></td>
</tr>
</table>
</form>
<p>You don't have an account? <a href="signup.php">Sign up</a> now!</p>
_H;
?>
