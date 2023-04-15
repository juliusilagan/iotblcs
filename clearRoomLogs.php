<?php
require 'dbconnect.php';
$sql="TRUNCATE `roomlogs`";
mysqli_query($conn,$sql);
header('location:index.php?clearRoomLogs=true');
exit();
?>