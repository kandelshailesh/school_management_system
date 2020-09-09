<?php session_start();

//if((!isset($_SESSION['loggedin']))| (!isset($_SESSION['signup'])))
	//header("Location:/pro/login.php");
?>
<?php
include_once("common.php");

function fetch_user_timetables($conn)
{
    $query = "SELECT * FROM TIMETABLES";
    $result = mysqli_query($conn,$query)
        or die ('Can\'t get timetables!');
    $timetables = '';
    if (mysqli_num_rows($result) == 0)
    {
        $timetables = 'You have defined no timetables<br>';
        return $timetables;
    }
    $timetables .= "<h3>Your timetables:</h3><ol>";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $tt_id = $row['ID'];
        $tt_name = $row['NAME'];
        $tt_days = $row['DAYS'];
        $timetables .= "<li>";
        $timetables .= "<a href=\"manage_tt.php?id=$tt_id&name=$tt_name\">";
        $timetables .= $tt_name;
        $timetables .= "</a>";
        $timetables .= "- spans $tt_days days</li>";
    }
    $timetables .= "</ol>";
    return $timetables;
}

function validate_user($conn)
{
    $pass_md5 = md5($_POST['pass']);
    $query = "SELECT * FROM USERS WHERE NICK='{$_POST['user']}'";
//    echop($query);
    $result = mysqli_query($conn,$query)
        or die ('Can\'t get users!');
    $failure_msg = "Username and password do not match!";
    if (mysqli_num_rows($result) == 0)
    {
        echop($failure_msg);
        return 0;
    }
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row['PASS'] == $pass_md5)
    {
         $_SESSION['user_name'] = $row['NICK'];
        $_SESSION['user_id'] = $row['ID'];
        return 1;
    }
    else
    {
        echop($failure_msg);
        return 0;
    }
}

/*if (isset($_GET['signout']))
{
    unset($_SESSION['user_name']);
}
*/
$conn = connect_to_db();
//dump_var($_POST);
/*if (isset($_POST['signin']))
{
    if (validate_user($conn))
    {
        header("Location: index.php");
    }
}

if (!isset($_SESSION['user_name']))
{
    print<<<_H
    <h3>Login</h3>
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
        <td><input id="signin" name="signin" type="submit" value="Sign in"></td>
    </tr>
    </table>
    </form>
    <p>You don't have an account? <a href="signup.php">Sign up</a> now!</p>
_H;
    exit();
}
*/
// page entry point
$timetables = fetch_user_timetables($conn);
print<<<_H
<h2>Timetable</h2>

$timetables
<a href="newtimetable.php">new timetable...</a>
<br><br>

_H;

?>
<a href="/pro/home.php">Home</a>
