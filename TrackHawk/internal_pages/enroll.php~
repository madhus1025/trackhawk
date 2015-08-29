<?php
	include 'Connector.php';
	session_start();
	$district=$_SESSION['district'];
	$imei=$_POST['imei'];
	$name=$_POST['name'];
	$station=$_POST['station'];
	if($imei=="")
		header("Location:/internal_pages/welcome.php");
	$con=connector();
	$result=mysqli_query($con,"SELECT * FROM devices where imei='$imei'");
	$row=mysqli_fetch_array($result);
	if($row!=null)
		echo "<script>alert('IMEI already Exists')</script>";
	$result=mysqli_query($con,"SELECT * FROM devices");
	$rows=$result->num_rows;
	$rows++;
	$result=mysqli_query($con,"insert into devices values($rows,'$imei',0,'$name','','',0,'$station','$district')");
	echo "<script type='text/javascript'>window.close();</script>";
?>
