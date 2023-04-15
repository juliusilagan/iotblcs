<?php
require "dbconnect.php";
$sql="SELECT roomno,status FROM rooms";
$query=mysqli_query($conn,$sql);
$arrayName = array();
while ($fetch=mysqli_fetch_array($query)) {
	$arrayName[$fetch[0]]=$fetch[1];
}
echo json_encode($arrayName);
?>