<?php session_start(); ?>

<script language="javascript" src="../js/res_act_mng.js">
</script>

<script language="javascript">
function type_changed()
{
    new_type = document.getElementById('type').value;
    size_row = document.getElementById('size-row');
    if (new_type == 'CLASS' || new_type == 'ROOM')
    {
        size_row.style.display = 'table-row';
    }
    else
    {
        size_row.style.display = 'none';
    }
}
function reset_type()
{
    document.getElementById('type').value = 'PROF';
    type_changed();
}
</script>

<?php
include_once("common.php");
if(isset($_SESSION['signup'])){
	$_SESSION['uname']='Admin';
}
// page entry point
$conn = connect_to_db();
if (isset($_POST['add']))
{
    $avl = "";
    $res_type = $_POST['type'];
    $res_name = $_POST['name'];
    $res_size = $_POST['size'];
    if ($res_size == '' || $res_type == 'PROF')
    {
        $res_size = 0; // size doesn't matter
    }
    $query = "INSERT INTO RESOURCES " .
             "(TT_ID, TYPE, NAME, AVL, SIZE) " .
             "VALUES ({$_SESSION['tt_id']}, '$res_type', " .
                     "'$res_name', '$avl', $res_size)";
    mysqli_query($conn,$query)
        or die ('Error on insert');
    echo '<p>Inserted the new resource data</p>';
    echo "<a href=\"newresource.php\">";
    echo "New resource...</a>";
    echo "<p><a href=\"manage_tt.php\">";
    echo "Timetable {$_SESSION['tt_name']}</a></p>";
    echo '<p><a href="index.php">Main page</a></p>';
    exit();
}
$existing = "<h3>Existing resources:</h3>";
$existing .= get_defined_resources($_SESSION['tt_id'], $conn);
print<<<_H
<h2>Timetable - {$_SESSION['tt_name']}</h2>
<p>{$_SESSION['uname']} is logged in.</p>
$existing
<h3>Resource data:</h3>
<a href="resgen.php">use automatic generator</a><br><br>
<form method="post" action="newresource.php">
<table>
    <tr>
        <td>Type</td>
        <td><select name="type" id="type"
            onchange="javascript:type_changed()" >
			
        <option>CLASS</option>
        <option>ROOM</option>
        </select></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input name="name" id="name" type="text"></td>
    </tr>
    <tr id="size-row">
        <td>Size</td>
        <td><input name="size" id="size" type="text"></td>
    </tr>
    <tr>
        <td><input name="add" id="add" type="submit" value="Add"></td>
        <td><input name="add" id="add" type="reset" value="Reset"
        onclick="javascript:reset_type()"></td>
    </tr>
</table>
</form>
<p><a href="manage_tt.php">Timetable {$_SESSION['tt_name']}</a></p>
<p><a href="index.php">Main page</a></p>
_H;
?>
