<?php session_start(); ?>
<?php
include_once("common.php");

// page entry point
if (isset($_POST['add']))
{
    $conn = connect_to_db();
    $act_type = $_POST['type'];
    $classes = $_POST['class'];
    $profs = $_POST['prof'];
    foreach ($classes as $class_name)
    {
        foreach ($profs as $prof_name)
        {
            $query = "SELECT R1.ID AS CLASS_ID, R2.ID AS PROF_ID " .
                "FROM RESOURCES R1, RESOURCES R2 " .
                "WHERE R1.NAME='$class_name' AND R2.NAME='$prof_name'";
//            echo "<p>$query</p>";
            $result = mysql_query($query)
                or die("Can't get resource names!");
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            $class_id = $row['CLASS_ID'];
            $prof_id = $row['PROF_ID'];
            $query = "INSERT INTO ACTIVITIES " .
                "(TT_ID, CLASS_ID, PROF_ID, LENGTH, TYPE) " .
                "VALUES ({$_SESSION['tt_id']}, $class_id, " .
                "$prof_id, 1, '$act_type')";
//            echo "<p>$query</p>";
            mysql_query($query)
                or die ('Error on insert/update');
        }
    }
    echo '<p>Inserted/Updated the new resource data</p>';
    echo "<a href=\"newactivity.php\">";
    echo "New activity...</a>";
    echo "<p><a href=\"manage_tt.php\">";
    echo "Timetable {$_SESSION['tt_name']}</a></p>";
    echo '<p><a href="index.php">Main page</a></p>';
    exit();
}
//debug_dump();
$conn = connect_to_db();
$class_options = 
    get_resources($_SESSION['tt_id'], 'CLASS', -1);
$prof_options =
    get_resources($_SESSION['tt_id'], 'PROF', -1);
print<<<_H
<h2>Timetable - {$_SESSION['tt_name']}</h2>
<p>{$_SESSION['user_name']} is logged in.</p>
$existing
<h3>Activity generator:</h3>
<p>Every selected class on the left will be paired with each selected prof on
the right, and every pair will generate an activity.</p>
<form method="post">
<table>
    <tr>
        <td>Type</td>
        <td><select name="type" id="type"
            onchange="javascript:type_changed()">
            "<option>MANDATORY</option>
            "<option>DESIRABLE</option>
        </select></td>
    </tr>
    <tr>
        <td>Select classes</td>
        <td>Select profs</td>
    </tr>
    <tr>
        <td><select multiple size="20" name="class[]" id="class">
        $class_options
        </select>
        </td>
        <td><select multiple size="20" name="prof[]" id="prof">
        $prof_options
        </select>
        </td>
    </tr>
    <tr>
        <td><input name="add" id="add" type="submit" value="Generate"></td>
        <td><input name="add" id="add" type="reset" value="Reset"
        onclick="javascript:reset_type()">
        </td>
    </tr>
</table>
</form>
<p><a href="manage_tt.php">Timetable {$_SESSION['tt_name']}</a></p>
<p><a href="index.php">Main page</a></p>
_H;
?>
