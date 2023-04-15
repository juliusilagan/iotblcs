<?php
require 'dbconnect.php';
$curdate=date("m");
//get roomcurrent state para hindi madouble entry sa roomlogs
$get="SELECT status FROM `roomcurrentstate`";
$getq=mysqli_query($conn,$get);
$getArr = array();
while ($getr=mysqli_fetch_row($getq)) {
	$getArr[]=$getr[0];
}

if (isset($_GET["room1"])) {

	if ($_GET["room1"]=="on") {
		if ($getArr[0] !== "on" && $getArr[0] !== "occupied") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'on' WHERE roomno = '201'";	
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('201','on',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}
	}elseif ($_GET["room1"]=="occupied") {
		if ($getArr[0] !== "occupied" && $getArr[0] !== "on") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'occupied' WHERE roomno = '201'";					
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('201','occupied',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}
	}elseif ($_GET["room1"]=="empty") {
		if ($getArr[0] !== "empty") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'empty' WHERE roomno = '201'";					
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('201','empty',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}	
	}
}

if (isset($_GET["room2"])) {
	
	if ($_GET["room2"]=="on") {
		if ($getArr[1] !== "on" && $getArr[1] !== "occupied") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'on' WHERE roomno = '202'";	
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('202','on',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}
	}elseif ($_GET["room2"]=="occupied") {
		if ($getArr[1] !== "occupied" && $getArr[1] !== "on") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'occupied' WHERE roomno = '202'";	
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('202','occupied',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}
	}elseif ($_GET["room2"]=="empty") {
		if ($getArr[1] !== "empty") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'empty' WHERE roomno = '202'";					
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('202','empty',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}
	}
}

if (isset($_GET["room3"])) {
	
	if ($_GET["room3"]=="on") {
		if ($getArr[2] !== "on" && $getArr[2] !== "occupied") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'on' WHERE roomno = '203'";	
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('203','on',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}
	}elseif ($_GET["room3"]=="occupied") {
		if ($getArr[2] !== "occupied"  && $getArr[2] !== "on") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'occupied' WHERE roomno = '203'";	
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('203','occupied',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}
	}elseif ($_GET["room3"]=="empty") {
		if ($getArr[2] !== "empty") {
			$sql2 = "UPDATE `roomcurrentstate` SET status = 'empty' WHERE roomno = '203'";					
			$sql3 = "INSERT INTO `roomlogs` (roomno, status,time,date,hour,monthnumber) VALUES('203','empty',CURRENT_TIMESTAMP,CURDATE(),CURTIME(),$curdate)";
		}
	}
}
if (!empty($sql2)&&!empty($sql3)) {
	mysqli_query($conn,$sql2);
	mysqli_query($conn,$sql3);
	
	//echo mysqli_error($conn);
	mysqli_close($conn);
}

header('location:../interface.html');
exit();
?>