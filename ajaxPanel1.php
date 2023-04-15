<?php
require 'dbconnect.php';
$sqldate="SELECT CURDATE()";
$qsqldate=mysqli_query($conn,$sqldate);
$qsqldate=mysqli_fetch_row($qsqldate);
$date=$qsqldate[0];
//count rows from roomlogs
$countrows="SELECT COUNT(*) FROM `roomlogs`";
$qcountrows=mysqli_query($conn,$countrows);
$rcountrows=mysqli_fetch_row($qcountrows);

$sql="SELECT * FROM `roomlogs` WHERE date='$date' ORDER BY `roomlogs`.`id` DESC LIMIT 0,4";
$sql2="SELECT * FROM `roomlogs` WHERE date='$date'";
$query=mysqli_query($conn,$sql);
$array = array();
$array2 = array('0'=>'No recent activities today','1'=>'No recent activities today','2'=>'No recent activities today','3'=>'No recent activities today');
$array3 = array();

if (mysqli_num_rows($query)>1) {
	while ($result=mysqli_fetch_row($query)) {
	$s=strtotime($result[5]);
	if ($result[2] == "on") {
		$result[2]="<strong><font color='green'>".$result[2]."</font></strong>";
	}
	if ($result[2] == "occupied") {
		$result[2]="<strong><font color='orange'>".$result[2]."</font></strong>";	
	}
	if ($result[2] == "empty") {
		$result[2]="<strong><font color='red'>".$result[2]."</font></strong>";
	}
	$result[1]="<strong>".$result[1]."</strong>";
	$array[]="Room ".$result[1].", Status: ".$result[2].", at ".date("h:i A",$s);
	$array3[]=$result[3];
	}
	if (!isset($array[2])) {
		$array[2]="...";
	}	
	if (!isset($array[3])) {
		$array[3]="...";
	}
	if (strpos($array3[0], $date) !== false) {
		echo json_encode($array);
	}
}else {
	$query2=mysqli_query($conn,$sql2);
	while($result2=mysqli_fetch_row($query2)){
		$s=strtotime($result2[5]);
		if ($result2[2] == "on") {
		$result2[2]="<strong><font size='3' color='green'>".$result2[2]."</font></strong>";
	}
	if ($result2[2] == "occupied") {
		$result2[2]="<strong><font color='orange'>".$result2[2]."</font></strong>";	
	}
	if ($result2[2] == "empty") {
		$result2[2]="<strong><font color='red'>".$result2[2]."</font></strong>";
	}
	$result[1]="<strong>".$result2[1]."</strong>";
		$array[]="Room ".$result2[1].", Status: ".$result2[2].", at ".date("h:i A",$s);
	}
	$array[1]="...";
	$array[2]="...";
	$array[3]="...";
	echo json_encode($array);
}
	


?>