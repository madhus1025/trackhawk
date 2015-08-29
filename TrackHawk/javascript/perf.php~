<?
include 'Connector.php';

$con=connector();

$index=0;

mysqli_query($con,"delete from locations");
	$latitude=16.000000;
	$longitude=78.000000;
while($index<1000){

	$result=mysqli_query($con,"SELECT * FROM devices");
	$rows=$index;
	
	$imei="1234".$index;
	$name="user".$index;


	$result=mysqli_query($con,"insert into history values($index,$latitude,$longitude,'2015-01-01 00:00:00',1)");
	//$result=mysqli_query($con,"insert into deviceholders values('$imei','$name','9999999','2015-01-01 00:00:00','Motorolla',1,'')");
	//$result=mysqli_query($con,"insert into devices values($rows,'$imei',0,'$name','','',0)");
	$index++;
	$latitude=$latitude+0.18;
	$longitude=$longitude+0.18; 
	echo $latitude;
}
?>
