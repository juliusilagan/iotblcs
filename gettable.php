<?php
require 'dbconnect.php';
$sql="SELECT roomno,status FROM roomcurrentstate";
$query=mysqli_query($conn,$sql);
$arr1 = array();
while($fetch=mysqli_fetch_row($query)){
	$arr1[]=json_encode($fetch);
}
echo '{
  "data": ['.implode(",", $arr1).']
}';
?>