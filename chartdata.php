<?php
require 'dbconnect.php';
$usage=array();

$sql1="SELECT * FROM roomlogs WHERE status='on' AND roomno='201'";
$sql2="SELECT * FROM roomlogs WHERE status='on' AND roomno='202'";
$sql3="SELECT * FROM roomlogs WHERE status='on' AND roomno='203'";
$sql4="SELECT COUNT(*) FROM roomlogs";

$query1=mysqli_query($conn,$sql1);
$query2=mysqli_query($conn,$sql2);
$query3=mysqli_query($conn,$sql3);
$query4=mysqli_query($conn,$sql4);

$res1=mysqli_fetch_row($query1);
$res2=mysqli_fetch_row($query2);
$res3=mysqli_fetch_row($query3);
$res4=mysqli_fetch_row($query4);

$usage[0]=($res1[0]/$res4[0])*100;
$usage[1]=($res2[0]/$res4[0])*100;
$usage[2]=($res3[0]/$res4[0])*100;	

echo json_encode($usage);
?>