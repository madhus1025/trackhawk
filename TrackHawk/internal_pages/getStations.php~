<?php
	include 'Connector.php';

	$con=connector();

	$start=$_GET['start'];

	$end=$_GET['end'];	


	session_start();

	$_SESSION['start']=$start;

	$_SESSION['end']=$end;

	$district=$_SESSION['district'];
	
	$result=mysqli_query($con,"select stationName from stations where district='$district'");

	while($row=mysqli_fetch_array($result)){

		echo $row['stationName'].",";

	}

?>
