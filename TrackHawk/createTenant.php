<?php

	session_start();
	$tenant_name = $_GET['name'];
	$con=mysqli_connect("127.0.0.1","root","","master");
	echo $tenant_name;
	$result = mysqli_query($con,"select * from tenants where tname = '$tenant_name'");
	
	if(mysqli_num_rows($result) == 0){

		$result = mysqli_query($con,"select * from tenants");
		$rows = mysqli_num_rows($result);
		$result = mysqli_query($con,"insert into tenants values($rows++,'$tenant_name','2015-01-01','$tenant_name')");
		echo $result;
		$_SESSION['dbname'] = $tenant_name;
		header("Location:./internal_pages/setup.php"); 
	}
	else{
		echo "Another Tenant with same name already existing";
	}	
?>
