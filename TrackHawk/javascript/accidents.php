﻿<?php

	include 'Connector.php';
	
	$con=connector();

	session_start();

	$district=$_SESSION['district'];

	$result=mysqli_query($con,"select * from accidents where status=1 and deviceid in(select deviceid from devices where district='$district')");

	while($row=mysqli_fetch_array($result)){

		echo $row['dead'].",".$row['injury'].",".$row['vehicle'].",".$row['comments'].",";

		$id=$row['id'];

		$result1=mysqli_query($con,"update accidents set status=0 where id=$id");

	}


?>
