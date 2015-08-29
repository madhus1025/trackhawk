<?php
	include 'Connector.php';
	$con=connector();

	session_start();

	$district=$_SESSION['district'];

	
	$result=mysqli_query($con,"select * from stations where district='$district'");

	while($row=mysqli_fetch_array($result)){
		
		echo $row['stationName'].",";
	}
	
?>
