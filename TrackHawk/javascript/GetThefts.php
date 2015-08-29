<?php

	include 'Connector.php';
	
	$con=connector();

	session_start();
		
	$district=$_SESSION['district'];

	$flag=$_GET['flag'];

	$myfile1 = fopen("theft.csv", "w") or die("Unable to open file!");

	ftruncate($myfile1, 0);

	$txt= "Latitude".","."Longitude".","."Property".",\n";

	fwrite($myfile1, $txt);

	if($flag==0){

		$result=mysqli_query($con,"select * from theft where deviceid in(select deviceid from devices where district='$district')");
	
	}

	else{
	


		$start=$_SESSION['start'];

		$end=$_SESSION['end'];

		$station=$_SESSION['station'];

		$flag=$_GET['flag'];
		
		$result=mysqli_query($con,"select * from theft where happening between '$start' and '$end' and deviceid in(select deviceid from devices where district='$district' and station='$station')");

	}
	
	while($row=mysqli_fetch_array($result)){


	
		$txt=$row['latitude'].",".$row['longitude'].",".$row['property'].",\n";
	
		fwrite($myfile1, $txt);

		echo $row['latitude'].",".$row['longitude'].",".$row['property'].",";
	}


?>
