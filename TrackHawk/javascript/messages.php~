<?php

	include 'Connector.php';
	
	$con=connector();

	session_start();
		
	$district=$_SESSION['district'];

	$result=mysqli_query($con,"select * from theft where status=1 and deviceid in(select deviceid from devices where district='$district')");

	while($row=mysqli_fetch_array($result)){

		echo $row['property'].",".$row['comments'].",";

		$id=$row['id'];

		$result1=mysqli_query($con,"update theft set status=0 where id=$id");

	}


?>
