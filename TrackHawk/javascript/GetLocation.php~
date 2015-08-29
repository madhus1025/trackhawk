

<?php
	include 'Connector.php';	
	$con=connector();

	session_start();
	$district=$_SESSION['district'];	
	
	$result=mysqli_query($con,'SELECT * FROM locations');
	while($row=mysqli_fetch_array($result)){
		$deviceid=$row['deviceid'];
		$date=$row['date'];
                $result1=mysqli_query($con,"select * from devices where deviceid=$deviceid and district='$district'");
		$row1=mysqli_fetch_array($result1);
		$name=$row1['currentholder'];
		$phone=$row1['currentnum'];
		if($row1['status']==1){
		if($row1['name']=="")
			$name="Not Registered";

                 echo $row['lattitude'].','.$row['longitude'].','.$name.','.$phone.','.$row1['highway'].',';

		}
               
        }

	clearstatcache(); 		
	mysqli_close($con);
?>
