<?php
function connector(){
		$con=mysqli_connect("119.82.105.141","root1","root@123","hawk");
		return $con;
}
function connector_db(){
		$con=mysqli_connect("119.82.105.141","root1","root@123");
}
?>
