<?php

	include 'Connector.php';

	$con=connector();
	
	session_start();

	$district=$_SESSION['district'];

	$station=$_POST['station'];

	$result=mysqli_query($con,"select * from stations where stationName='$station'");

	$row=mysqli_fetch_array($result);

	if($row!=null){
		
		echo "<script> alert('Already a station exists with the same name'); </script>";
		echo  "<script type='text/javascript'>";
		echo "window.close();";
		echo "</script>";
	}
	else{

		$rows=$result->num_rows;
		$rows++;
		$result=mysqli_query($con,"insert into stations values($rows,'$station','$district')");
		echo "<script> alert('Station Created'); </script>";
		echo  "<script type='text/javascript'>";
		echo  "<script type='text/javascript'>";
		echo "window.close();";
		echo "</script>";
	}
?>
