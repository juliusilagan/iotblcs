<?php
require 'dbconnect.php';
$arr1=array();
$sql="SELECT value FROM monthlyusage";
$que=mysqli_query($conn,$sql);
if (mysqli_num_rows($que)>0) {
	while ($res=mysqli_fetch_row($que)) {
		$arr1[]=$res[0];
	}
}

/*for ($i=count($arr1); $i < 12; $i++) { 
	array_push($arr1, "0");
}*/
echo json_encode($arr1);
?>