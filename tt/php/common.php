<?php
//session_start();
function render_timetable_for_resource($sched_act, $resource_name,
        $days, $intervals, $show, $js_function="")
{
    $scd = array();
    for ($i = 1; $i <=$days; $i++)
    {
        for ($j = 1; $j <=$intervals; $j++)
        {
            $scd["$i,$j"] = array();
        }
    }
    $resource_used = 0;
    foreach ($sched_act as $act)
    {
        if ($resource_name == $act['class']
            || $resource_name == $act['prof']
            || $resource_name == $act['room'])
        {
            $cell_content = array(
                    $act['class'],
                    $act['prof'],
                    $act['room']
                    );
            $cell_content = array_diff($cell_content, array($resource_name));
            if (count($scd["{$act['day']},{$act['interval']}"]) != 0)
            {
                die("Resource $resource_name ".
                        "must be in two places simultaneously!");
            }
            $scd["{$act['day']},{$act['interval']}"] 
                = array_values($cell_content);
            $resource_used = 1;
        }
    }
    $result = "";
    if (!$resource_used)
    {
        return $result;
    }
    $result .= "<div id=\"res_name_$resource_name\" style=\"display: $show\">";
    $result .= "<table border=\"solid\">";
    $result .= "<caption>Timetable for $resource_name</caption>";
    $result .= "<tr><th></th>";
    for ($i = 1; $i <= $days; $i++)
    {   if($i==1)
		$d='SUNDAY';
	    if($i==2)
		$d='MONDAY';
	   if($i==3)
		$d='TUESDAY';
	if($i==4)
		$d='WEDNESDAY';
	if($i==5)
		$d='THURSDAY';
	if($i==6)
		$d='FRIDAY';
        $result .= "<th>$d</th>";
    }
    $result .= "</tr>";
    for ($j =1; $j <= $intervals; $j++)
    {
        $result .= "<tr>";
		if($j==1)
			$t='10:00-10:45';
		if($j==2)
			$t='10:45-11:30';
		if($j==3)
			$t='11:30-12:15';
		if($j==4)
			$t='12:15-01:00';
		if($j==5)
			$t='01:00-01:45';
		if($j==6)
			$t='01:45-02:30';
		if($j==7)
			$t='02:30-03:15';
		if($j==8)
			$t='03:15-04:00';
        $result .= "<td>$t</td>";
        for ($i = 1; $i <= $days; $i++)
        {
            $result .= "<td id=\"tt_{$i}_{$j}\"";
            if ($js_function != "")
            {
                $result .= " onclick=\"javascript:$js_function($i,$j)\"";
            }
            $result .= ">";
            $cell_content = $scd["$i,$j"];
            if (count($cell_content) != 0)
            {
                $result .= "{$cell_content[0]} - {$cell_content[1]}";
            }
            $result .= "</td>";
        }
        $result .= "</tr>";
    }
    $result .= "</table>";
    $result .= "</div>";
    return $result;
}

function read_scheduled_activities($tt_id, $conn)
{   
$sched_act = array();

    $sched_act = array();
    $query = "SELECT R1.NAME AS CLASS, R2.NAME AS PROF, " .
        "R3.NAME AS ROOM, SA.DAY, SA.INT_NO, " .
        "SA.CLASS_ID, SA.PROF_ID, SA.ROOM_ID, SA.ID " .
        "FROM SCHED_ACTIVITIES SA, RESOURCES R1, RESOURCES R2, RESOURCES R3 ".
        "WHERE SA.TT_ID=$tt_id AND SA.CLASS_ID=R1.ID " . 
        "AND SA.PROF_ID=R2.ID AND SA.ROOM_ID=R3.ID";
//    echo "<p>$query</p>";
    $result = mysqli_query($conn,$query)
        or die(mysqli_error($conn));
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $act = array();
		
        $act['id'] = $row['ID'];
        $act['class'] = $row['CLASS'];
        $act['prof'] = $row['PROF'];
        $act['room'] = $row['ROOM'];
        $act['class_id'] = $row['CLASS_ID'];
        $act['prof_id'] = $row['PROF_ID'];
        $act['room_id'] = $row['ROOM_ID'];
        $act['day'] = $row['DAY'];
        $act['interval'] = $row['INT_NO'];
        $sched_act[] = $act;
		
    }
    return $sched_act;
	
}

