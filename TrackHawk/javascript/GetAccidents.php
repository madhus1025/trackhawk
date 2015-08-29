﻿<?php

	include 'Connector.php';
	
	$con=connector();

	session_start();
		
	$district=$_SESSION['district'];

	$myfile = fopen("accidents.csv", "w") or die("Unable to open file!");

	ftruncate($myfile, 0);

	$flag=$_GET['flag'];

	$txt= "Latitude".","."Longitude".","."Dead".","."Injury".",\n";
		
	fwrite($myfile, $txt);

	if($flag==0){

		$result=mysqli_query($con,"select * from accidents where deviceid in(select deviceid from devices where district='$district')");

	}
	else{


		$start=$_SESSION['start'];

		$end=$_SESSION['end'];

		$station=$_SESSION['station'];		
		
		$result=mysqli_query($con,"select * from accidents where timeofhappening between '$start' and '$end' and deviceid in(select deviceid from devices where district='$district' and station='$station')");

	}
	while($row=mysqli_fetch_array($result)){

		$txt= $row['latitude'].",".$row['longitude'].",".$row['dead'].",".$row['injury'].",\n";		
	
		echo $row['latitude'].",".$row['longitude'].",".$row['dead'].",".$row['injury'].",";

		$id=$row['id'];
	
		fwrite($myfile, $txt);

	}
	fclose($myfile);
?>
