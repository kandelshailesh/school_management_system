<?php session_start(); ?>

<?php
include_once("common.php");

function calc_room_availability($resources, $timetable)
{
    $days = $timetable['days'];
    $intervals = $timetable['intervals'];
    $room_avl = array();
    for ($i = 1; $i <= $days; $i++)
    {
        for ($j = 1; $j <= $intervals; $j++)
        {
            $room_avl["$i,$j"] = array();
        }
    }
    foreach($resources as $k => $v)
    {
        if ($v['type'] == 'ROOM')
        {
            foreach ($v['avl'] as $interval)
            {
                $room_avl[$interval][] = $k;
            }
        }
    }
    return $room_avl;
}

function cmp_pressure($v1, $v2)
{
    if ($v1['pressure'] == $v2['pressure'])
    {
        return 0;
    }
    elseif ($v1['pressure'] < $v2['pressure'])
    {
        return 1;
    }
    elseif ($v1['pressure'] > $v2['pressure'])
    {
        return -1;
    }
}

function common_availability($activity, $resources)
{   
    $class_avl = $resources[$activity['class']]['avl'];
    $prof_avl = $resources[$activity['prof']]['avl'];
    $avl = array_intersect($class_avl,$prof_avl);
     
    return $avl;

}

function sort_by_pressure($activities, $resources)
{
    foreach ($activities as $k => $v)
    {
        $avl = common_availability($v, $resources);
		//echo count($avl);
        $pressure = 1000.0 / count($avl);
		//echo $pressure;
        $activities[$k]['pressure'] = $pressure;
		
		
    }
	
    uasort($activities, 'cmp_pressure');
    return $activities;
}

function get_all_variants($room_avl, $avl)
{
    $variants = array();
    foreach($avl as $interval)
    {
        $rooms = $room_avl[$interval];
        if (count($rooms) > 0)
        {
            foreach ($rooms as $room)
            {
                $variants[] = array($interval, $room);
            }
        }
    }
    return $variants;
}

function init_score_timetables(&$prof_timetable, &$class_timetable,
        $resources, $days, $intervals)
{
    $prof_timetable = array();
    $class_timetable = array();
    foreach($resources as $k => $resource)
    {
        if ($resource['type'] == 'PROF')
        {
            $prof_timetable[$k] = array();
            for ($i = 1; $i <= $days; $i++)
            {
                for ($j = 1; $j <= $intervals; $j++)
                {
                    $prof_timetable[$k]["$i,$j"] = 0;
                }
            }
        }
        else if ($resource['type'] == 'CLASS')
        {
            $class_timetable[$k] = array();
            for ($i = 1; $i <= $days; $i++)
            {
                for ($j = 1; $j <= $intervals; $j++)
                {
                    $class_timetable[$k]["$i,$j"] = 0;
                }
            }
        }
    }
}

function get_variant_score($variant, &$ptt, &$ctt, $days, $intervals)
{
    $ptt[$variant] = 1;
    $ctt[$variant] = 1;
    $score = 0;
    $prof_busy = array();
    $class_busy = array();
    for ($i = 1; $i <= $days; $i++)
    {
        $prof_windows = 0;
        $class_windows = 0;
        $prof_win_increment = 0;
        $class_win_increment = 0;
        $prof_has_window=0;
        $class_has_window=0;
        $pb = 0;
        $cb = 0;
        for ($j = 1; $j <= $intervals; $j++)
        {
            $pij = $ptt["$i,$j"];
            $cij = $ctt["$i,$j"];
            if ($pij == 1)
            {
                $pb ++;
            }
            if ($cij == 1)
            {
                $cb ++;
            }

            if ($pij == 1 && $prof_has_window == 0)
            {
                $prof_has_window = 1;
            }
            else if ($pij == 0 && 
                    ($prof_has_window == 1 || $prof_has_window == 2))
            {
                $prof_win_increment ++;
                $prof_has_window = 2;
            }
            else if ($pij == 1 && $prof_has_window == 2)
            {
                $prof_has_window = 1;
                $prof_windows += $prof_win_increment;
                $prof_win_increment = 0;
            }

            if ($cij == 1 && $class_has_window == 0)
            {
                $class_has_window = 1;
            }
            else if ($cij == 0 && 
                    ($class_has_window == 1 || $class_has_window == 2))
            {
                $class_win_increment ++;
                $class_has_window = 2;
            }
            else if ($cij == 1 && $class_has_window == 2)
            {
                $class_has_window = 1;
                $class_windows += $class_win_increment;
                $class_win_increment = 0;
            }
        }
        $prof_busy[] = $pb;
        $class_busy[] = $cb;
        $score -= $prof_windows * 20;
        $score -= $class_windows * 60;
    }
    for ($i = 2; $i <= $days; $i++)
    {
        $pb = abs($prof_busy[$i-1] - $prof_busy[$i-1]);
        $score -= ($pb - 1) * 2;
        $cd = abs($class_busy[$i-1] - $class_busy[$i-1]);
        $score -= ($cd - 1) * 4;
    }
    $ptt[$variant] = 0;
    $ctt[$variant] = 0;
//    echop($score);
    return $score;
}

