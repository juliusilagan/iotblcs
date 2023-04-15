<?php
require 'dbconnect.php';

if (isset($_POST['add'])) {
	$sql="INSERT INTO roomcurrentstate(roomno, status) VALUES('".$_POST['add']."','empty')";
	mysqli_query($conn,$sql);
	header('location: index.php?added=true');
	exit();
}
if (isset($_POST['del'])) {
	$sql="DELETE FROM roomcurrentstate WHERE roomno='".$_POST['del']."'";
	mysqli_query($conn,$sql);
	header('location: index.php?deleted=true');
	exit();
}
?>