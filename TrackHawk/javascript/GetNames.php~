

<?php
	session_start();
	if($_SESSION['login']==0)
		header("Location:../index.php"); 
	session_start();
	$district=$_SESSION['district'];
	$str="";
	$date=date("Y-m-d");		
	$con=mysqli_connect("localhost","root","","hawk");
	$result=mysqli_query($con,"select * from deviceholders where imei in (select imei from devices where deviceid in(SELECT deviceid from locations)) and date='$date'");
	while($row=mysqli_fetch_array($result))
		$str=$str.$row['name'].",";  
	echo $str;
	mysqli_close($con);
?>