function best_variant(&$variants, $activity,
        &$prof_timetable, &$class_timetable,
        $days, $intervals)
{
    $ptt = $prof_timetable[$activity['prof']];
    $ctt = $class_timetable[$activity['class']];
    $best_score = null;
    $best_variant = array();
    foreach ($variants as $variant)
    {
        $score = get_variant_score($variant, $ptt, $ctt, $days, $intervals);
        if ($best_score == null || $score > $best_score)
        {
            $best_score = $score;
            $best_variant = array();
            $best_variant[] = $variant;
        }
        else if ($best_score == $score)
        {
            $best_variant[] = $variant;
        }
    }
//    dump_var($best_score);
//    dump_var($best_variant);
    return $best_variant[mt_rand(0, count($best_variant)-1)];
}

function generate_timetable($activities, $resources, $room_avl,
        $days, $intervals)
{
    init_score_timetables($prof_timetable, $class_timetable,
        $resources, $days, $intervals);
    $sched_acts = array();
    foreach ($activities as $k => $v)
    {
        $room = "";
        $avl = common_availability($v, $resources);
        $variants = validate_avl_by_room($room_avl, $avl);
        if (count($variants) > 0)
        {
            $variant =
                best_variant($variants, $v,
                        $prof_timetable, $class_timetable,
                        $days, $intervals);
            $rooms =& $room_avl[$variant];
            $room = $rooms[0];
            $class = $v['class'];
            $prof = $v['prof'];
            $prof_timetable[$prof][$variant] = 1;
            $class_timetable[$class][$variant] = 1;
            $rooms = array_slice($rooms, 1);
            $resources[$class]['avl'] =
                array_diff($resources[$class]['avl'], array($variant));
            $resources[$prof]['avl'] =
                array_diff($resources[$prof]['avl'], array($variant));
            $act = array(
                'class' => $v['class'],
                'prof' => $v['prof'],
                'room' => $room,
                'interval' => $variant
                );
            $sched_acts[] = $act;
        }
        else
        {
            die("Can't find suitable room!");
        }
    }
    return $sched_acts;
}

function commit_schedule_to_db($sched_acts, $tt_id, $conn)
{
    $query = "DELETE FROM SCHED_ACTIVITIES WHERE TT_ID=$tt_id";
    mysqli_query($conn,$query)
        or die("Can't remove old schedule");
    foreach ($sched_acts as $act)
    {
        $class = $act['class'];
        $prof = $act['prof'];
        $room = $act['room'];
        list($day, $intv) = explode(",", $act['interval']);
        $query = "INSERT INTO SCHED_ACTIVITIES " .
            "(TT_ID, CLASS_ID, PROF_ID, ROOM_ID, DAY, INT_NO, TWEAK) " .
            "VALUES ($tt_id, $class, $prof, $room, $day, $intv, 0)";
        mysqli_query($conn,$query)
            or die("Can't add scheduled activity");
    }
}

function occupy_room(&$room_avl, $interval, $room_id)
{
    $room_avl[$interval] =
        array_diff($room_avl[$interval], array($room_id));
}

function validate_avl_by_room(&$room_avl, $avl)
{
    $validated_avl = array();
	if(is_array($avl)){
    foreach($avl as $interval)
    {
        $rooms = $room_avl[$interval];
        if (count($rooms) > 0)
        {
            $validated_avl[] = $interval;
        }
    }
	}
    return $validated_avl;
}

