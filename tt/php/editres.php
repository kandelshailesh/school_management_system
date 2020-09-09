<?php session_start(); 
error_reporting(E_ALL & ~E_NOTICE);

?>
<script language="javascript" src="../js/res_act_mng.js">
</script>

<?php
include_once("common.php");
if (isset($_GET['delete']))
{    $row_cnt=0;
    $res_id = $_GET['delete'];
    $conn = connect_to_db();
	
	$query = "SELECT * FROM RESOURCES WHERE ID=$res_id AND TYPE='PROF'";
	$res=$result=mysqli_query($conn,$query)
        or die("Can't delete resource");
		
		$row_cnt=mysqli_num_rows($res);
		if($row_cnt!=0){
			die("Can't delete resource");
		}
		
    $query = "DELETE FROM RESOURCES WHERE ID=$res_id";
    mysqli_query($conn,$query)
        or die("Can't delete resource");
		
	
    $query = "DELETE FROM ACTIVITIES " .
        "WHERE CLASS_ID=$res_id OR PROF_ID=$res_id";
    mysqli_query($conn,$query)
        or die("Can't delete associated activities");
    $query = "DELETE FROM SCHED_ACTIVITIES " .
        "WHERE CLASS_ID=$res_id OR PROF_ID=$res_id OR ROOM_ID=$res_id";
    mysqli_query($conn,$query)
        or die("Can't delete associated scheduled activities");
		
    echo "deleted resource";
    print<<<_H
<p><a href="manage_tt.php">Timetable {$_SESSION['tt_name']}</a></p>
<p><a href="index.php">Main page</a></p>
_H;
    exit();
}
if (isset($_POST['avl']))
{
    $res_id = $_POST['id'];
    $res_avl = $_POST['avl'];
    $conn = connect_to_db();
    $query = "UPDATE RESOURCES SET AVL='$res_avl' " .
        "WHERE ID=$res_id";
//    echo "<p>$query</p>";
    mysqli_query($conn,$query)
        or die("Can't update! - try again later");
//          or die(mysqli_error($conn));
    echo "<i>saved</i>";
    exit();
}
if (isset($_POST['add']))
{
    $conn = connect_to_db();
    $res_name = $_POST['name'];
    $res_type = $_POST['type'];
    $res_size = $_POST['size'];
    if ($res_size == '' || $res_type == 'PROF')
    {
        $res_size = 0; // size doesn't matter
    }
    $res_id = $_POST['id'];
    $query = "UPDATE RESOURCES " .
        "SET NAME='$res_name', TYPE='$res_type', SIZE=$res_size " .
        "WHERE ID=$res_id";
//    echo "<p>$query</p>";
    mysqli_query($conn,$query)
        or die("Can't update resource");
}
?>

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
function toggle_one(day, interval)
{
    elId = 'int_'+day+'_'+interval;
    el = document.getElementById(elId);
    if (el.innerHTML == 'Available')
    {
        el.style.background = '#FF0000';
        el.innerHTML = 'Not Available';
    }
    else
    {
        el.style.background = '#00FF00';
        el.innerHTML = 'Available';
    }
    document.getElementById('update').style.display = 'inline';
    document.getElementById('saved').innerHTML = '';
}

function toggle_more(day1, day2, int1, int2)
{
    for (day = day1; day <= day2; day++)
    {
        for (interval = int1; interval <= int2; interval++)
        {
            toggle_one(day, interval);
        }
    }
}
function clear_all(day1, day2, int1, int2)
{
    for (day = day1; day <= day2; day++)
    {
        for (interval = int1; interval <= int2; interval++)
        {
            elId = 'int_'+day+'_'+interval;
            el = document.getElementById(elId);
            el.style.background = '#00FF00';
            el.innerHTML = 'Available';
        }
    }
    document.getElementById('update').style.display = 'inline';
    document.getElementById('saved').innerHTML = '';
}

function create_http_request() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}

var http_avl = create_http_request();

function handle_request_avl()
{ 
    if(http_avl.readyState == 4){
        document.getElementById('update').style.display = 'none';
        document.getElementById('saved').innerHTML =
            http_avl.responseText;
    }
}

function send_req(http, url, content, handler)
{
    http.open('post', url);
    http.onreadystatechange = handler;
    var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
    http.setRequestHeader("Content-Type", contentType);
    http.send(content);
}

function send_changes(days,intervals,res_id)
{
    content = ':';
    for (day = 1; day <= days; day++)
    {
        for (interval = 1; interval <= intervals; interval++)
        {
            elId = 'int_'+day+'_'+interval;
            el = document.getElementById(elId);
            if (el.innerHTML == 'Available')
            {
                content += day+','+interval+';';
            }
        }
    }
    content = 'id='+res_id+'&avl='+content;
    send_req(http_avl, 'editres.php', content, handle_request_avl);
    document.getElementById('saved').innerHTML = "saving...";
}
function confirm_delete_resource(id)
{
    msg = "Are you sure you want to delete resource?";
    if (confirm(msg))
    {
        location = "editres.php?delete="+id;
    }
}
</script>

<?php

function adjust_avl($avl, $days, $intervals)
{
    if ($avl == "")
    {
        $avl = ":";
        for($i = 1; $i <= $days; $i++)
        {
            for($j = 1; $j <= $intervals; $j++)
            {
                $avl .= "$i,$j;";
            }
        }
    }
    return $avl;
}

