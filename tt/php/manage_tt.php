<?php session_start(); ?>
<script language="javascript" src="../js/res_act_mng.js">
</script>
<script language="javascript">
function confirm_start_over()
{
    msg = 'Regenerating the timetable will erase ' +
        'the generated timetable and ALL your tweaks for this timetable!';
    if (confirm(msg))
    {
        location = 'generate.php';
    }
}
</script>
<?php
include_once("common.php");

function show_timetables($resources, $timetable, $tt_id, $conn)
{
    $sched_act = read_scheduled_activities($tt_id, $conn);
    $used_res = array();
    $html_result = "";
    if (count($sched_act) == 0)
    {
        $html_result .=  "";
    }
    else
    {
        $show = 'block';
        foreach ($resources as $k => $v)
        {
            $html_table = 
                render_timetable_for_resource($sched_act, $v['name'],
                        $timetable['days'], $timetable['intervals'],
                        $show);
						//echo $timetable['days'];
						//echo $timetable['intervals'];
						//echo $v['name'];
						//echo $sched_act;
            if ($html_table != "")
            {
                $used_res[] = $v['name'];
                $html_result .= $html_table;
                $show = 'none';
            }
			
        }
    }
    return array($used_res, $html_result);
}

function generate_chooser($used_resources)
{
    echo "\n<script language=\"javascript\">\n";
    echo "var res_list = new Array();\n";
    $i = 0;
    foreach ($used_resources as $res)
    {
        echo "res_list[$i]='$res';\n";
        $i++;
    }
    print<<<_H
function chooser_onchange()
{
    for (var i = 0; i < res_list.length; i++)
    {
        id = 'res_name_' + res_list[i];
        document.getElementById(id).style.display = 'none';
    }
    current = document.getElementById('res_chooser').value;
    document.getElementById('res_name_'+current).style.display = 'block';
}
_H;
    echo "</script>";
    echo "<br>View timetable for ";
    echo "<select id=\"res_chooser\" name=\"res_chooser\"";
    echo "onchange=\"javascript:chooser_onchange()\">";
    foreach ($used_resources as $res)
    {
        echo "<option>$res</option>";
    }
    echo "</select>";
}

// page entry point
if (!isset($_GET['id']) && !isset($_SESSION['tt_id']))
{
    echo '<a href="index.php">Main page</a>';
    exit();
}
if (isset($_GET['id']))
{
    $_SESSION['tt_id']= $_GET['id'];
    $_SESSION['tt_name']= $_GET['name'];
}
$conn = connect_to_db();
$resources = get_defined_resources($_SESSION['tt_id'], $conn);
$activities = get_defined_activities($_SESSION['tt_id'], $conn);
print<<<_H
<h2>Timetable - {$_SESSION['tt_name']}</h2>

_H;
echo "<hr width=\"50%\" align=\"left\"><h3>Timetable input</h3>";
echo $resources;
echo $activities;
$tt_id = $_SESSION['tt_id'];
$tt = read_timetable($tt_id, $conn);
$resources = read_resources($tt_id, $conn, $tt['days'], $tt['intervals']);
list($used_resources, $html_tt) = 
    show_timetables($resources, $tt, $_SESSION['tt_id'], $conn);
if ($html_tt == "")
{
    $generate_url = "generate.php";
}
else
{
    $generate_url = "javascript:confirm_start_over()";
}
echo "<hr width=\"50%\" align=\"left\"><h3>";
echo "<a href=\"$generate_url\">Generate</a> ";
//echo "<a href=\"tweak.php\">Tweak</a></h3> ";
echo "<hr width=\"50%\" align=\"left\"><h3>Timetable output</h3>";
if ($html_tt != "")
{
    generate_chooser($used_resources);
    echo $html_tt;
}
else
{
    echo "<p>No timetable generated yet</p>";
}
echo "<hr width=\"50%\" align=\"left\">";
echo "<p><a href=\"index.php\">Main page</a></p>";
?>

