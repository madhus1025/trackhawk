<?php
	include 'Connector.php';	
	session_start();
	//if($_SESSION['login']==0)
	//	header("Location:../index.php"); 


	$start=$_GET['start'];
	$end=$_GET['end'];

	$district=$_SESSION['district'];

	$_SESSION['start']=$start;
	
	$_SESSION['end']=$end;
	
	$str="";
	$con=Connector();
	$result=mysqli_query($con,"select * from deviceholders where imei in (select imei from devices where deviceid in(SELECT distinct deviceid FROM history where date between '$start' and '$end' ) and district='$district') and date between '$start' and '$end'");
	if($result!=null)
	while($row=mysqli_fetch_array($result))
		$str=$str.$row['name'].",";  
	echo $str;

	mysqli_close($con);
?>
