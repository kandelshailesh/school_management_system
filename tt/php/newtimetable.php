<?php
session_start();
include_once("common.php");

// page entry point
if (isset($_POST['add']))
{  $_SESSION['user_id'] =1;
    $conn = connect_to_db();
    $query = "INSERT INTO TIMETABLES " .
             "(USER_ID, NAME, DAYS, INTERVALS, " .
             "INTERVAL_START, INTERVAL_LENGTH, INTERVAL_GAP, DAY_NAMES) " .
             "VALUES ({$_SESSION['user_id']}, '{$_POST['name']}', " .
                     "{$_POST['days']}, {$_POST['intervals']}, 0, 0, 0, '')";
    mysqli_query($conn,$query)
        or die ('Error on insert');
    echo '<p>Inserted the new timetable data</p>';
    echo '<a href="index.php">Main page</a>';
    exit();
}

print<<<_H
<h2>Timetable</h2>
<p>{$_SESSION['user_name']} is logged in.</p>
<h3>New timetable data</h3>
<form method="post">
<table>
    <tr>
        <td>Timetable name</td>
        <td><input name="name" id="name" type="text"></td>
    </tr>
    <tr>
        <td>Timespan (days)</td>
        <td><input name="days" id="days" type="text"></td>
    </tr>
    <tr>
        <td>Number of intervals per day</td>
        <td><input name="intervals" id="intervals" type="text"></td>
    </tr>
    <tr>
        <td><input name="add" id="add" type="submit" value="Add"></td>
        <td><input name="add" id="add" type="reset" value="Reset"></td>
    </tr>
</table>
</form>
<a href="index.php">Main page</a>
_H;
?>


