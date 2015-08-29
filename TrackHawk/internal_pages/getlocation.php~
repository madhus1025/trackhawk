<?php
	include 'Connector.php';
	session_start();
	if($_SESSION['login']==0)
		header("Location:../index.php"); 
	$dev=$_GET['deviceid'];

	$str="";
	$start=$_SESSION['start'];
	$end=$_SESSION['end'];
	$district=$_SESSION['district'];
	$con=connector();
	
	$result=mysqli_query($con,"select * from history h where date between '$start' and '$end' and deviceid in (select deviceid from devices where imei in(select imei from deviceholders where name='$dev' and h.date between date and end) and district='$district')");
	while($row=mysqli_fetch_array($result))
		$str=$str.$row['lattitude'].",".$row['longitude'].",".$row['date'].",";

	echo $str;
	mysqli_close($con);
?> 
