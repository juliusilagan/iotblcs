<?php
function tosec($str_time){
$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
return $time_seconds;
}
function yeah($roomno){
require 'dbconnect.php';
	$array1=array();$array2=array();$timediff=array();$timeres=array();$curdate=date("m");

$rm201="SELECT `time`,`status` FROM roomlogs WHERE roomno=$roomno AND monthnumber=$curdate";
/*echo $rm201;*/
$query1=mysqli_query($conn,$rm201);
while ($result1=mysqli_fetch_row($query1)) {
	$array1[]=$result1[0];
	$array2[]=$result1[1];
}
array_push($array1,"blue");array_push($array2,"blue");
/*print_r($array1);
print_r($array2);*/
foreach ($array1 as $key => $value) {
	if (isset($timestart)&&isset($timeend)) {
		$timediff[]="SELECT TIMEDIFF(\"$timeend\",\"$timestart\")";
		unset($timestart);
		unset($timeend);
	}
	if ($key % 2 == 0) {
		if ($array2[$key]=="on") {
			$timestart=$array1[$key];
			$onstate=$key;
		}
	}
	if ($key-$onstate == 1) {
		$timeend=$array1[$key];
	}
}
foreach ($timediff as $key => $value) {
	$tdiffQuery=mysqli_query($conn,$value);
	$tdiffRes=mysqli_fetch_row($tdiffQuery);
	$timeres[]=tosec($tdiffRes[0]);
}
//print_r($timediff);
return array_sum($timeres);

}
$retval=array();
$retval[1]=yeah(201);
$retval[2]=yeah(202);
$retval[3]=yeah(203);
$sumval=array_sum($retval);

if (isset($_GET['watts'])) {
	$watts=$_GET['watts'];
	$usage=($sumval*0.000277778)*($watts/1000);
	$usagebreakdown=array(($retval[1]*0.000277778)*($watts/1000),($retval[2]*0.000277778)*($watts/1000),($retval[3]*0.000277778)*($watts/1000));
	echo json_encode($usagebreakdown);
}
	
?>