function read_activities($tt_id, $conn)
{
    $query = "SELECT * FROM ACTIVITIES WHERE TT_ID=$tt_id";
    $result = mysqli_query($conn,$query)
        or die("Can't read activities!");
    $activities = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $act = array();
        $act['class'] = $row['CLASS_ID'];
        $act['prof'] = $row['PROF_ID'];
        $act['type'] = $row['TYPE'];
        $activities[$row['ID']] = $act;
    }
    return $activities;
}

function fix_avl($avl, $days, $intervals)
{
    if ($avl == '')
    {
        for ($i = 1; $i <= $days; $i++)
        {
            for ($j = 1; $j <= $intervals; $j++)
            {
                $avl .= "$i,$j;";
            }
        }
        $avl = rtrim($avl, ";");
    }
    if ($avl{0} == ':')
    {
        $avl = ltrim($avl, ":");
        $avl = rtrim($avl, ";");
    }
    return explode(";", $avl);
}

function read_resources($tt_id, $conn, $days, $intervals)
{
    $query = "SELECT * FROM RESOURCES WHERE TT_ID=$tt_id";
    $result = mysqli_query($conn,$query)
        or die("Can't read activities!");
    $resources = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $res = array();
        $res['type'] = $row['TYPE'];
        $res['name'] = $row['NAME'];
        $res['avl'] = fix_avl($row['AVL'], $days, $intervals);
        $res['size'] = $row['SIZE'];
        $resources[$row['ID']] = $res;
    }
    return $resources;
}

function read_timetable($tt_id, $conn)
{
    $query = "SELECT * FROM TIMETABLES WHERE ID=$tt_id";
    $result = mysqli_query($conn,$query)
        or die("Can't read timetable");
    //$resources = array();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $timetable = array();
    $timetable['name'] = $row['NAME'];
    $timetable['days'] = $row['DAYS'];
    $timetable['intervals'] = $row['INTERVALS'];
    return $timetable;
}

function connect_to_db()
{
	if(!isset($_SESSION['signup'])){
		$dbuser = $_SESSION['status'];
    $dbpass = $_SESSION['status'];
	}
	else{
		$dbuser = 'root';
    $dbpass = '';
	}
    $dbhost = 'localhost';
    
    $dbname = 'sms';
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname)
        or die ('Error connecting to mysqli');
		/*if(!isset($_SESSION['signup'])){
			
		
       $user=$_SESSION['uname'];
$query1 = "SELECT * FROM users WHERE username='$user'";
    $select = mysqli_query($conn,$query1)
        or die("Can't read timetable!");
		 $row = mysqli_fetch_array($select, MYSQLI_ASSOC);
		 $dbuser=$row['user_status'];
		 $dbpass=$row['user_status'];
		 $dbname='sms';
		// echo $dbuser;
		   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname)
        or die ('Error connecting to mysqli');
   // mysqli_select_db($dbname)
       // or die ('Error selecting database');
		}*/
    return $conn;
}

function dump_var($v)
{
    echo "<pre>";
    print_r($v);
    echo "</pre>";
}

function debug_dump()
{
    echo "<p>session contents</p>";
    dump_var($_SESSION);
}

function get_resources($tt_id, $res_type, $selected_id)
{
    $query = "SELECT ID, NAME FROM RESOURCES ".
        "WHERE TT_ID = $tt_id AND TYPE = '$res_type'";
//    echo "<p>$query</p>";
      $conn=connect_to_db();
    $result = mysqli_query($conn,$query)
        or die("Can't read associated resources (type $res_type)");
    $res_options = "";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $selected = $selected_id == $row['ID'] ? ' selected' : '';
        $res_options .= "<option$selected>{$row['NAME']}</option>";
    }
    return $res_options;
}

