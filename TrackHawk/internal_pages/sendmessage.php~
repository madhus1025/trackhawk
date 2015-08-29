<?php

	include 'Connector.php';
	
	session_start(); 
	
	$con=connector();

	date_default_timezone_set('Asia/Kolkata');

	$date=date("y-m-d h-i-s");

	$message=$_GET['message'];

	$patroler=$_GET['patroler'];

	$username=$_SESSION['user'];

	$result=mysqli_query($con,"select * from devices where currentholder='$patroler'");

	$row=mysqli_fetch_array($result);
	
	$device=$row['name'];

	$result=mysqli_query($con,"select * from messages");

	$rows=$result->num_rows;

	$rows++;

	if($message!=null&&$message!="")

	$result=mysqli_query($con,"insert into messages values($rows,'$message','$patroler','$device','$username','$date',1,1)");

?>
