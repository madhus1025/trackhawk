<?php


	session_start();

	$dbname = $_SESSION['dbname'];

	include 'Connector.php';

	$conn = connector_db();
	
	$sql = "CREATE DATABASE ".$dbname;
	 
	$conn->query($sql); 


	$con=connector();
	
	 $sql="CREATE TABLE login(username CHAR(30),password CHAR(20),date CHAR(30),district CHAR(20))";

	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}


	$sql="create table accidents(id int,fatal int,injury int,dead int,vehicle varchar(30),latitude double,longitude double,timeofhappening datetime,timeofreporting datetime,status int,comments varchar(200),fir int)";

	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}

	$sql="create table messages(id int,message varchar(200),patroler varchar(20),device varchar(30),user varchar(20),time datetime,status int,send int)";

	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}

	$sql="create table theft(id int,deviceid int,latitude double,longitude double,property int,happening datetime,reporting datetime,comments varchar(200),status int)";

	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}



	$sql="CREATE TABLE locations(deviceid int,lattitude double,longitude double,date datetime,stayed int)";
	
	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}

	$sql="CREATE TABLE history(deviceid int,lattitude double,longitude double,date datetime,stayed int)";
	
	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}
	
	$sql="CREATE TABLE log(username char(20),ip char(20),time char(20))";
	
	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}

	$sql="CREATE TABLE devices(deviceid int , imei char(20),status int,name varchar(30),currentholder varchar(30),currentnum varchar(30),highway int, station CHAR(20), district CHAR(20))";
	
	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}
	
	$sql="CREATE TABLE deviceholders(imei char(20),name char(20),phone char(20),date datetime,devicename varchar(30),highway int,end datetime)";

	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}

	$sql="CREATE TABLE stations(id int,stationName CHAR(20),district char(20))";

	if(mysqli_query($con,$sql)){
		echo "success";
	}
	else{
		  echo "Error creating table: " . mysqli_error($con);
	}
	echo "<script>alert('Setup Completed');</script>"
?>
