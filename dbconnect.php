<?php
		$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "iotb_lcs";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	$conn2 = mysqli_connect($servername, $username, $password, "test");
?>