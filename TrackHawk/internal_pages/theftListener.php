<?php
	include 'Connector.php';
	
	$con=connector();

	$imei=$_GET['imei'];
		       	
	$result=mysqli_query($con,"select deviceid from devices where imei='$imei'");

	$count= mysqli_num_rows($result);

	if($count==0){
		
		echo "This Device is un registered";
		
	}

	else{

	$lattitude=$_GET['lattitude'];

	$longitude=$_GET['longitude'];

	$happening=$_GET['happening'];

	$reporting=$_GET['reporting'];

	$property=$_GET['property'];

	$comments=$_GET['comments'];

	$rating=$_GET['rating'];

	$deviceid=$row['deviceid'];
  
	$result=mysqli_query($con,"select * from theft");

	$count= mysqli_num_rows($result);

	$count++;
      
	$result=mysqli_query($con,"insert into theft values($count,$deviceid,$lattitude,$longitude,$property,'$happening','$reporting','$comments',1)");   

	if(!$result){
	
	echo "Fatal:";
	}	

	}

?>		
