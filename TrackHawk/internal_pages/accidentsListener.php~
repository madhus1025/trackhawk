<?php
	include 'Connector.php';
	
	$con=connector();

	$imei=$_GET['imei'];
		       	
	$result=mysqli_query($con,"select deviceid from devices where imei='$imei'");

	$row=mysqli_fetch_array($result);

	$devid=$row['deviceid'];

	$fatal=$_GET['fatal'];

	$lattitude=$_GET['lattitude'];

	$longitude=$_GET['longitude'];

	$happening=$_GET['happening'];

	$reporting=$_GET['reporting'];

	$dead=$_GET['dead'];

	$injury=$_GET['injury'];

	$vehicle=$_GET['vehicle'];

	$comments=$_GET['comments'];

  
	$result=mysqli_query($con,"select * from 
accidents");

	$count= mysqli_num_rows($result);

	$count++;

	echo $fatal;
      
	$result=mysqli_query($con,"insert into accidents values($count,$devid,$fatal,$dead,$injury,'$vehicle',$lattitude,$longitude,'$happening','$reporting',1,'$comments')");   

	if(!$result){
	
	echo "Fatal:";
	}	

?>		