function get_defined_resources_by_type($tt_id, $conn, $type)
{
    $resources = "";
    $resources .= "\n<div id=\"{$type}_res\" ".
        "style=\"display:none\">\n";
    $resources .= "<b>$type resources</b><br>\n";
    $query = "SELECT * FROM RESOURCES " .
        "WHERE TT_ID=$tt_id AND TYPE='$type'";
//    $resources .= "<p>$query</p>";
    $result = mysqli_query($conn,$query)
        or die ("Can't get resources!");
    if (mysqli_num_rows($result) == 0)
    {
//        $resources = "<p>You have defined no $type resources!</p>";
        $resources .= "You have defined no $type resources!";
    }
    else
    {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $res_id = $row['ID'];
            $res_name = $row['NAME'];
            $res_type = $row['TYPE'];
            $res_size = $row['SIZE'];
            $resources .= "<a href=\"editres.php?id=$res_id\">";
            $resources .= "$res_name";
            if ($res_type != 'PROF')
            {
                $resources .= " ($res_size)";
            }
            $resources .= "</a>\n";
        }
    }
    $resources .= "</div>\n";
    return $resources;
}

function get_defined_resources($tt_id, $conn)
{
    $result = "";
    $result .= "<b>Resources</b> ";
    $result .= "<a id=\"show_lnk\" ";
    $result .= "href=\"javascript:show_res('block')\">show</a> ";
    $result .= "<a href=\"newresource.php\">new</a>";
    $result .= get_defined_resources_by_type($tt_id, $conn, "CLASS");
    $result .= get_defined_resources_by_type($tt_id, $conn, "PROF");
    $result .= get_defined_resources_by_type($tt_id, $conn, "ROOM");
    $result .= "<br>";
    return $result;
}

function get_defined_activities_by_cat($tt_id, $conn, $cat)
{
    if ($cat == 'prof')
    {
        $sort = "PROF_NAME";
    }
    else
    {
        $sort = "CLASS_NAME";
    }
    $query = "SELECT A.ID AS ID, R1.NAME AS CLASS_NAME, R2.NAME AS PROF_NAME " .
             "FROM ACTIVITIES A, RESOURCES R1, RESOURCES R2 " .
             "WHERE A.TT_ID=$tt_id AND A.CLASS_ID=R1.ID AND A.PROF_ID=R2.ID " .
             "ORDER BY $sort";
    $result = mysqli_query($conn,$query)
        or die ("Can't get activities!");
    $activities = "";
    $activities .= "<b>Activities by $cat:</b>\n";
    $activities .= "<a href=\"javascript:show_activity('block','$cat')\" " .
        "id=\"show_lnk_act_$cat\">show</a>\n";
    $activities .= "<a href=\"newactivity.php\">new</a>\n";
    $activities .= "<div id=\"act_$cat\" style=\"display:none\">\n";
    if (mysqli_num_rows($result) == 0)
    {
        $activities .= "<p>You have defined no activities!</p>\n";
    }
    else
    {
        $crt_cat = "";
        if ($cat == 'prof')
        {
            $catvar = 'prof_name';
        }
        else
        {
            $catvar = 'class_name';
        }
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $act_id = $row['ID'];
            $class_name = $row['CLASS_NAME'];
            $prof_name = $row['PROF_NAME'];
            if ($crt_cat != $$catvar)
            {
                $crt_cat = $$catvar;
                $activities .= "<br><b>$crt_cat</b><br>\n";
            }
            $activities .= "<a href=\"newactivity.php?edit=$act_id\">";
            $activities .= "$class_name - $prof_name</a>\n";
        }
    }
    $activities .= "</div><br>\n";
    return $activities;
}

function get_defined_activities($tt_id, $conn)
{
    $activities = "";
    $activities .= 
        get_defined_activities_by_cat($tt_id, $conn, 'class');
    $activities .=
        get_defined_activities_by_cat($tt_id, $conn, 'prof');
    return $activities;
}

function echop($arg)
{
    echo "<p>$arg</p>";
}

?>
