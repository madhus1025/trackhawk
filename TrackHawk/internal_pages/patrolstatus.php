<?php

	include 'Connector.php';

	$con=connector();

	$imei=$_GET['imei'];

	$result=mysqli_query($con,"select * from devices where imei='$imei'");

	$row=mysqli_fetch_array($result);

	$status=$row['status']; 
	
	$date=date("Y-m-d");	

	if($status==0){

		$result=mysqli_query($con,"update devices set status=1 where imei='$imei'");
		echo  "End Patrol";
	}
	else{
		$result=mysqli_query($con,"update devices set status=0 where imei='$imei'");
		$result=mysqli_query($con,"update deviceholders set end='$date' where imei='$imei' and end='2222-12-31 22:22:22'");
		$result=mysqli_query($con,"delete from locations where deviceid in(select deviceid from devices where imei='$imei')");
		echo "Start Patrol";

	}

?>