function get_tweaks($class_name, $prof_name, $room_name,
        &$room_avl, $sched_acts, $resources)
{
    $activity = null;
    foreach ($sched_acts as $act)
    {
//        dump_var($act);
//        echo("\n");
        if ($act['class'] == $class_name
            && $act['prof'] == $prof_name
            && $act['room'] == $room_name)
        {
//            dump_var($act);
            $activity = array(
                    'class' => $act['class_id'],
                    'prof' => $act['prof_id'],
                    'room' => $act['room_id']
                    );
            continue;
        }
        $interval = "{$act['day']},{$act['interval']}";
        if ($act['class'] == $class_name)
        {
//            echo "<p>reducing avl for $class_name $interval</p>";
            $avl =& $resources[$act['class_id']]['avl'];
            $avl = array_diff($avl, array($interval));
        }
        if ($act['prof'] == $prof_name)
        {
//            echo "<p>reducing avl for $prof_name $interval</p>";
            $avl =& $resources[$act['prof_id']]['avl'];
            $avl = array_diff($avl, array($interval));
        }
//        echo "<p>reducing avl for {$act['room']} $interval</p>";
        occupy_room($room_avl, $interval, $act['room_id']);
    }
//    echo "<p>activity</p>";
//    dump_var($activity);
    $avl = common_availability($activity, $resources);
    $tweaks = validate_avl_by_room($room_avl, $avl);
    return $tweaks;
}

function generate($tt_id, $conn)
{
    $timetable = read_timetable($tt_id, $conn);
    $activities = read_activities($tt_id, $conn);
    $resources = read_resources($tt_id, $conn,
            $timetable['days'], $timetable['intervals']);
    //dump_var($activities);
    //dump_var($resources);
    //dump_var($timetable);
    $room_avl = calc_room_availability($resources, $timetable);
    //dump_var($room_avl);
    $activities = sort_by_pressure($activities, $resources);
    //dump_var($activities);
    $sched_acts = generate_timetable($activities, $resources, $room_avl,
            $timetable['days'], $timetable['intervals']);
    //dump_var($sched_acts);
    commit_schedule_to_db($sched_acts, $tt_id, $conn);
    echo "<p>Scheduled all activities</p>";
    echo "<p><a href=\"manage_tt.php\">Timetable ";
    echo "{$_SESSION['tt_name']}</a></p>";
    echo "<p><a href=\"index.php\">Main page</a></p>";
}

//debug_dump();
$tt_id = $_SESSION['tt_id'];
$conn = connect_to_db();
if (isset($_POST['tweak']))
{
    $sched_acts = read_scheduled_activities($tt_id, $conn);
    list($class, $prof, $room) = split(',', $_POST['start']);
    list($day, $interval) = split('_', $_POST['stop']);
    $timetable = read_timetable($tt_id, $conn);
    $resources = read_resources($tt_id, $conn,
            $timetable['days'], $timetable['intervals']);
    $room_avl = calc_room_availability($resources, $timetable);
    // call to reduce the room_avl using the scheduled activities
    foreach($sched_acts as $act)
    {
        if ($act['class'] == $class
                && $act['prof'] == $prof
                && $act['room'] == $room)
        {
            $id = $act['id'];
            break;
        }
    }
    get_tweaks($class, $prof, $room, $room_avl, $sched_acts, $resources);
//    dump_var($room_avl);
    $rooms = array_values($room_avl["$day,$interval"]);
    $room = $rooms[0];
    $query = "UPDATE SCHED_ACTIVITIES " .
        "SET ROOM_ID=$room, DAY=$day, INT_NO=$interval " .
        "WHERE ID=$id";
    mysqli_query($query)
        //                or die("Can't update scheduled activities!");
        or die(mysqli_error($conn));
    exit();
}
if (isset($_POST['tweak_options']))
{
    $timetable = read_timetable($tt_id, $conn);
    $activities = read_activities($tt_id, $conn);
    $resources = read_resources($tt_id, $conn,
            $timetable['days'], $timetable['intervals']);
    $sched_acts = read_scheduled_activities($tt_id, $conn);
    $class_name = $_POST['class_name'];
    $prof_name = $_POST['prof_name'];
    $room_name = $_POST['room_name'];
//    dump_var($_POST);
    $room_avl = calc_room_availability($resources, $timetable);
    $tweaks = get_tweaks($class_name, $prof_name, $room_name,
            $room_avl, $sched_acts, $resources);
    $output = "";
    foreach ($tweaks as $tweak)
    {
        $output .= $tweak . ";";
    }
    $output = rtrim($output, ';');
    echo($output);
    exit();
}
if (isset($_GET['startover']))
{
    $query = "DELETE FROM SCHED_ACTIVITIES WHERE TT_ID=$tt_id";
    mysqli_query($query)
        or die ("Can't delete activities");
    echo "<p>Un-scheduled all activities</p>";
    echo "<p><a href=\"manage_tt.php\">Timetable ";
    echo "{$_SESSION['tt_name']}</a></p>";
    echo "<p><a href=\"index.php\">Main page</a></p>";
    exit();
}
$start_time = microtime(true);
generate($tt_id, $conn);
$stop_time = microtime(true);
$duration = $stop_time - $start_time;
echo "<p>[Generate took $duration seconds]</p>";
?>
