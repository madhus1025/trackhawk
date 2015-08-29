<?php

	include'Connector.php';

	$conn=connector();

	if(! $conn ){
		die('Could not connect: ' . mysql_error());
	}
	$table_name = "history";
	
	$backup_file  = "/home/madhu/popp.sql";
	$sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";

	$retval = mysqli_query($conn,$sql);
	if(! $retval ){
		die('Could not take data backup: ' . mysqli_error());
	}
	echo "Backedup  data successfully\n";
	mysqli_close($conn);


?>

