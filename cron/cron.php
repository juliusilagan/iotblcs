<?php
require '../dbconnect.php';
function tosec($str_time)
{
    $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
    $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
    return $time_seconds;
}
$curdate = date("m");
$total   = array();
$total2  = array();
for ($i = 1; $i <= $curdate; $i++) {
    for ($j = 201; $j <= 203; $j++) {
        $array1   = array();
        $array2   = array();
        $timeres  = array();
        $timediff = array();
        $rm201    = "SELECT `time`,`status` FROM roomlogs WHERE roomno=$j AND monthnumber=$i";
        $query1   = mysqli_query($conn, $rm201);
        if (mysqli_num_rows($query1) > 0) {
            while ($result1 = mysqli_fetch_row($query1)) {
                $array1[] = $result1[0];
                $array2[] = $result1[1];
            }
            array_push($array1, "blue");
            array_push($array2, "blue");
            foreach ($array1 as $key => $value) {
                if (isset($timestart) && isset($timeend)) {
                    $timediff[] = "SELECT TIMEDIFF(\"$timeend\",\"$timestart\")";
                    unset($timestart);
                    unset($timeend);
                }
                if ($key % 2 == 0) {
                    if ($array2[$key] == "on") {
                        $timestart = $array1[$key];
                        $onstate   = $key;
                    }
                }
                if ($key - $onstate == 1) {
                    $timeend = $array1[$key];
                }
            }
            foreach ($timediff as $key => $value) {
                $tdiffQuery = mysqli_query($conn, $value);
                $tdiffRes   = mysqli_fetch_row($tdiffQuery);
                $timeres[]  = tosec($tdiffRes[0]);
            }
            $total[] = array_sum($timeres);
        }
    }
    $total2[] = round(array_sum($total)/3600,5);
}
$qu="TRUNCATE `monthlyusage`";
mysqli_query($conn,$qu);
foreach ($total2 as $key => $value) {
	$k=$key+1;
	$que="INSERT INTO monthlyusage(month,value) VALUE('$k','$value')";
	if (mysqli_query($conn,$que)) {
		echo "success";
	}
}
?>