function make_avl_tbl($avl)
{
    $result = array();
    $avl = substr($avl, 1);
    $avl_items = explode(';', $avl);
    for ($i = 0; $i < count($avl_items); $i++)
    {
        list($day,$int) = explode(',',$avl_items[$i]);
        $result["$day,$int"] = 1;
    }
    return $result;
}
//debug_dump();
if (!isset($_GET['id']) && !isset($_SESSION['res_id']))
{
    echo '<a href="index.php">Main page</a>';
    exit();
}
if (isset($_GET['id']))
{
    $_SESSION['res_id'] = $_GET['id'];
}
$conn = connect_to_db();
$query = "SELECT * FROM RESOURCES WHERE ID={$_SESSION['res_id']}";
//echo "<p>$query</p>";
$result = mysqli_query($conn,$query)
    or die("Can't get resource");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$res_id = $row['ID'];
$res_name = $row['NAME'];
$res_avl = $row['AVL'];
$res_size = $row['SIZE'];
$res_type = $row['TYPE'];
if ($res_type == 'PROF')
{
    $size_disp = 'none';
}
else
{
    $size_disp = 'table-row';
}
$types = array('PROF','CLASS', 'ROOM');
$html_types = "";
foreach ($types as $type)
{   
    if ($type == $res_type)
    {
        $html_types .= "<option selected>$type</option>";
    }
    else
    {
        $html_types .= "<option>$type</option>";
    }

}

$query = "SELECT * FROM TIMETABLES WHERE ID={$_SESSION['tt_id']}";
//echo "<p>$query</p>";
$result = mysqli_query($conn,$query)
    or die("Can't get timetable");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$tt_days = $row['DAYS'];
$tt_intervals = $row['INTERVALS'];
$res_avl = adjust_avl($res_avl, $tt_days, $tt_intervals);
$avl_tbl = make_avl_tbl($res_avl);

print<<<_H
<script language="javascript">
function res_type()
{
    return '$res_type';
}
function res_name()
{
    return '$res_name';
}
function days()
{
    return '$tt_days';
}
function intervals()
{
    return '$tt_intervals';
}
</script>
_H;

$existing = "<h3>Existing resources:</h3>";
$existing .= get_defined_resources($_SESSION['tt_id'], $conn);
print<<<_H
<p><a href="index.php">Main page</a></p>
<h2><a href="manage_tt.php">Timetable {$_SESSION['tt_name']}</a>
- Editing resource $res_type $res_name</h2>
_H;
if($res_type!='PROF'){print<<<_H
$existing
<hr width="50%" align="left">
<h3>Resource data</h3>
<p><a href="javascript:confirm_delete_resource($res_id)">
delete resource</a></p>
<form method="post" action="editres.php">
<table>
    <tr>
        <td>Type</td>
        <td><select name="type" id="type"
            onchange="javascript:type_changed()">
        $html_types
        </select></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input name="name" id="name"
        type="text" value="$res_name"></td>
    </tr>
    <tr style="display: $size_disp" id="size-row">
        <td>Size</td>
        <td><input name="size" id="size"
        type="text" value="$res_size"></td>
    </tr>
    <input name="id" id="id" type="hidden" value="$res_id">
    <tr>
        <td><input name="add" id="add" type="submit" value="Update"></td>
        <td><input name="add" id="add" type="reset" value="Reset"
        onclick="javascript:reset_type()"></td>
    </tr>
</table>
</form>
<hr width="50%" align="left">
_H;
}
echo "<h3>Availability ";
echo "<a id=\"update\" style=\"display:none\" ";
echo "href=\"javascript:send_changes($tt_days,$tt_intervals,$res_id)\">";
echo "Commit</a>";
echo "<span id=\"saved\"></span></h3>";
echo "<table border=\"1px\">";
echo "<tr><th></th>";
for ($i = 1; $i <= $tt_days; ++$i)
{
    echo "<td onclick=\"javascript:toggle_more($i,$i,1,$tt_intervals)\">";
    echo "Day $i</td>";
}
for ($i = 1; $i <= $tt_intervals; $i++)
{
    echo "<tr>";
    echo "<td onclick=\"javascript:toggle_more(1,$tt_days,$i,$i)\">";
    echo "Interval $i</td>";
    for ($j = 1; $j <= $tt_days; $j++)
    {
        echo "<td id=\"int_{$j}_{$i}\" ";
        echo "onclick=\"javascript:toggle_one($j,$i)\" ";
        if (isset($avl_tbl["$j,$i"]))
        {
            echo "style=\"background:#00FF00; width:15ex\">Available";
        }
        else
        {
            echo "style=\"background:#FF0000\">Not Available";
        }
        echo "</td>";
    }
    echo "</tr>";
}
echo "</tr>";

echo "</table>";
echo "<a href=\"javascript:clear_all(1,$tt_days,1,$tt_intervals)\">";
echo "Always available</a><br>";
echo "<br><p style=\"width:60ex\">";
print<<<_H
Click on an interval to toggle resource
availability for that interval. Click on the topmost
row to toggle all the intervals of that day.
Click on the leftmost column to toggle the interval for
every day.</p>
<hr width="50%" align="left">
<p><a href="manage_tt.php">Timetable {$_SESSION['tt_name']}</a></p>
<p><a href="index.php">Main page</a></p>
_H;
?>
