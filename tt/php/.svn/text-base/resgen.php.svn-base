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
    preview_results();
}
function reset_type()
{
    document.getElementById('type').value = 'PROF';
    type_changed();
}
function preview_results()
{
    type = document.getElementById('type').value;
    prefix = document.getElementById('prefix').value;
    suffix = document.getElementById('suffix').value;
    idx_start = document.getElementById('idx_start').value;
    idx_stop = document.getElementById('idx_stop').value;
    include_type = document.getElementById('include_type').checked;
    preview = "";
    for (i = idx_start; i <= idx_stop; i++)
    {
        if (include_type)
        {
            preview += type+"_"+prefix+i+suffix+" ";
        }
        else
        {
            preview += prefix+i+suffix+" ";
        }
    }
    document.getElementById('preview').innerHTML = preview;
}
</script>

<?php
include_once("common.php");

// page entry point
$conn = connect_to_db();
if (isset($_POST['add']))
{
    $avl = "";
    $res_type = $_POST['type'];
    $res_prefix = $_POST['prefix'];
    $res_suffix = $_POST['suffix'];
    $res_idx_start = $_POST['idx_start'];
    $res_idx_stop = $_POST['idx_stop'];
    $res_size = $_POST['size'];
    $res_include_type = $_POST['include_type'];
    for ($i = $res_idx_start; $i <= $res_idx_stop; $i++)
    {
        if ($res_include_type == 'yes')
        {
            $res_name = 
                $res_type . '_' . $res_prefix . $i . $res_suffix;
        }
        else
        {
            $res_name = $res_prefix . $i . $res_suffix;
        }
        if ($res_size == '' || $res_type == 'PROF')
        {
            $res_size = 0; // size doesn't matter
        }
        $query = "INSERT INTO RESOURCES " .
            "(TT_ID, TYPE, NAME, AVL, SIZE) " .
            "VALUES ({$_SESSION['tt_id']}, '$res_type', " .
            "'$res_name', '$avl', $res_size)";
        mysql_query($query)
            or die ('Error on insert');
    }
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
<p>{$_SESSION['user_name']} is logged in.</p>
$existing
<h3>Resource Generator:</h3>
<a href="newresource.php">manually specify resources</a><br><br>
Preview:<br>
<div id="preview">
</div>
<form method="post" action="resgen.php">
<table>
    <tr>
        <td>Type</td>
        <td><select name="type" id="type"
            onchange="javascript:type_changed()">
        <option>PROF</option>
        <option>CLASS</option>
        <option>ROOM</option>
        </select></td>
    </tr>
    <tr>
        <td>Prefix</td>
        <td><input name="prefix" id="prefix" type="text"
            onkeyup="javascript:preview_results()"></td>
    </tr>
    <tr>
        <td>Index start</td>
        <td><input name="idx_start" id="idx_start" type="text"
            onkeyup="javascript:preview_results()"></td>
    </tr>
    <tr>
        <td>Index stop</td>
        <td><input name="idx_stop" id="idx_stop" type="text"
            onkeyup="javascript:preview_results()"></td>
    </tr>
    <tr>
        <td>Suffix</td>
        <td><input name="suffix" id="suffix" type="text"
            onkeyup="javascript:preview_results()"></td>
    </tr>
    <tr style="display: none" id="size-row">
        <td>Size</td>
        <td><input name="size" id="size" type="text"></td>
    </tr>
    <tr>
        <td><input name="include_type" id="include_type" type="checkbox"
            onchange="javascript:preview_results()"
            value="yes"></td>
        <td>Include type in name?</td>
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
